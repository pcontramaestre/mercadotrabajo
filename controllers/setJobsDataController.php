<?php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require_once 'controllers/BaseController.php';

class SetJobsDataController extends BaseController {
    public function __construct($pdo) {
        parent::__construct($pdo);
        $this->configuration = new Config();
        $this->modelBase = new BaseModel($pdo);
    }

    public function setJobsData($type, $data) {
        // Set headers before any output
        header('Content-Type: application/json');
        header('Cache-Control: max-age=3600, must-revalidate');
        try {
            // Check if data is a string (JSON) and decode it
            if (is_string($data)) {
                $data = json_decode($data, true);
                // If JSON decoding failed, return error
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return json_encode([
                        'success' => false,
                        'message' => 'Invalid JSON data: ' . json_last_error_msg()
                    ]);
                }
            }
            
            $response = [
                'success' => false,
                'data'=> $data,
                'message' => 'Error'
            ];
            
            $typeAccepted = ['linkedin','computrabajo','empleate'];
            if (!in_array($type, $typeAccepted)) {
                $response['success'] = false;
                $response['message'] = 'Invalid type';
                return json_encode($response);
            }
            
            // Make sure all required data is present
            // if (!isset($data['company_id']) || !isset($data['title']) || !isset($data['description'])) {
            //     $response['success'] = false;
            //     $response['message'] = 'Missing required data fields';
            //     $response['data'] = $data;
            //     return json_encode($response);
            // }
            if ($type == 'empleate') {
                $external_url = "https://www.empleate.com/venezuela/ofertas/empleo/" . $data['external_id'];
            } else {
                $external_url = $data['external_url'];
            }


            $company_id = (int) $data['company_id'];
            $title = htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8');
            $description = sanitizeHtml($data['job_description']);
            $category_id = (int) $data['category_id'];
            $job_type_id = (int) $data['job_type_id'];
            $employment_type_id = (int) $data['employment_type_id'];
            $city = htmlspecialchars($data['city'], ENT_QUOTES, 'UTF-8');
            $Fuente = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
            $external_id = htmlspecialchars($data['external_id'], ENT_QUOTES, 'UTF-8');


            //Buscar $external_id en la tabla jobs, en el campo external_id
            $result = $this->modelBase->select('jobs', ['external_id' => $external_id]);
            if ($result) {
                $response['success'] = true;
                $response['message'] = 'Job already exists';
                return json_encode($response);
            }

            // Sanitize data before saving
            $saveData = [
                'company_id' => $company_id,
                'title' => $title,
                'job_description' => sanitizeHtml($description),
                'category_id' => $category_id,
                'job_type_id' => $job_type_id,
                'employment_type_id' => $employment_type_id,
                'external_url' => $external_url,
                'city' => $city,
                'is_external' => 1,
                'Fuente' => $type,
                'external_id' => $external_id
            ];

            
            
            // Insert data into database
            $result = $this->modelBase->insert('jobs', $saveData);
            


            if ($result) {
                $response['success'] = true;
                $response['message'] = 'Job saved successfully';
                $response['data'] = $saveData;
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to save job';
            }
            
            return json_encode($response);
        } catch (Exception $e) {
            // Log the error
            error_log("Error al guardar el trabajo: " . $e->getMessage());
            
            // Set headers before any output
            header('Content-Type: application/json');
            
            // Return error response
            return json_encode([
                'success' => false,
                'message' => 'Error al guardar el trabajo: ' . $e->getMessage()
            ]);
        }
    }
}

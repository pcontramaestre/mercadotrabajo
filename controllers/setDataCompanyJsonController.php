<?php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require_once 'controllers/BaseController.php';

class setDataCompanyJsonController extends BaseController
{
    protected $modelBase;
    protected $configuration;

   public function __construct($pdo)
   {
       $this->configuration = new Config();
       $this->modelBase = new BaseModel($pdo);
   }

   public function saveJob($action, $dataRecive){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

        $data = json_decode($dataRecive, true);
        if (!is_array($data)) {
            $response['message'] = 'Datos no válidos.';
            echo json_encode($response);
            return;
        }

        $response = [
            'status'=> 200,
            'message' => 'Success',
            'action' => $action,
            'success' => false,
        ];

        if (empty($action) || $action !== 'createJob') {
            $response['success'] = false;
            $response['message'] = 'No se recibió acción.';
            echo json_encode($response);
            return;
        }

        if (empty($data) || !is_array($data)) {
            $response['success'] = false;
            $response['message'] = 'No se recibieron datos.';
            echo json_encode($response);
            return;
        } 

        if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
            $response['success'] = false;
            $response['message'] = 'Acceso denegado. Por favor, inicia sesión.';
            echo json_encode($response);
            return;
        }


        $title = isset($data['title']) ? htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8') : '';
        $category_id = isset($data['category_id']) ? (is_numeric($data['category_id']) ? (int)$data['category_id'] : 0) : 0;
        $job_type_id = isset($data['job_type_id']) ? (is_numeric($data['job_type_id']) ? (int)$data['job_type_id'] : 0) : 0;
        $employment_type_id = isset($data['employment_type_id']) ? (is_numeric($data['employment_type_id']) ? (int)$data['employment_type_id'] : 0) : 0;
        $city = isset($data['city']) ? htmlspecialchars($data['city'], ENT_QUOTES, 'UTF-8') : '';
        $priority = isset($data['priority']) ? htmlspecialchars($data['priority'], ENT_QUOTES, 'UTF-8') : '';
        $salary_min = isset($data['salary_min']) ? (is_numeric($data['salary_min']) ? (int)$data['salary_min'] : 0) : 0;
        $salary_max = isset($data['salary_max']) ? (is_numeric($data['salary_max']) ? (int)$data['salary_max'] : 0) : 0;
        $external_url = isset($data['external_url']) ? filter_var($data['external_url'], FILTER_SANITIZE_URL) : '';
        $job_description = isset($data['job_description']) ? nl2br(htmlspecialchars($data['job_description'], ENT_QUOTES, 'UTF-8')) : '';
        $key_responsibilities = '';
        if (isset($data['key_responsibilities']) && !empty($data['key_responsibilities'])) {
            $lines = explode("\n", trim($data['key_responsibilities']));
            if (count($lines) > 1) {
                $key_responsibilities = '<ul class="list-disc pl-5">';
                foreach ($lines as $line) {
                    if (trim($line) !== '') {
                        $key_responsibilities .= '<li>' . htmlspecialchars(trim($line), ENT_QUOTES, 'UTF-8') . '</li>';
                    }
                }
                $key_responsibilities .= '</ul>';
            } else {
                $key_responsibilities = htmlspecialchars($data['key_responsibilities'], ENT_QUOTES, 'UTF-8');
            }
        }
        $skills_experience = '';
        if (isset($data['skills_experience']) && !empty($data['skills_experience'])) {
            $lines = explode("\n", trim($data['skills_experience']));
            if (count($lines) > 1) {
                $skills_experience = '<ul class="list-disc pl-5">';
                foreach ($lines as $line) {
                    if (trim($line) !== '') {
                        $skills_experience .= '<li>' . htmlspecialchars(trim($line), ENT_QUOTES, 'UTF-8') . '</li>';
                    }
                }
                $skills_experience .= '</ul>';
            } else {
                $skills_experience = htmlspecialchars($data['skills_experience'], ENT_QUOTES, 'UTF-8');
            }
        }
        $company_id = $_SESSION['company_id'];
        $dataSave = [
            'title' => $title,
            'category_id' => $category_id,
            'job_type_id' => $job_type_id,
            'employment_type_id' => $employment_type_id,
            'city' => $city,
            'priority' => $priority,
            'salary_min' => $salary_min,
            'salary_max' => $salary_max,
            'external_url' => $external_url,
            'job_description' => $job_description,
            'key_responsibilities' => $key_responsibilities,
            'skills_experience' => $skills_experience,
            'company_id' => $company_id,
            'Fuente' => 'Interno',
            'is_external'=> 0,
            'is_active'=> 1
        ];
        
        if ($action === 'createJob') {
            $result = $this->modelBase->insert('jobs', $dataSave);
            if (!$result) {
                $response['success'] = false;
                $response['message'] = 'Error al crear el trabajo';
            } else {
                $response['success'] = true;
                $response['message'] = 'Trabajo creado exitosamente';
            }
        }

        echo json_encode($response);
        return;
    }

   public function setDataProfileCompany($action, $dataRecive){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

        $userId = $_SESSION['company_id'] ?? null;
        if ($userId === null) {
            $response['message'] = 'Usuario no autenticado.';
            echo json_encode($response);
            return;
        }

        $allowedActions = ['save_social-form', 'save_contact-form', 'save_profile-form'];
        if (!in_array($action, $allowedActions)) {
            $response['message'] = 'Acción no válida.';
            echo json_encode($response);
            return;
        }

        $data = json_decode($dataRecive, true);

        if (!is_array($data)) {
            $response['message'] = 'Datos no válidos.';
            echo json_encode($response);
            return;
        }

        switch ($action) {
            case 'save_contact-form':
                $donde_empresa = $data['donde_empresa'] ?? 'true';
                $completeAddress = isset($data['complete_address']) ? htmlspecialchars($data['complete_address'], ENT_QUOTES, 'UTF-8') : '';
                $countryId = 1;
                $id_estado = isset($data['id_estado']) ? filter_var((int) $data['id_estado'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $id_municipio = isset($data['id_municipio']) ? filter_var((int) $data['id_municipio'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $id_parroquia = isset($data['id_parroquia']) ? filter_var((int) $data['id_parroquia'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $ciudad = isset($data['ciudad']) ? htmlspecialchars($data['ciudad'], ENT_QUOTES, 'UTF-8') : '';

                $donde_empresa = filter_var($donde_empresa, FILTER_VALIDATE_BOOLEAN);

                if ($donde_empresa){
                    $estado = $this->modelBase->selectWithFields('estados', 'estado',"id_estado = $id_estado");
                    $municipio = $this->modelBase->selectWithFields('municipios', 'municipio',"id_municipio = $id_municipio");
                    $ubicacion = $estado[0]['estado'] . ', ' . $municipio[0]['municipio'];
                } else {
                    $id_estado = 0;
                    $id_municipio = 0;
                    $id_parroquia = 0;
                    $donde_empresa = 0;
                    $ubicacion = $data['localidad'];
                }

                $dataUpdate = [
                    'complete_address' => $completeAddress,
                    'country_id' => $countryId,
                    'id_estado' => $id_estado,
                    'id_municipio' => $id_municipio,
                    'id_parroquia' => $id_parroquia,
                    'ciudad' => $ciudad,
                    'is_venezuela'=> $donde_empresa,
                    'location'=> $ubicacion,
                ];

                $conditions = ['id' => $userId];
                $result = $this->modelBase->update('companies', $dataUpdate, $conditions);


                $response = $result ? 
                ['success' => true, 'message' => 'Dirección guardada'] : 
                ['success' => false, 'message' => 'Error al guardar la dirección.'];
                break;
            case 'save_social-form':
                $dataUpdate = [
                    'social_facebook' => $data['facebook'],
                    'social_x' => $data['twitter'],
                    'social_linkedin' => $data['linkedin'],
                ];
                $conditions = ['id' => $userId];
                $result = $this->modelBase->update('companies', $dataUpdate, $conditions);
                $response = $result ? 
                ['success' => true, 'message' => 'Redes Sociales guardadas'] : 
                ['success' => false, 'message' => 'Error al guardar las redes sociales.'];
                break;
            case 'save_profile-form':

                $description = $data['description'];
                $filteredDescription = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
                $safeDescription = nl2br($filteredDescription);

                // Manejo del logo
                $logoPath = null; // Inicializar la ruta del logo como null

                if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpName = $_FILES['logo']['tmp_name'];
                    $fileName = $_FILES['logo']['name'];
                    $fileType = $_FILES['logo']['type'];
                    $fileSize = $_FILES['logo']['size'];

                    // Validar el tipo de archivo y el tamaño (opcional)
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                    $maxFileSize = 1024 * 1024; // 1MB

                    if (!in_array($fileType, $allowedTypes)) {
                        $response = ['success' => false, 'message' => 'Tipo de archivo no válido.'];
                        echo json_encode($response);
                        return;
                    }

                    if ($fileSize > $maxFileSize) {
                        $response = ['success' => false, 'message' => 'Tamaño de archivo no válido.'];
                        echo json_encode($response);
                        return;
                    }

                    // Generar un nombre de archivo único
                    $uniqueFileName = uniqid() . '_' . $fileName;

                    // Mover el archivo a una ubicación permanente
                    $uploadDir = 'assets/companies/img/uploads/'; // Directorio donde guardar los archivos
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    $uploadPath = $uploadDir . $uniqueFileName;

                    if (move_uploaded_file($fileTmpName, $uploadPath)) {
                        // El archivo se ha cargado correctamente
                        $logoPath = $uploadPath; // Guardar la ruta en la variable
                    } else {
                        $response = ['success' => false, 'message' => 'Error al cargar el logo de la empresa.'];
                        echo json_encode($response);
                        return;
                    }
                }


                $dataUpdate = [
                    'name' => $data['company_name'],
                    'mail' => $data['email_address'],
                    'phone' => $data['phone'],
                    'website' => $data['website'],
                    'founded_since' => $data['founded_since'],
                    'company_size' => $data['company_size'],
                    'description'=> $safeDescription,
                    'primary_industry' => $data['primary_industry'],
                ];

                if ($logoPath !== null) {
                    $dataUpdate['logo_url'] = $logoPath;
                    $dataUpdate['logo_url_completa'] = SYSTEM_BASE_DIR . $logoPath;
                }

                $conditions = ['id' => $userId];
                $result = $this->modelBase->update('companies', $dataUpdate, $conditions);
                $response = $result ? 
                ['success' => true, 'message' => 'Perfil guardado', 'logo_url' => $logoPath, 'data' => $dataUpdate, 'FILES' => $_FILES] : 
                ['success' => false, 'message' => 'Error al guardar el perfil.'];
                break;
        }
        echo json_encode($response);
   }
}
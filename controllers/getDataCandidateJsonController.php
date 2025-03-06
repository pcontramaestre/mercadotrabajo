<?php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require_once 'controllers/BaseController.php';

class getDataCandidateJsonController extends BaseController {
    protected $modelBase;
    protected $configuration;

    public function __construct($pdo) {
        $this->configuration = new Config();
        $this->modelBase = new BaseModel($pdo);
    }

    public function getEducation($id_user) {
        $id_user = (int) $id_user;
        $records = $this->modelBase->select('education', ['user_id' => $id_user],'end_year ASC');
        if (empty($records)) {
            return [];
        } else {
            return $records;
        }
    }

    public function getExperience($id_user) {
        $records = $this->modelBase->select('experience', ['user_id' => $id_user, 'endDate DESC']);
        if (empty($records)) {
            return [];
        } else {
            return $records;
        }
    }

    public function getAwards($id_user) {
        $records = $this->modelBase->select('awards', ['user_id' => $id_user]);
        if (empty($records)) {
            return [];
        } else {
            return $records;
        }
    }

    public function getSkills($id_user) {
        $records = $this->modelBase->select('skills', ['user_id' => $id_user]);
        if (empty($records)) {
            return [];
        } else {
            return $records;
        }
    }

    public function getUserProfile($id_user) {
        $records = $this->modelBase->select('user_profile', ['user_id' => $id_user],'user_id DESC');
        if (empty($records)) {
            return [];
        } else {
            $url = SYSTEM_BASE_DIR.$records[0]['logo_path'];
            $records[0]['logo_path'] = $url;
            return $records;
        }
    }

    public function getResumeDataJson($id_user) {
        switch ($id_user) {
            case $_SESSION['user_id']:
                $response = [
                    'education' => [],
                    'experience' => [],
                    'awards' => [],
                    'skills' => [],
                    'user_profile' => [],
                ];
                $education = $this->getEducation($id_user);
                $experience = $this->getExperience($id_user);
                $awards = $this->getAwards($id_user);
                $skills = $this->getSkills($id_user);
                $userprofile = $this->getUserProfile($id_user);
                $response['education'] = $education;
                $response['experience'] = $experience;
                $response['awards'] = $awards;
                $response['skills'] = $skills;
                $response['user_profile'] = $userprofile;

                // Devolver datos como JSON
                header('Content-Type: application/json');
                echo json_encode($response);
                break;
            default:
                header('Content-Type: application/json');
                $response = [
                    'success' => false,
                    'message' => 'error user auth'
                ];
                echo json_encode($response);
                break;
        }
    }

    public function getProfileDataJson($id_user) {
        switch ($id_user) {
            case $id_user:
                $response = [
                    'user_profile'=> [],
                    'success' => false, 
                    'message' => 'No se encontraron datos del perfil.'
                ];
                $userprofile = $this->getUserProfile($id_user);

                
                if (!empty($userprofile)) {
                    $response['user_profile'] = $userprofile;
                    $response['success'] = true; 
                    $response['message'] = 'Datos del perfil obtenidos correctamente.';
                }

                header('Content-Type: application/json');
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: GET');
                header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

                echo json_encode($response);
                break;
            default:
                header('Content-Type: application/json');
                $response = [
                    'success' => false,
                    'message' => 'Error de autenticación del usuario.'
                ];
                echo json_encode($response);
                break;
        }
    }
}
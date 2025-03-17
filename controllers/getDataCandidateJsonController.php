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

    public function getCvs($id_user) {
        $records = $this->modelBase->select('candidate_cv', ['user_id' => $id_user]);
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
    public function getSaveJobs($id_user) {
        $records = [];
        $fields = "
            jobs.id, 
            jobs.title AS title, 
            jobs.city as location,
            jobs.is_active,
            CASE 
            WHEN EXISTS (
                SELECT 1 
                FROM saved_jobs 
                WHERE saved_jobs.user_id = ".$id_user." AND saved_jobs.job_id = jobs.id
            ) THEN 1 
            ELSE 0 
            END AS isSaved,
            categories.name AS category,
            companies.logo_url AS company_logo,
            CONCAT('" . SYSTEM_BASE_DIR . "', companies.logo_url) AS logo,
            saved_jobs.created_at AS create_at
        ";

        $joinClause = "
            INNER JOIN categories ON jobs.category_id = categories.id 
            INNER JOIN companies ON jobs.company_id = companies.id
            INNER JOIN saved_jobs ON jobs.id = saved_jobs.job_id
        ";

        $conditions = "saved_jobs.user_id = $id_user";
        $records = $this->findRecordsWithFields(
            'jobs',
            $fields,
            $conditions,
            'saved_jobs.created_at DESC',
            0,
            50,
            $joinClause
        );
        return $records;
    }

    public function getAppliedJobs($id_user) {
        $records = [];
        $fields = "
            jobs.id, 
            jobs.title AS title, 
            jobs.city as location,
            jobs.is_active,
            categories.name AS category,
            companies.logo_url AS company_logo,
            CONCAT('" . SYSTEM_BASE_DIR . "', companies.logo_url) AS logo,
            job_applications.created_at AS create_at,
            job_applications.status
        ";

        $joinClause = "
            INNER JOIN categories ON jobs.category_id = categories.id 
            INNER JOIN companies ON jobs.company_id = companies.id
            INNER JOIN job_applications ON jobs.id = job_applications.job_id
        ";

        $conditions = "job_applications.user_id = $id_user";
        $records = $this->findRecordsWithFields(
            'jobs',
            $fields,
            $conditions,
            'job_applications.created_at DESC',
            0,
            50,
            $joinClause
        );
        return $records;
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
                    'cvs'=> [],
                    'success' => true, 
                ];
                $education = $this->getEducation($id_user);
                $experience = $this->getExperience($id_user);
                $awards = $this->getAwards($id_user);
                $skills = $this->getSkills($id_user);
                $userprofile = $this->getUserProfile($id_user);
                $cvs = $this->getCvs($id_user);
                $response['education'] = $education;
                $response['experience'] = $experience;
                $response['awards'] = $awards;
                $response['skills'] = $skills;
                $response['user_profile'] = $userprofile;
                $response['cvs'] = $cvs;

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
    /**
     * Summary of getResumeData
     * @param mixed $id_user
     * @return array<array|null>|array{awards: array, cvs: array, education: array, experience: array, skills: array, success: bool, user_profile: array}
     */
    public function getResumeData($id_user){
        if (!empty($id_user)) {
            $response = [
                'education' => [],
                'experience' => [],
                'awards' => [],
                'skills' => [],
                'user_profile' => [],
                'cvs'=> [],
                'success' => true, 
            ];
            $education = $this->getEducation($id_user);
            $experience = $this->getExperience($id_user);
            $awards = $this->getAwards($id_user);
            $skills = $this->getSkills($id_user);
            $userprofile = $this->getUserProfile($id_user);
            $cvs = $this->getCvs($id_user);
            $response['education'] = $education;
            $response['experience'] = $experience;
            $response['awards'] = $awards;
            $response['skills'] = $skills;
            $response['user_profile'] = $userprofile;
            $response['cvs'] = $cvs;
            return $response;
        } else {
            return [];
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
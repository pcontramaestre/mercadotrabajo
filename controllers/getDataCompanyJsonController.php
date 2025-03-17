<?php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require_once 'controllers/BaseController.php';

class getDataCompanyJsonController extends BaseController {


    public function getSessionCompany($id_company) {
        $company_id = $_SESSION['company_id'] == $id_company ? $_SESSION['company_id'] : 0;
        return $company_id;
    }

    /**
     * Summary of getCompanyProfile
     * @param mixed $id_company
     * @return array|null
     */
    public function getCompanyProfile($id_company) {
        $company_id = $this->getSessionCompany($id_company);
        if ($company_id) {
            $records = $this->modelBase->select('companies', ['id' => $company_id]);
            if (empty($records)) {
                return [];
            } else {
                $url = SYSTEM_BASE_DIR.$records[0]['logo_url'];
                $records[0]['logo_url'] = $url;
                return $records;
            }
        } else {
            return [];
        }
    }

    /**
     * Summary of getRecentApplicants
     * 
     * @param mixed $id_company
     * @return array|null
     */
    public function getRecentApplicants($id_company) {
        $company_id = $this->getSessionCompany($id_company);
        if ($company_id) {
            $fields ="
                job_applications.created_at,
                job_applications.user_id,
                user_profile.full_name AS user_profile_fullname,
                user_profile.email_address AS user_profile_email,
                user_profile.phone AS user_profile_phone,
                user_profile.logo_path AS user_profile_avatar,
                job_applications.job_id,
                jobs.title AS job_title,
                jobs.company_id AS job_company_id,
                job_applications.cv_id,
                candidate_cv.path AS path_cv,
                job_applications.cover_letter,
                job_applications.status
            ";

            $innerJoin = "
                INNER JOIN user_profile ON job_applications.user_id = user_profile.user_id
                INNER JOIN jobs ON job_applications.job_id = jobs.id
                INNER JOIN companies ON jobs.company_id = companies.id
                INNER JOIN candidate_cv ON job_applications.cv_id = candidate_cv.id
            ";

            $records = $this->modelBase->selectWithFields(
                "job_applications",
                $fields,
                'companies.id='.$company_id. ' AND job_applications.status = "aplicado"', 
                'created_at DESC', 
                0, 
                10, 
                $innerJoin);

            if (empty($records)) {
                return [];
            } else {
                return $records;
            }
        } else {
            return [];
        }
    }
}
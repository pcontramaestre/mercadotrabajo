<?php
require_once 'controllers/BaseController.php';
class companyDashboardController extends BaseController {

    public function viewResume(?array $params = []) {
        $dataUserProfile = $params;
        include_once 'views/candidate/myResume.php';
    }
    public function viewProfile(?array $params = [], ?array $params2 = []) {
        $dataUserProfile = $params;
        $dataCompanyProfile = $params;
        include_once  'views/company/myProfile.php';
    }

    public function viewDashboard(?array $params = [], ?array $params2 = []) {
        $dataCompanyProfile = $params;
        $dataJobsApplied = $params2;
        include_once  'views/company/dashboard.php';
    }

    public function viewJobs(?array $params = []) {
        $dataJobsApplied = $params;
        include_once  'views/company/myJobs.php';
    }

    public function viewPostJobs(?array $params = []) {
        $dataJobsApplied = $params;
        include_once  'views/company/postJob.php';
    }

    public function viewEditPostJob(?array $params = [], ?array $params2 = []) {
        $dataJob = $params;
        $dataCompanyProfile = $params2;
        include_once  'views/company/editPostJob.php';
    }

    public function viewMyJobs($params = [], $params2 = []) {
        $dataCompanyProfile = $params;
        $dataCompanyJob = $params2;
        include_once  'views/company/myJobs.php';
    }

    public function viewCvManager(?array $params = []) {
        $dataUserProfile = $params;
        include_once  'views/candidate/MyCvManager.php';
    }

    public function viewShortListedJobs(?array $params = [], ?array $params2 = []) {
        $dataUserProfile = $params;
        $dataUserJobsSave = $params2;
        include_once  'views/candidate/shortListedJobs.php';
    }

    public function viewAppliedJobs(?array $params = [], ?array $params2 = []) {
        $dataUserProfile = $params;
        $dataUserJobsSave = $params2;
        include_once  'views/candidate/appliedJobs.php';
    }

    public function viewCandidateDetail(?array $params = [], ?array $params2 = []) {
        $dataUserProfile = $params;
        $dataCompanyProfile = $params2;
        include_once  'views/company/candidateDetail.php';
    }
    
}
<?php
require_once 'controllers/BaseController.php';
class CandidateDashboardController extends BaseController {

    public function viewResume(?array $params = []) {
        $dataUserProfile = $params;
        include_once 'views/candidate/myResume.php';
    }
    public function viewProfile(?array $params = []) {
        $dataUserProfile = $params;
        $estados = $this->getEstados();
        include_once  'views/candidate/myProfile.php';
    }

    public function viewDashboard(?array $params = [], ?array $params2 = []) {
        $dataUserProfile = $params;
        $dataJobsAplied = $params2;
        include_once  'views/candidate/dashboard.php';
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

    
}
<?php
require_once 'controllers/BaseController.php';
class CandidateDashboardController extends BaseController {

    public function viewResume(?array $params = []) {
        $dataUserProfile = $params;
        include_once 'views/candidate/myResume.php';
    }
    public function viewProfile(?array $params = []) {
        $dataUserProfile = $params;
        include_once  'views/candidate/myProfile.php';
    }

    public function viewDashboard(?array $params = []) {
        $dataUserProfile = $params;
        include_once  'views/candidate/dashboard.php';
    }
}
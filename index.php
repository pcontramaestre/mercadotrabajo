<?php
require_once 'config/database.php';
require_once 'config/config.php';
require_once 'functions/functions.php';
require_once 'controllers/BaseController.php';
require_once 'controllers/getDataCandidateJsonController.php';
require_once 'controllers/setDataCandidateJsonController.php';
require_once 'controllers/candidateDashboardController.php';

// header('Content-Type: application/json');
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET');
// header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$configuration = new Config();
$database = new Database($configuration);
//$database = new Database();
$db = $database->getConnection();

$ruta_base = SYSTEM_BASE_DIR;
$ruta_base = parse_url($ruta_base, PHP_URL_PATH);
$ruta_base = substr($ruta_base, 0, strrpos($ruta_base, '/'));

$request = $_SERVER['REQUEST_URI'];

$request = str_replace($ruta_base, '', $request);
//$_SESSION['user_id'] = 8;
$id_user = 8; //$_SESSION['user_id'];
chdir(__DIR__); 

switch ($request) {
  case '':
  case '/':
    $controller = new BaseController($db);
    $controller->index();
    break;
  case '/companies':
    $controller = new BaseController($db);
    $controller->viewCompanies();
    break;
  // url companies/ID de la empresa
  case '/companies' && preg_match('/^\/companies\/(\d+)$/', $request, $matches) ? true : false:
    $companyId = $matches[1];
    $controller = new BaseController($db);
    $controller->viewCompany($companyId);
    break;
  case '/searchjobs':
    $controller = new BaseController($db);
    $controller->viewSearchJobs();
    break;
  case preg_match('/^\/searchjobs(?:\/(\d+))?(?:\?job=(\d+))?$/', $request, $matches) ? true : false:
    $controller = new BaseController($db);
    $lengArray = count($matches);

    if ($lengArray == 2) {
      $jobId = $matches[1];
      
    } elseif ($lengArray == 3) {
      $jobId = $matches[2];
    }

    // print_r("Encontrados:".$lengArray." valores.  ");
    // print_r($matches);
    // print_r( "  0 value: ". $matches[0]);
    // print_r( "  1 value: ". $matches[1]);
    // print_r( "  2 value: ".$matches[2] );
    // $jobId = $matches[1]; // Obtener el ID del trabajo desde la URL
    // $jobId = $matches[1] ?? $matches[2] ?? null;
    // exit;
    $jobId = (int) $jobId;
    $controller->viewSearchJobs($jobId); // Pasar el ID al controlador
    break;
  case '/blog':
    $controller = new BaseController($db);
    $controller->viewBlog();
    break;

  //Dashboard candidate
  case '/dashboard/candidate/dashboard':
    $controllerDataProfile = new getDataCandidateJsonController($db);
    $dataUserProfile = $controllerDataProfile->getUserProfile($id_user);

    $controller = new CandidateDashboardController($db);
    $controller->viewDashboard($dataUserProfile);
    break;
  case '/dashboard/candidate/myresume':
    $controllerDataProfile = new getDataCandidateJsonController($db);
    $dataUserProfile = $controllerDataProfile->getUserProfile($id_user);


    $controller = new CandidateDashboardController($db);
    $controller->viewResume($dataUserProfile);
    break;
  case '/dashboard/candidate/myprofile':
    $controllerDataProfile = new getDataCandidateJsonController($db);
    $dataUserProfile = $controllerDataProfile->getUserProfile($id_user);

    $controller = new CandidateDashboardController($db);
    $controller->viewProfile($dataUserProfile);
    break;

  //Llamadas api
  case '/api/v1/getdatacandidate':
    $id_user = 8;
    $controller = new getDataCandidateJsonController($db);
    $controller->getResumeDataJson($id_user);
    break;
  case '/api/v1/setdatacandidate':
    $controller = new setDataCandidateJsonController($db);
    switch ($_POST['action']) {
      case 'delete_item':
        $controller->saveDataResumeCandidate($_POST['action'], $_POST['id']);
        break;
      case 'save_description':
        $controller->saveDataResumeCandidate($_POST['action'], $_POST['description']);
        break;
      default:
        $controller->saveDataResumeCandidate($_POST['action'], $_POST['data']);
        break;
    }
    break;
  case '/api/v1/getdataprofilecandidate':
    $id_user = 8;
    $controller = new getDataCandidateJsonController($db);
    $controller->getProfileDataJson($id_user);
    break;
  case '/api/v1/setdataprofilecandidate':
    $id_user = 8;
    $controller = new setDataCandidateJsonController($db);
    $controller->setDataProfileCandidate($_POST['action'],$_POST['data']);
}
<?php
require_once 'config/database.php';
require_once 'config/config.php';
require_once 'functions/functions.php';
require_once 'controllers/BaseController.php';
require_once 'controllers/getDataCandidateJsonController.php';
require_once 'controllers/setDataCandidateJsonController.php';
require_once 'controllers/candidateDashboardController.php';
require_once 'controllers/companyDashboardController.php';
require_once 'controllers/getDataCompanyJsonController.php';
require_once 'controllers/setDataCompanyJsonController.php';
require_once 'controllers/setJobsDataController.php';
require_once 'controllers/getDataExternalController.php';
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
$id_user = $_SESSION['user_id'];
$id_company = $_SESSION['company_id'];
chdir(__DIR__); 

switch ($request) {
  case '':
  case '/':
    $controller = new BaseController($db);
    $controller->index();
    break;
  case preg_match('/^\/login(?:\?message=(\d+))?$/', $request,  $matches) ? true : false:
    $message = $matches[1] ?? '';
    $controller = new BaseController($db);
    $controller->viewLogin($message);
    break;
  case '/loginUser':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        // Verificar que no esté vacío ningún campo
        if (empty($email) || empty($password)) {
            exit;
        }
        
        // Eliminar espacios en blanco del email
        $email = preg_replace('/\s+/','', $email);
        
        $controller = new BaseController($db);
        $controller->loginUser($email, $password);
    }
    break;
  
  case '/logout':
    $controller = new BaseController($db);
    $controller->logout();
    break;

  case '/changePassword':
    $controller = new BaseController($db);
    $controller->viewChangePassword();
    break;
    
  case preg_match('/^\/register\/candidate(?:\?error=(\d+))?$/', $request, $matches) ? true : false:
    $error = $matches[1] ?? '';
    $controller = new BaseController($db);
    $controller->viewRegisterCandidate($error);
    break;

  case '/registerCandidate':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        
        // Verificar que no esté vacío ningún campo
        if (empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || empty($data['phone']) || empty($data['password'])) {
            exit;
        }
        
        // Eliminar espacios en blanco del email
        $email = isset($_POST['email']) ? preg_replace('/\s+/', '', $_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $controller = new BaseController($db);
        $controller->registerCandidate($data);
    }
    break;
    
  case preg_match('/^\/register\/company(?:\?error=(\d+))?$/', $request, $matches) ? true : false:
    $error = $matches[1] ?? '';
    $controller = new BaseController($db);
    $controller->viewRegisterCompany($error);
    break;
  
  case '/registerCompany':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        
        // Verificar que no esté vacío ningún campo
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            exit;
        }
        
        // Eliminar espacios en blanco del email
        $email = isset($_POST['email']) ? preg_replace('/\s+/', '', $_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $controller = new BaseController($db);
        $controller->registerCompany($data);
    }
    break;
    
  case '/terms':
    include_once 'views/front/pages/terms.php';
    break;
    
  case '/privacy':
    include_once 'views/front/pages/privacy.php';
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
    $jobId = (int) $jobId;
    $controller->viewSearchJobs($jobId); // Pasar el ID al controlador
    break;
  case '/blog':
    $controller = new BaseController($db);
    $controller->viewBlog();
    break;
  case '/terms':
    include_once 'views/front/pages/terms.php';
    break;
  case '/about':
    include_once 'views/front/pages/about.php';
    break;

  //Dashboard company
  case '/dashboard/company/dashboard':
    $controllerDataProfileCompany = new getDataCompanyJsonController($db);
    $dataUserProfileCompany = $controllerDataProfileCompany->getCompanyProfile($id_company);
    $dataJobsApplied = $controllerDataProfileCompany->getRecentApplicants($id_company);
    

    $controller = new companyDashboardController($db);
    $controller->viewDashboard($dataUserProfileCompany, $dataJobsApplied);
    break;
  
  case preg_match('/^\/dashboard\/company\/candidate-detail(?:\/(\d+))?$/', $request, $matches) ? true : false:
    $candidateId = $matches[1];

    
    // Datos del candidato
    $controllerDataUserProfile  = new getDataCandidateJsonController($db);
    $dataUserProfile = $controllerDataUserProfile->getResumeData($candidateId);

    // Datos de la empresa
    $controllerDataProfileCompany = new getDataCompanyJsonController($db);
    $dataUserProfileCompany = $controllerDataProfileCompany->getCompanyProfile($id_company);

    // Mostrar la vista
    $controller = new companyDashboardController($db);
    $controller->viewCandidateDetail($dataUserProfile, $dataUserProfileCompany);
    break;
  
  case '/dashboard/company/myprofile':
    $controllerDataProfile = new getDataCompanyJsonController($db);
    $dataUserProfile = $controllerDataProfile->getCompanyProfile($id_company);

    // Datos de la empresa
    $controllerDataProfileCompany = new getDataCompanyJsonController($db);
    $dataUserProfileCompany = $controllerDataProfileCompany->getCompanyProfile($id_company);


    $controller = new companyDashboardController($db);
    $controller->viewProfile($dataUserProfile, $dataUserProfileCompany);
    break;
  case '/dashboard/company/postjobs':
    $controllerDataProfile = new getDataCompanyJsonController($db);
    $dataUserProfile = $controllerDataProfile->getCompanyProfile($id_company);
    $controller = new companyDashboardController($db);
    $controller->viewPostJobs($dataUserProfile);
    break;

  case preg_match('/^\/dashboard\/company\/editpostjob(?:\/(\d+))?$/', $request, $matches) ? true : false:
    $jobId = $matches[1] ?? null;
    $controllerDataProfile = new getDataCompanyJsonController($db);
    $dataUserProfile = $controllerDataProfile->getCompanyProfile($id_company);    
    if ($jobId) {
      $jobData = $controllerDataProfile->getJobDetails($jobId, $id_company);
    } else {
      echo 'No tiene un ID de trabajo valido';
    }
    
    $controller = new companyDashboardController($db);
    $controller->viewEditPostJob($dataUserProfile, $jobData);
    break;
  
  case '/dashboard/company/myjobs':
    $controllerDataProfile = new getDataCompanyJsonController($db);
    $dataUserProfile = $controllerDataProfile->getCompanyProfile($id_company);
    $dataCompanyJobs  = $controllerDataProfile->getCompanyJobs($id_company);

    $controller = new companyDashboardController($db);
    $controller->viewMyJobs($dataUserProfile, $dataCompanyJobs);
    break;

  //Dashboard candidate
  case '/dashboard/candidate/dashboard':
    $controllerDataProfile = new getDataCandidateJsonController($db);
    $dataUserProfile = $controllerDataProfile->getUserProfile($id_user);
    $dataUserJobsApplied = $controllerDataProfile->getAppliedJobs($id_user);
    $numberAppliedJobs = count($controllerDataProfile->getAppliedJobs($id_user));
    $numberSaveJobs = count($controllerDataProfile->getSaveJobs($id_user));
    $dataCounts = [
      'numberSaveJobs' => $numberSaveJobs,
      'numberAppliedJobs'=> $numberAppliedJobs,
      'jobsAlerts'=> 0,
      'messagesAlerts'=> 0,
      'dataAppliedJobs'=> $dataUserJobsApplied,
    ];

    $controller = new CandidateDashboardController($db);
    $controller->viewDashboard($dataUserProfile, $dataCounts);
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

  case '/dashboard/candidate/mycvmanager':
    $controllerDataProfile = new getDataCandidateJsonController($db);
    $dataUserProfile = $controllerDataProfile->getUserProfile($id_user);

    $controller = new CandidateDashboardController($db);
    $controller->viewCvManager($dataUserProfile);
    break;
  case '/dashboard/candidate/appliedjobs':
    $controllerDataProfile = new getDataCandidateJsonController($db);
    $dataUserProfile = $controllerDataProfile->getUserProfile($id_user);
    $dataUserJobsSave = $controllerDataProfile->getAppliedJobs($id_user);
    

    $controller = new CandidateDashboardController($db);
    $controller->viewAppliedJobs($dataUserProfile, $dataUserJobsSave );
    break;
  case '/dashboard/candidate/shorlistedjobs':
    $controllerDataProfile = new getDataCandidateJsonController($db);
    $dataUserProfile = $controllerDataProfile->getUserProfile($id_user);
    $dataUserJobsSave = $controllerDataProfile->getSaveJobs($id_user);
    

    $controller = new CandidateDashboardController($db);
    $controller->viewShortListedJobs($dataUserProfile, $dataUserJobsSave );
    break;


    
  //Llamadas api
  case '/save-job':
    $controller = new BaseController($db);
    $controller->saveJobAction();
    break;

  case '/api/v1/getdatacandidate':
    $id_user = $_SESSION['user_id'];
    $controller = new getDataCandidateJsonController($db);
    $controller->getResumeDataJson($id_user);
    break;

  case '/api/v1/setdatacandidate':
    $controller = new setDataCandidateJsonController($db);
    
    // Obtener la acción del POST
    $action = $_POST['action'] ?? null;

    if (!$action) {
        echo json_encode(['success' => false, 'message' => 'Acción no especificada.']);
        break;
    }

    try {
        switch ($action) {
            case 'add_file':
                // Para subir archivos, los datos están en $_FILES
                $controller->setDataCVCandidate($action, $_FILES);
                break;
            case 'delete_file':
                // Para eliminar archivos, el ID está en $_POST
                $controller->setDataCVCandidate($action, $_POST);
                break;
            case 'apply_job':
                // Para aplicar a un trabajo, los datos están en $_POST
                $controller->setDataApplicationJob($action, $_POST);
                break;
            case 'delete_item':
                $controller->saveDataResumeCandidate($action, $_POST['id']);
                break;
            case 'save_description':
                $controller->saveDataResumeCandidate($action, $_POST['description']);
                break;
            default:
                $controller->saveDataResumeCandidate($action, $_POST['data']);
                break;
        }
    } catch (Exception $e) {
        error_log("Error en /api/v1/setdatacandidate: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error procesando la solicitud.']);
    }
    break;
  case '/api/v1/getdataprofilecandidate':
    $id_user = $_SESSION['user_id'];
    $controller = new getDataCandidateJsonController($db);
    $controller->getProfileDataJson($id_user);
    break;
  case '/api/v1/setdataprofilecandidate':
    $id_user = $_SESSION['user_id'];
    $controller = new setDataCandidateJsonController($db);
    $controller->setDataProfileCandidate($_POST['action'],$_POST['data']);
    break;

  //Consulta y guardado de datos de empresas
  case '/api/v1/setdataprofilecompany':
    $controller = new setDataCompanyJsonController($db);
    $controller->setDataProfileCompany($_POST['action'],$_POST['data']);
    break;

  case '/api/v1/getdatacompany':
    if (!empty($_SESSION['company_id']) && $_SESSION['role_id'] == 3) {
      $controller = new getDataCompanyJsonController($db);
    }
    break;
  
  case '/api/v1/setdatajob':
    $controller = new setDataCompanyJsonController($db);
    $controller->saveJob($_POST['action'],$_POST['data']);
    break;

  // Llamadas a estados, municipios y parroquias
  case '/api/v1/getestados':
    //Listado de estados
    $controller = new BaseController($db);
    $estados = $controller->getEstados();
    
    header('Content-Type: application/json');
    header('Cache-Control: max-age=3600, must-revalidate');

    if ($estados) {
      echo json_encode(['success'=> true,'estados'=> $estados]);
    } else {
      echo json_encode(['success'=> false, 'message' => 'No se encontraron estados']);
    }

    break;
  
  case preg_match('/^\/api\/v1\/getmunicipios(?:\/(\\d+))?$/', $request, $matches) ? true : false:
    $id_estado = $matches[1];

    $controller = new BaseController($db);
    $municipios = $controller->getMunicipios($id_estado);
    
    header('Content-Type: application/json');
    header('Cache-Control: max-age=3600, must-revalidate');

    if ($municipios) {
      echo json_encode(['success'=> true,'municipios'=> $municipios]);
    } else {
      echo json_encode(['success'=> false, 'message' => 'No se encontraron municipios']);
    }
    break;
  
  case preg_match('/^\/api\/v1\/getparroquias(?:\/(\\d+))?$/', $request, $matches) ? true : false:
    $id_municipio = $matches[1];
    $controller = new BaseController($db);
    $parroquias = $controller->getParroquias($id_municipio);
    
    header('Content-Type: application/json');
    header('Cache-Control: max-age=3600, must-revalidate');

    if ($parroquias) {
      echo json_encode(['success'=> true,'parroquias'=> $parroquias]);
    } else {
      echo json_encode(['success'=> false, 'message' => 'No se encontraron parroquias']);
    }
    break;
  
  case preg_match('/^\/api\/v1\/getciudades(?:\/(\\d+))?$/', $request, $matches) ? true : false:
    $id_estado = $matches[1];
    $controller = new BaseController($db);  
    $ciudades = $controller->getCities($id_estado);
    
    header('Content-Type: application/json');
    header('Cache-Control: max-age=3600, must-revalidate');

    if ($ciudades) {
      echo json_encode(['success'=> true,'ciudades'=> $ciudades]);
    } else {
      echo json_encode(['success'=> false, 'message' => 'No se encontraron ciudades']);
    }
    break;

  //Linkedin 
  case preg_match('/^\/api\/v1\/searchlinkedinjobs(?:\/(\\d+))?$/', $request, $matches) ? true : false:
    $dataEntityUrn = $matches[1];
    $controller = new BaseController($db);
    $controller->searchLinkedInJobsAPI($dataEntityUrn);
    break;

  //Computrabajo 
  case preg_match('/^\/api\/v1\/searchcomputrabajojob(?:\/([A-Z0-9]+))?$/', $request, $matches) ? true : false:
    $dataEntityUrn = $matches[1];
    $controller = new BaseController($db);
    $controller->searchComputrabajoJobsAPI($dataEntityUrn);
    break;
  case preg_match('/^\/api\/v1\/searchempleatejob(?:\/([A-Z0-9]+))?$/', $request, $matches) ? true : false:
    $dataEntityUrn = $matches[1];
    $controller = new BaseController($db);
    $controller->searchEmplateJobsAPI($dataEntityUrn);
    break;

  case '/api/v1/savejobexternal':
    $controller = new SetJobsDataController($db);
    echo $controller->setJobsData($_POST['type'], $_POST['data']);
    break;

  case '/api/v1/getjobexternal':
    $controller = new getDataExternalController();
    $result = $controller->searchExternalJobs('','','');
    header('Content-Type: application/json');
    echo json_encode($result);  
    break;
  case '/api/v1/changepassword':
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    $controller = new BaseController($db);
    echo json_encode($controller->changePassword($_POST['current_password'], $_POST['new_password']));
    break;
  
  default:
    include 'views/error.php';
    break;
}
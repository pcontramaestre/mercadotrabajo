<?php
// controllers/BaseController.php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require_once 'controllers/getDataExternalController.php';
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Symfony\Component\DomCrawler\Crawler;

class BaseController
{
    protected $modelBase;
    protected $configuration;
    protected $getDataExternal;
    

    public function __construct($pdo)
    {
        $this->configuration = new Config();
        $this->modelBase = new BaseModel($pdo);
        $this->getDataExternal = new getDataExternalController();
    }

    public function viewLogin($message = '')
    {

        include_once 'views/front/pages/login.php';
    }

    public function viewRegisterCandidate($error = '')
    {
        $error = $error ?? '';
        include_once 'views/front/pages/register_candidate.php';
    }

    public function viewRegisterCompany($error = '')
    {
        $error = $error ?? '';
        include_once 'views/front/pages/register_company.php';
    }

    public function loginUser($email, $password)
    {
        $user = $this->modelBase->getUserByEmail($email, $password);

        if (!empty($user)) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_uid'] = $user['uid'];
            $_SESSION['role_id'] = $user['role_id'];
            
            // Handle "Remember me" functionality
            if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                // Set cookie that expires in 30 days
                setcookie('user_email', $email, time() + (86400 * 30), '/'); // 86400 = 1 day
            } else {
                // If not checked, delete the cookie
                if (isset($_COOKIE['user_email'])) {
                    setcookie('user_email', '', time() - 3600, '/'); // Delete cookie
                }
            }
            
            switch ($user['role_id']) {
                case 2:
                    $this->redirect(SYSTEM_BASE_DIR . 'dashboard/candidate/myprofile');
                    break;
                case 3:
                    $condition = 'user_id = ' . $user['id'];
                    $companyID = $this->modelBase->selectWithFields('companies', 'id', $condition);
                    if (!empty($companyID)) {
                        $_SESSION['company_id'] = $companyID[0]['id'];
                        //$_SESSION['avatar'] = $companyID[0]['logo_url'];
                        //$_SESSION['user_id'] = $companyID[0]['user_id'];
                        //$_SESSION['role_id'] = 3;
                    } else {
                        $_SESSION['company_id'] = 0;
                    }
                    $this->redirect(SYSTEM_BASE_DIR . 'dashboard/company/dashboard');
                    break;
                default:
                    $this->redirect('/');
                    break;
            }
        } else {
            $_SESSION['user_id'] = 0;
            $_SESSION['role_id'] = 0;
            $_SESSION['company_id'] = 0;
            $this->redirect('/login?message=1');
        }
    } 
    
    public function logout()
    {
        $_SESSION['user_id'] = 0;
        $_SESSION['user_uid'] = 0;
        $_SESSION['role_id'] = 0;
        $_SESSION['company_id'] = 0;
        session_destroy();
        $this->redirect('/');
    }

    public function viewChangePassword()
    {
        include_once 'views/front/pages/change_password.php';
    }

    public function registerCandidate($data)
    {
        //Data table users
        $data_user = [
            'uid' => uniqid(),
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role_id' => 2,
            'email'=> $data['email'],
            'name'=> $data['last_name'] . ', ' . $data['first_name'],
        ];

        $condition = ['email' => $data['email']];
        $verify_email = $this->modelBase->select('users', $condition);
        
        if ($verify_email) {    
            $this->redirect('/register/candidate?error=1');
        }
        $this->modelBase->beginTransaction();
        $id_user_created = $this->modelBase->insert('users', $data_user);
        if ($id_user_created) {

            //create data user profile (user_profile)
            $data_user_profile = [
                'user_id' => $id_user_created,
                'full_name' => $data['last_name'] . ', ' . $data['first_name'],
                'email_address' => $data['email'],
                'job_title'=> $data['profession'],
                'phone' => $data['phone'],
                'description_profile' => $data['description'],
                'education_levels'=> $data['education_levels'],
                'experience'=> $data['experience'],
                'languages'=> $data['languages'],
                'logo_path' => $_SESSION['avatar'],
            ];
            $result = $this->modelBase->insert('user_profile', $data_user_profile);
            if ($result > 0) {
                $this->modelBase->commit();
                $this->redirect(SYSTEM_BASE_DIR . 'login?message=2');
            } else {
                $this->modelBase->rollback();
                $this->redirect(SYSTEM_BASE_DIR . 'register/candidate?error=99');
            }
        }
    }

    public function registerCompany($data)
    {
        $email = isset($data['email']) ? preg_replace('/\s+/', '', $data['email']) : '';
        $password = isset($data['password']) ? $data['password'] : '';
        $name = isset($data['name']) ? htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') : '';
        $data_user = [
            'uid' => uniqid(),
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role_id' => 3,
            'email'=> $email,
            'name'=> $name,
        ];

        $condition = ['email' => $data['email']];
        $verify_email = $this->modelBase->select('users', $condition);
        
        if ($verify_email) {    
            $this->redirect('/register/company?error=1');
        }

        $this->modelBase->beginTransaction();

        $id_user_created = $this->modelBase->insert('users', $data_user);
        if ($id_user_created) {
            $name = isset($data['name']) ? htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') : '';
            $description = isset($data['description']) ? htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8') :'';
            $website = isset($data['website']) ? filter_var($data['website'], FILTER_SANITIZE_URL) : '';
            $email = isset($data['email']) ? filter_var($data['email'], FILTER_SANITIZE_EMAIL) : '';
            $contact_name = isset($data['contact_name']) ? htmlspecialchars($data['contact_name'], ENT_QUOTES, 'UTF-8') : '';
            $contact_position = isset($data['contact_position']) ? htmlspecialchars($data['contact_position'], ENT_QUOTES, 'UTF-8') : '';
            $contact_email = isset($data['contact_email']) ? filter_var($data['contact_email'], FILTER_SANITIZE_EMAIL) : '';
            $contact_phone = isset($data['contact_phone']) ? htmlspecialchars($data['contact_phone'], ENT_QUOTES, 'UTF-8') : '';
            $data_company_profile = [   
                'user_id'=> $id_user_created,
                'name'=> $name,
                'description'=> $description,
                'website'=> $website,
                'logo_url'=> 'assets/img/avatars/default.png',
                'logo_url_completa'=> SYSTEM_BASE_DIR . 'assets/img/avatars/default.png',
                'mail'=> $email,
                'contact_name' => $contact_name,
                'contact_position' => $contact_position,
                'contact_email' => $contact_email,
                'contact_phone' => $contact_phone
            ];
            $result = $this->modelBase->insert('companies', $data_company_profile);
            if ($result > 0) {
                $this->modelBase->commit();
                $this->redirect(SYSTEM_BASE_DIR . 'login?message=2');
            } else {
                $this->modelBase->rollBack();
                $this->redirect(SYSTEM_BASE_DIR . 'register/company?error=99');
            }
        }
    }

    public function changePassword($current_password, $new_password)
    {
        try {
            
            error_log($current_password .' '. $new_password);
            $response = [
                'message' => 'Error al cambiar la contraseña, no se registra',
                'success' => false
            ];
            $user = $this->modelBase->select('users', ['id' => $_SESSION['user_id']]);
            if ($user && password_verify($current_password, $user[0]['password_hash'])) {
                $data_change_password = [
                'password_hash' => password_hash($new_password, PASSWORD_DEFAULT),
                ];
                $result = $this->modelBase->update('users', $data_change_password, ['id' => $_SESSION['user_id']]);
                if ($result > 0) {
                    $response['success'] = true;
                    $response['message'] = 'Contraseña cambiada correctamente';
                } else {
                    $response['message'] = 'Error al cambiar la contraseña, no encontrado el usuario';
                }
            } else {
                $response['message'] = 'Contraseña actual incorrecta';
            }
        } catch (Exception $e) {
            $response['message'] = 'Error al cambiar la contraseña' . $e->getMessage();
        }
        return $response;
    }

    public function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        header('Cache-Control: max-age=3600, must-revalidate');
        return json_encode($data);
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    protected function render($view, $path_view, $data)
    {
        extract($data);
        require_once "$path_view/$view.php";
    }

    protected function renderError($error)
    {
        require_once "views/error.php";
    }

    // Método para procesar la petición
    public function index()
    {
        include_once 'views/front/home.php';
        // $data = [];
        // $errors = [];
        // if (isset($_POST['action'])) {
        //     $action = $_POST['action'];
        //     switch ($action) {
        //         case 'add':
        //             $data = $_POST;
        //             $errors = $this->addRecord($data);
        //             break;
        //         case 'find':
        //             $conditions = $_POST;
        //             $record = $this->findRecord($conditions);
        //             if ($record) {
        //                 $data = $record;
        //             } else {
        //                 $errors[] = "No se encontró ningún registro.";
        //             }
        //             break;
        //         case 'findAll':
        //             $conditions = $_POST;
        //             $records = $this->findRecords($conditions);
        //             if ($records) {
        //                 $data = $records;
        //             } else {
        //                 $errors[] = "No se encontraron registros.";
        //             }
        //             break;
        //         default:
        //             $errors[] = "Acción no reconocida.";
        //             break;
        //     }
        // }


        // //Si hay errores mostrarlos
        // if (!empty($errors)) {
        //     $this->renderError($errors);
        // } else {
        //     $this->render('index', __DIR__, $data);
        // }
    }

    //Metodo para llamar a la vista de la pagina de companies
    public function viewCompanies()
    {
        include_once 'views/front/pages/companies.php';
    }

    public function viewCompany($id)
    {
        $id = (int) $id;
        $company = $this->modelBase->select('companies', ['id' => $id]);
        $company = $company[0] ?? null;
        $fields = "
            jobs.id, 
            jobs.title AS title, 
            jobs.city AS location, 
            0 AS isFavorite,
            0 AS isSaved,
            CONCAT('$', FORMAT(IFNULL(jobs.salary_min, 0), 2),' - $',FORMAT(IFNULL(jobs.salary_max, 0), 2)) AS salary,
            CASE
                WHEN TIMESTAMPDIFF(SECOND, jobs.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(SECOND, jobs.created_at, NOW()), ' seconds ago')
                WHEN TIMESTAMPDIFF(MINUTE, jobs.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, jobs.created_at, NOW()), ' minutes ago')
                WHEN TIMESTAMPDIFF(HOUR, jobs.created_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, jobs.created_at, NOW()), ' hours ago')
                WHEN TIMESTAMPDIFF(DAY, jobs.created_at, NOW()) < 30 THEN CONCAT(TIMESTAMPDIFF(DAY, jobs.created_at, NOW()), ' days ago')
                WHEN TIMESTAMPDIFF(MONTH, jobs.created_at, NOW()) < 12 THEN CONCAT(TIMESTAMPDIFF(MONTH, jobs.created_at, NOW()), ' months ago')
            ELSE CONCAT(TIMESTAMPDIFF(YEAR, jobs.created_at, NOW()), ' years ago')
            END AS timeAgo,
            categories.name AS category,

            job_types.name AS job_type_name, 
            companies.description AS company_description,
            employment_types.name AS employment_type_name,
            companies.id AS idCompany,
            companies.name AS company,
            companies.Phone AS Phone,
            companies.mail AS mail,
            companies.website AS website,
            companies.logo_url AS company_logo,
            CONCAT('" . SYSTEM_BASE_DIR . "', companies.logo_url) AS logo
        ";

        $joinClause = "
            INNER JOIN categories ON jobs.category_id = categories.id 
            INNER JOIN job_types ON jobs.job_type_id = job_types.id 
            INNER JOIN employment_types ON jobs.employment_type_id = employment_types.id
            INNER JOIN companies ON jobs.company_id = companies.id
        ";

        // Definir condiciones opcionales (por ejemplo, solo trabajos activos)
        $conditions = 'jobs.is_active = 1' . " AND companies.id = $id";




        if (empty($company)) {
            $this->renderError(['No se encontró la empresa con el ID proporcionado.']);
        } else {
            // Llamar a la función selectWithFields
            $results = $this->findRecordsWithFields(
                'jobs',
                $fields,
                $conditions,
                'id DESC',
                0,
                50,
                $joinClause
            );

            $jobsCompany = [];
            foreach ($results as $job) {
                $jobsCompany[] = $job;
            }

            include_once 'views/front/pages/companiesDetail.php';
        }
    }

    /**
     * Método para llamar a la vista de la página de searchJobs
     * @param int|null $idJob, Id job 
     */
    public function viewSearchJobs(
        ?int $idJob = null
    ) {
        $results = [];
        $relatedJobs = [];
        if ($idJob !== null) {
            $results = $this->modelBase->searchJobs('', '', null, 1, $idJob);
            $relatedJobs[$idJob] = $this->modelBase->getRelatedJobs($idJob, 5);
            include_once 'views/front/pages/searchJobs.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recibir los datos del formulario
            $field_job = trim($_POST['field_job'] ?? '');
            $field_postal = trim($_POST['field_postal'] ?? ''); // Código postal o ciudad
            $field_category = trim($_POST['field_category'] ?? '');

            // Sanitizar los datos para evitar XSS
            $field_job = htmlspecialchars($field_job, ENT_QUOTES, 'UTF-8');
            $field_postal = htmlspecialchars($field_postal, ENT_QUOTES, 'UTF-8');

            // Validar que $field_category sea un número entero
            if (!empty($field_category) && !is_numeric($field_category)) {
                error_log("Error: El campo 'field_category' debe ser un número válido.");
                echo json_encode(['error' => 'El campo categoría contiene datos inválidos.']);
                exit;
            }

            // Convertir $field_category a entero si no está vacío
            $field_category = !empty($field_category) ? (int) $field_category : null;

            try {
                // Llamar a la función searchJobs con los parámetros sanitizados
                $results = $this->modelBase->searchJobs($field_job, $field_postal, $field_category, 50, null);

                foreach ($results as $result) {
                    $idJob = $result['id'];
                    $relatedJobs[$idJob] = $this->modelBase->getRelatedJobs($idJob, 5);
                }

                $resultsExternal = $this->getDataExternal->searchExternalJobs($field_job, $field_postal, $field_category);
                if ($resultsExternal) {
                    $results = array_merge($results, $resultsExternal);
                }
                // $resultsExternal = $this->searchExternal('computrabajo', $field_job, $field_postal, $field_category);
                // if ($resultsExternal) {
                //     $results = array_merge($results, $resultsExternal);
                // }
            } catch (Exception $e) {
                error_log("Error en la consulta SQL: " . $e->getMessage());
                $results = [];
            }
        } else {
            $results = [];
            $limit = 50;
            $results = $this->modelBase->searchJobs('', '', null, $limit, null);

           
            
            // $resultsExternal = $this->searchExternal('linkedin', '', '', '');
            // if ($resultsExternal) {
            //     $results = array_merge($results, $resultsExternal);
            // }
            // $resultsExternal = $this->searchExternal('computrabajo', '', '', '');
            // if ($resultsExternal) {
            //     $results = array_merge($results, $resultsExternal);
            // }

            if ($results) {
                foreach ($results as $result) {
                    $idJob = $result['id'];
                    $relatedJobs[$idJob] = $this->modelBase->getRelatedJobs($idJob, 5);
                }
            } else {
                $results = [];
            }
            $resultsExternal = $this->getDataExternal->searchExternalJobs('', '', '');
            if ($resultsExternal) {
                $results = array_merge($results, $resultsExternal);
            }
        }
        include_once 'views/front/pages/searchJobs.php';
    }

    /**
     * Funcion para buscar trabajos externos en otras paginas.
     * @param string $type Tipo de busqueda (linkedin, computrabajo)
     * @param string $field_job Palabras clave de la búsqueda
     * @param string $field_postal Ubicación de la búsqueda
     * @param string $field_category Categoría de la búsqueda
     */
    public function searchExternal($type, $field_job, $field_postal, $field_category)
    {
        $results = [];
        $search = '';
        if ($type == 'linkedin') {
            $keywords = $field_job.'%20' . $field_postal . '%20' . $field_category;
        $location = $field_postal;

        if (empty($field_postal)) {
            $location = 'Venezuela';
        }
        $category = $field_category;
        } else if ($type == 'computrabajo') {
            // Define search URL based on provided fields
            $search = 'empleos-en-extranjero'; // Default search
            
            // Clean and format search terms
            $keywords = !empty($field_job) ? str_replace(' ', '-', trim($field_job)) : '';
            $location = !empty($field_postal) ? str_replace(' ', '-', trim($field_postal)) : '';
            
            // Build search query based on available parameters
            if (!empty($keywords) && !empty($location)) {
                $search = 'trabajo-de-' . $keywords . '-en-' . $location;
            } elseif (!empty($keywords)) {
                $search = 'trabajo-de-' . $keywords;
            } elseif (!empty($location)) {
                $search = 'empleos-en-' . $location;
            }
        }
        

       // $urlLinkedIn = "https://www.linkedin.com/jobs/search?keywords=$keywords&location=$location&geoId=101490751&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0";
       $urlLinkedIn = "https://www.linkedin.com/jobs-guest/jobs/api/seeMoreJobPostings/search?keywords=$keywords&location=$location&geoId=101490751&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0&start=0";
        $urls = [
            'linkedin' => $urlLinkedIn,
            'computrabajo' => 'https://ve.computrabajo.com/' . $search,
        ];

        if ($type == 'linkedin') {
            $client = new Client();
            try {
                // Crear un array de promesas
                $promises = [];
                foreach ($urls as $type => $url) {
                    $promises[$type] = $client->getAsync($url, [
                        'headers' => [
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                            'Accept-Language' => 'es-ES,es;q=0.9',
                            'Connection' => 'close',
                            'Cache-Control' => 'max-age=3600, must-revalidate',
                            'Pragma' => 'cache',
                        ],
                    ]);
                }

                // Esperar a que todas las promesas se resuelvan
                $results = Promise\Utils::settle($promises)->wait();

                // Procesar los resultados
                $allJobs = [];
                foreach ($results as $type => $result) {
                    if ($result['state'] === 'fulfilled') {
                        // Obtener el contenido HTML
                        $html = $result['value']->getBody()->getContents();

                        // Analizar el HTML con DomCrawler
                        $crawler = new Crawler($html);

                        // Extraer los datos relevantes
                        if ($type === 'linkedin') {
                            $count = 600000;
                            $jobs = $crawler->filter('.job-search-card')->slice(0, 10)->each(function (Crawler $node) use (&$count) {
                                $count++;
                                $linkJob = "";
                                $dataEntityUrn = $node->attr('data-entity-urn');
                                $jobId = '';
                                
                                if ($dataEntityUrn !== null) {
                                    // Extraer solo los números del formato "urn:li:jobPosting:4137048490"
                                    preg_match('/urn:li:jobPosting:(\d+)/', $dataEntityUrn, $matches);
                                    if (isset($matches[1])) {
                                        $jobId = $matches[1];
                                        $dataEntityUrn = $jobId;
                                        $linkJobLink = "https://www.linkedin.com/jobs/view/" . $jobId;
                                        $linkJob = "https://www.linkedin.com/jobs-guest/jobs/api/jobPosting/" . $jobId;
                                    }
                                }

                                $title = $node->filter('.base-search-card__title')->text();
                                $company = $node->filter('.base-search-card__subtitle')->text();
                                $location = 'No disponible';
                                $description ='';
                                if ($node->filter('.job-search-card__location')->count() > 0) {
                                    $location = $node->filter('.job-search-card__location')->text();
                                }
                                $listDate = 'No disponible';
                                if ($node->filter('time')->count() > 0) {
                                    $listDate = $node->filter('time')->text();
                                }

                                // if ($linkJob) {
                                //     $client2 = new Client();
                                //     $responseJob = $client2->request('GET', $linkJob, [
                                //         'headers' => [
                                //             'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                                //             'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                                //             'Accept-Language' => 'es-ES,es;q=0.9',
                                //             'Connection' => 'close',
                                //             'Cache-Control' => 'max-age=3600, must-revalidate',
                                //             'Pragma' => 'cache',
                                //         ],
                                //     ]);
                                //     $htmlJob = $responseJob->getBody()->getContents();
                                //     $crawlerJob = new Crawler($htmlJob);
                                //     $description = $crawlerJob->filter('.show-more-less-html__markup')->html();
                                //     $descriptionList = $crawlerJob->filter('.description__job-criteria-list')->html();
                                //     $buttonLinkHtml = "<a href='" . $linkJobLink . "' target='_blank' class='mt-6 text-blue-500 font-bold'>Postularse</a>";

                                //     $description = 
                                //         "<div class='description'>".
                                //         $description.
                                //         "</div>".
                                //         "<div class='description__job-criteria-list pt-4'><ul>" . $descriptionList . "</ul></div>".
                                //         $buttonLinkHtml;
                                // } else {
                                //     $description = '<p>
                                //         Para más información, visita el sitio web de LinkedIn en el siguiente 
                                //         <a href="' . $linkJobLink . '" target="_blank" class="text-blue-500 font-bold">enlace</a>.
                                //     </p>';
                                // }

                                // $description = '<p>
                                // Para más información, visita el sitio web de LinkedIn en el siguiente 
                                // <a href="' . $linkJob . '" target="_blank" class="text-blue-500 font-bold">enlace</a>.
                                // </p>';
                                return [
                                    'dataEntityUrn' => $dataEntityUrn,
                                    'title' => trim($title),
                                    'company_logo' => '/assets/companies/img/linkedin.svg',
                                    'description' => $description,
                                    'skills_experience'=> '',
                                    'salary'=> 'No disponible',
                                    'priority'=> 'Urgente',
                                    'logo' => SYSTEM_BASE_DIR . 'assets/companies/img/linkedin.svg',
                                    'key_responsibilities'=> '',
                                    'linkJob' => $linkJobLink,
                                    'company' => trim($company),
                                    'location' => trim($location),
                                    'timeAgo' => $listDate,
                                    'isExternal' => true,
                                    'isLinkedin' => true,
                                    'isComputrabajo' => false,
                                    'isSaved'=> 0,
                                    'isFavorite'=> 0,
                                    'isApplied'=> 0,
                                    'employment_type_name'=> 'LinkedIn',
                                    'job_type_name'=> 'Enlace externo',
                                    'category'=> 'LinkedIn',
                                    'id'=> $count,
                                ];
                            });
                        } else {
                            $jobs = [];
                        }

                        // Agregar los trabajos al array global
                        $allJobs = array_merge($allJobs, $jobs);
                    } else {
                        echo "Error al procesar la URL: $url\n";
                    }
                }
                $results = $allJobs;
                return $results;
            } catch (Exception $e) {
                error_log("Error en la consulta SQL: " . $e->getMessage());
                $results = [];
            }
        }

        if ($type == 'computrabajo') {
            $client = new Client();
            try {
                // Crear un array de promesas
                $promises = [];
                foreach ($urls as $type => $url) {
                    $promises[$type] = $client->getAsync($url, [
                        'headers' => [
                            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                            'Accept-Language' => 'es-ES,es;q=0.9',
                            'Connection' => 'close',
                            'Cache-Control' => 'no-cache',
                            'Pragma' => 'no-cache',
                        ],
                    ]);
                }

                // Esperar a que todas las promesas se resuelvan
                $results = Promise\Utils::settle($promises)->wait();

                // Procesar los resultados
                $allJobs = [];
                foreach ($results as $type => $result) {
                    if ($result['state'] === 'fulfilled') {
                        // Obtener el contenido HTML
                        $html = $result['value']->getBody()->getContents();

                        // Analizar el HTML con DomCrawler
                        $crawler = new Crawler($html);

                        // Extraer los datos relevantes
                        if ($type === 'computrabajo') {
                            $count = 700000;
                            $jobs = $crawler->filter('.box_offer')->slice(0, 10)->each(function (Crawler $node) use (&$count) {
                                $count++;
                                $linkJob = "";
                                $title = $node->filter('h2 > a.js-o-link')->text();
                                $linkJob1 = $node->filter('h2 > a.js-o-link')->attr('href');
                                $linkJob2 = $node->filter('h2 > a.js-o-link')->attr('href');
                                $dataId = $node->attr('data-id');
                                $company = '';
                                if ($node->filter('p.dFlex.vm_fx.fs16.fc_base.mt5 a.fc_base.t_ellipsis')->count() > 0) {
                                    $company = $node->filter('p.dFlex.vm_fx.fs16.fc_base.mt5 a.fc_base.t_ellipsis')->text();
                                } else {
                                    $company = 'No disponible';
                                }
                                $location = 'No disponible';
                                if ($node->filter('p.fs16.fc_base.mt5 span')->count() > 0) {
                                    $location = $node->filter('p.fs16.fc_base.mt5 span')->text();
                                } else {
                                    $location = 'No disponible';
                                }
                                $listDate = ""; //p.fs13.fc_aux
                                if ($node->filter('p.fs13.fc_aux')->count() > 0) {
                                    $listDate = $node->filter('p.fs13.fc_aux')->text();
                                    $listDate = trim($listDate);
                                } else {
                                    $listDate = 'No disponible';
                                }


                                if ($linkJob1) {
                                    $linkJob = "https://ve.computrabajo.com" . $linkJob1;
                                }
                                if ($linkJob2) {
                                    $linkJob = "https://ve.computrabajo.com" . $linkJob2;
                                }

                                // Extraer el salario
                                $salary = '';
                                if ($node->filter('.fs13.mt15 .icon.i_salary')->count() > 0) {
                                    // El salario está en el texto dentro del mismo contenedor que el ícono
                                    $salary = $node->filter('.fs13.mt15 span.dIB')->eq(0)->text();
                                    $salary = trim(preg_replace('/\s+/', ' ', $salary)); // Limpiar espacios extra
                                } else {
                                    $salary = 'No disponible';
                                }

                                return [
                                    'title' => trim($title),
                                    'company_logo' => '/assets/companies/img/computrabajo.webp',
                                    'dataEntityUrn' => $dataId,
                                    'description' => '<p>
                                        Para más información, visita el sitio web de Computrabajo en el siguiente 
                                        <a href="' . $linkJob . '" target="_blank" class="text-blue-500 font-bold">enlace</a>.
                                    </p>',
                                    'skills_experience'=> '',
                                    'salary'=> $salary,
                                    'priority'=> 'Urgente',
                                    'logo' => SYSTEM_BASE_DIR . 'assets/companies/img/computrabajo.webp',
                                    'key_responsibilities'=> '',
                                    'linkJob' => $linkJob,
                                    'company' => trim($company),
                                    'location' => trim($location),
                                    'timeAgo' => $listDate,
                                    'isExternal' => true,
                                    'isLinkedin' => false,
                                    'isComputrabajo' => true,
                                    'isSaved'=> 0,
                                    'isFavorite'=> 0,
                                    'isApplied'=> 0,
                                    'employment_type_name'=> 'Computrabajo',
                                    'job_type_name'=> 'Enlace externo',
                                    'category'=> 'Computrabajo',
                                    'id'=> $count,
                                ];
                            });
                        } else {
                            $jobs = [];
                        }

                        // Agregar los trabajos al array global
                        $allJobs = array_merge($allJobs, $jobs);
                    } else {
                        echo "Error al procesar la URL: $url\n";
                    }
                }
                $results = $allJobs;
                return $results;
            } catch (Exception $e) {
                error_log("Error en la consulta SQL: " . $e->getMessage());
                $results = [];
            }
        }
    }

    //funcion api para buscar trabajos de linkedin
    public function searchLinkedInJobsAPI($dataEntityUrn){
        try {
            $client = new Client();
            $linkJobLink = "https://www.linkedin.com/jobs/view/" . $dataEntityUrn;
            $response = $client->request('GET', 'https://www.linkedin.com/jobs-guest/jobs/api/jobPosting/' . $dataEntityUrn, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language' => 'es-ES,es;q=0.9',
                    'Connection' => 'close',
                    'Cache-Control' => 'max-age=3600, must-revalidate',
                    'Pragma' => 'cache',
                ],
            ]);
            $htmlJob = $response->getBody()->getContents();
            $crawlerJob = new Crawler($htmlJob);
            $descriptionHTML = $crawlerJob->filter('.show-more-less-html__markup')->html();
            $descriptionList = $crawlerJob->filter('.description__job-criteria-list')->html();
            $buttonLinkHtml = "<a href='" . $linkJobLink . "' target='_blank' class='mt-6 text-blue-500 font-bold'>Postularse</a>";
            $description = 
                "<div class='description description-linkedin'>".
                $descriptionHTML.
                "</div>".
                "<div class='description__job-criteria-list pt-4'><ul>" . $descriptionList . "</ul></div>".
                $buttonLinkHtml;
            $response = [
                'description' => $description,
                'linkJob' => $linkJobLink,
                'success'=> true,
            ];
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

            echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            error_log("Error en la consulta SQL: " . $e->getMessage());
            $response = [
                'success' => false,
                'message' => 'Error al buscar el trabajo. ' . $e->getMessage(),
            ];
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

            echo json_encode($response);
        }
    }

    //Funcion api para buscar trabajos en empleate
    public function searchEmplateJobsAPI($dataEntityUrn){
        try {
            $client = new Client();
            $response = $client->request('GET', "https://www.empleate.com/venezuela/ofertas/empleo/$dataEntityUrn", [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language' => 'es-ES,es;q=0.9',
                    'Connection' => 'close',
                    'Cache-Control' => 'max-age=3600, must-revalidate',
                    'Pragma' => 'cache',
                ]
            ]);
            $htmlJob = $response->getBody()->getContents();
            $crawlerJob = new Crawler($htmlJob);
            $descriptionHTML = $crawlerJob->filter('form .col-md-12.col-xs-12')->html();
            $description = "
                <div class='description-job-empleate'>
                $descriptionHTML
                </div>
            "
;            $response = [
                'description' => $description,
                'success'=> true,
            ];
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
            echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Error al buscar en computrabajo. ' . $e->getMessage(),
            ];
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
            echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }

    //Función para buscar trabajos de computrabajo
    public function searchComputrabajoJobsAPI($dataEntityUrn){
        try {
            $client = new Client();
            $response = $client->request('GET', "https://ve.computrabajo.com/OffersDetail/Print?oi=$dataEntityUrn", [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language' => 'es-ES,es;q=0.9',
                    'Connection' => 'close',
                    'Cache-Control' => 'max-age=3600, must-revalidate',
                    'Pragma' => 'cache',
                ],
            ]);
            $htmlJob = $response->getBody()->getContents();
            $crawlerJob = new Crawler($htmlJob);
            $descriptionHTML = $crawlerJob->filter('article')->html();


            $description = 
                "<div class='description description-computrabajo'>".
                $descriptionHTML.
                "</div>";
            $response = [
                'description' => $description,
                'success'=> true,
            ];
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

            echo json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Error al buscar en computrabajo. ' . $e->getMessage(),
            ];
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET');
            header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

            echo json_encode($response);
        }
    }


    

    //Función para buscar estados
    public function getEstados()
    {
        $states = $this->modelBase->selectWithFields('estados', 'id_estado, estado', '', 'id_estado ASC');
        return $states;
    }

    //Función  para obtener los municipios de un estado
    public function getMunicipios($id_estado)
    {
        $municipios = $this->modelBase->selectWithFields('municipios', 'id_municipio, municipio', "id_estado = $id_estado", 'id_municipio ASC');
        return $municipios;
    }

    //Función  para obtener las ciudades de un municipio
    public function getCities($id_estado)
    {
        $cities = $this->modelBase->selectWithFields('ciudades', 'id_ciudad, ciudad', "id_estado = $id_estado");
        return $cities;
    }

    //Función  para obtener las parroquias de un municipio
    public function getParroquias($id_municipio)
    {
        $parroquias = $this->modelBase->selectWithFields('parroquias', 'id_parroquia, parroquia', "id_municipio = $id_municipio", 'id_parroquia ASC');
        return $parroquias;
    }


    //método para ver el blog
    public function viewBlog()
    {
        include_once 'views/front/pages/blog.php';
    }

    // Método para validar datos básicos
    protected function validateData($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            if (isset($rule['required']) && $rule['required'] && empty($data[$field])) {
                $errors[] = "El campo {$field} es obligatorio.";
            }
            if (isset($rule['pattern']) && !preg_match($rule['pattern'], $data[$field])) {
                $errors[] = "El formato del campo {$field} no es válido.";
            }
        }
        return $errors;
    }

    //Método para agregar un registro en la base de datos
    protected function addRecord($table, $data, $rules)
    {
        $errors = $this->validateData($data, $rules);
        if (empty($errors)) {
            $this->modelBase->insert($table, $data);
            return true;
        } else {
            return $errors;
        }
    }

    //Método para buscar un registro en la base de datos
    public function findRecord(string $tableName, array $conditions): array
    {
        $record = $this->modelBase->select($tableName, $conditions);
        if (empty($record)) {
            return [];
        } else {
            return $record[0];
        }
    }

    //Método para buscar varios registros en la base de datos
    public function findRecords(string $tableName, array $conditions = []): array
    {
        $records = $this->modelBase->select($tableName, $conditions);
        if (empty($records)) {
            return [];
        } else {
            return $records;
        }
    }

    //Metedo para buscar registros con campos específicos
    public function findRecordsWithFields(string $tableName, string $fields, string $conditions = '', $orderBy = 'id DESC', $offset = 0, $limit = null, $joinClause = null): array
    {
        $records = $this->modelBase->selectWithFields($tableName, $fields, $conditions, $orderBy, $offset, $limit, $joinClause);
        if (empty($records)) {
            return ['Sin datos controller'];
        } else {
            return $records;
        }
    }

    public function findRecordsManual(string $query, int $offset = 0, ?int $limit = null): array
    {
        $records = $this->modelBase->selectManual($query, $offset, $limit);
        if (empty($records)) {
            return [];
        } else {
            return $records;
        }
    }

    public function saveJobAction()
    {
        header('Content-Type: application/json');

        // Leer el cuerpo de la solicitud
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);

        // Verificar si se recibió el ID del trabajo
        if (!isset($data['job_id']) || !is_numeric($data['job_id'])) {
            echo json_encode(['success' => false, 'message' => 'ID de trabajo inválido o no proporcionado.']);
            return;
        }

        $jobId = (int) $data['job_id'];

        // Continuar con el resto del código...
        $userId = $_SESSION['user_id'] ?? 8;

        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
            return;
        }

        try {
            $isSaved = $this->modelBase->saveJob($userId, $jobId);

            if ($isSaved) {
                echo json_encode(['success' => true, 'message' => 'Trabajo guardado exitosamente.']);
            } else {
                echo json_encode(['success' => true, 'message' => 'Se elimino el trabajo de sus favoritos']);
            }
        } catch (Exception $e) {
            error_log("Error al guardar el trabajo: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Error al guardar el trabajo.']);
        }
    }
}
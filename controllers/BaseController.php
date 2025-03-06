<?php
// controllers/BaseController.php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';

class BaseController {
    protected $modelBase;
    protected $configuration;

    public function __construct($pdo) {
        $this->configuration = new Config();
        $this->modelBase = new BaseModel($pdo);
    }

    protected function jsonResponse($data, $statusCode = 200) {
      http_response_code($statusCode);
      header('Content-Type: application/json');
      echo json_encode($data);
      exit;
    }

    protected function redirect($url) {
        header("Location: $url");
        exit;
    }

    protected function render($view, $path_view, $data) {
        extract($data);
        require_once "$path_view/$view.php";
    }

    protected function renderError($error) {
        require_once "views/error.php";
    }

    // Método para procesar la petición
    public function index() {
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
    public function viewCompanies() {
        include_once 'views/front/pages/companies.php';
    }

    public function viewCompany($id) {
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
     * Metodo para llamar a la vista de la pagina de searchJobs
    * @param int|null $idJob, Id job 
    */
    public function viewSearchJobs(
            ?int $idJob = null)
        {
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
            $field_category = !empty($field_category) ? (int)$field_category : null;
        
            try {
                // Llamar a la función searchJobs con los parámetros sanitizados
                $results = $this->modelBase->searchJobs($field_job, $field_postal, $field_category, 50, null);
                foreach ($results as $result) {
                    $idJob = $result['id'];
                    $relatedJobs[$idJob] = $this->modelBase->getRelatedJobs($idJob, 5);
                }
            } catch (Exception $e) {
                error_log("Error en la consulta SQL: " . $e->getMessage());
                $results = [];
            }
        } else {
            $limit = 50;
            $results = $this->modelBase->searchJobs('','',null, $limit,null);
            foreach ($results as $result) {
                $idJob = $result['id'];
                $relatedJobs[$idJob] = $this->modelBase->getRelatedJobs($idJob, 5);
            }
        }
        include_once 'views/front/pages/searchJobs.php';
    }

    //metodo para ver el blog
    public function viewBlog(){
        include_once 'views/front/pages/blog.php';
    }

    // Método para validar datos básicos
    protected function validateData($data, $rules) {
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
    protected function addRecord($table, $data, $rules) {
        $errors = $this->validateData($data, $rules);
        if (empty($errors)) {
            $this->modelBase->insert($table,$data);
            return true;
        } else {
            return $errors;
        }
    }

    //Método para buscar un registro en la base de datos
    public function findRecord(string $tableName, array $conditions): array {
        $record = $this->modelBase->select($tableName,$conditions);
        if (empty($record)) {
            return [];
        } else {
            return $record[0];
        }
    }

    //Método para buscar varios registros en la base de datos
    public function findRecords(string $tableName,array $conditions = []): array {
        $records = $this->modelBase->select($tableName, $conditions);
        if (empty($records)) {
            return [];
        } else {
            return $records;
        }
    }

    //Metedo para buscar registros con campos específicos
    public function findRecordsWithFields(string $tableName, string $fields, string $conditions = '', $orderBy = 'id DESC', $offset = 0, $limit = null, $joinClause = null): array {
        $records = $this->modelBase->selectWithFields($tableName, $fields, $conditions, $orderBy, $offset, $limit, $joinClause);
        if (empty($records)) {
            return ['Sin datos controller'];
        } else {
            return $records;
        }
    }

    public function findRecordsManual(string $query, int $offset = 0, ?int $limit = null): array {
        $records = $this->modelBase->selectManual($query, $offset, $limit);
        if (empty($records)) {
            return [];
        } else {
            return $records;
        }
    }
}
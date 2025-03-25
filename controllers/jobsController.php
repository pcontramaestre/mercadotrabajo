<?php
// controllers/jobsController.php
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require_once 'controllers/BaseController.php';

class JobsController extends BaseController
{
    private $model;

    public function __construct($pdo, $configuration = null)
    {
        parent::__construct($pdo);
        $this->model = new BaseModel($pdo);
        if ($configuration) {
            $this->configuration = $configuration;
        }
    }

    /**
     * Crear un nuevo trabajo
     */
    public function createJob()
    {
        // Verificar si el usuario está autenticado y es una empresa
        if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
            $this->sendJsonResponse(false, 'Acceso denegado. Por favor, inicia sesión como empresa.');
            return;
        }

        // Obtener datos del formulario
        $company_id = $_SESSION['company_id'];
        $title = $this->sanitizeInput($_POST['title'] ?? '');
        $job_description = $this->sanitizeInput($_POST['job_description'] ?? '');
        $category_id = intval($_POST['category_id'] ?? 0);
        $job_type_id = intval($_POST['job_type_id'] ?? 0);
        $employment_type_id = intval($_POST['employment_type_id'] ?? 0);
        $salary_min = !empty($_POST['salary_min']) ? floatval($_POST['salary_min']) : null;
        $salary_max = !empty($_POST['salary_max']) ? floatval($_POST['salary_max']) : null;
        $external_url = $this->sanitizeInput($_POST['external_url'] ?? '');
        $city = $this->sanitizeInput($_POST['city'] ?? '');
        $key_responsibilities = $this->sanitizeInput($_POST['key_responsibilities'] ?? '');
        $skills_experience = $this->sanitizeInput($_POST['skills_experience'] ?? '');
        $show_salary = isset($_POST['show_salary']) ? 1 : 0;
        $priority = $this->sanitizeInput($_POST['priority'] ?? 'Normal');
        $is_external = !empty($external_url) ? 1 : 0;

        // Validar datos requeridos
        if (empty($title) || empty($job_description) || empty($category_id) || empty($job_type_id) || empty($employment_type_id)) {
            $this->sendJsonResponse(false, 'Por favor, complete todos los campos requeridos.');
            return;
        }

        // Preparar datos para inserción
        $jobData = [
            'company_id' => $company_id,
            'title' => $title,
            'job_description' => $job_description,
            'category_id' => $category_id,
            'job_type_id' => $job_type_id,
            'employment_type_id' => $employment_type_id,
            'salary_min' => $salary_min,
            'salary_max' => $salary_max,
            'external_url' => $external_url,
            'city' => $city,
            'key_responsibilities' => $key_responsibilities,
            'skills_experience' => $skills_experience,
            'show_salary' => $show_salary,
            'priority' => $priority,
            'is_external' => $is_external,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insertar en la base de datos
        $result = $this->model->insert('jobs', $jobData);

        if ($result) {
            // Registrar en el log de auditoría
            $this->logAction('create_job', 'Creación de trabajo: ' . $title);
            $this->sendJsonResponse(true, 'Trabajo creado exitosamente', ['job_id' => $result]);
        } else {
            $this->sendJsonResponse(false, 'Error al crear el trabajo. Por favor, inténtelo de nuevo.');
        }
    }

    /**
     * Obtener todos los trabajos de una empresa
     */
    public function getCompanyJobs()
    {
        // Verificar si el usuario está autenticado y es una empresa
        if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
            if (isset($_GET['view'])) {
                echo '<div class="text-center py-10"><div class="text-red-500"><i data-lucide="alert-circle" class="w-12 h-12 mx-auto mb-4"></i><p>Acceso denegado. Por favor, inicia sesión como empresa.</p></div></div>';
            } else {
                $this->sendJsonResponse(false, 'Acceso denegado. Por favor, inicia sesión como empresa.');
            }
            return;
        }

        $company_id = $_SESSION['company_id'];
        $view = isset($_GET['view']) ? $_GET['view'] : '';
        
        // Si se solicita una vista específica (tabla o tarjetas)
        if ($view) {
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $status = isset($_GET['status']) ? $_GET['status'] : '';
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
            
            // Construir la consulta SQL base
            $sql = "SELECT j.*, c.name as category_name 
                    FROM jobs j 
                    LEFT JOIN job_categories c ON j.category_id = c.id 
                    WHERE j.company_id = :company_id";
            
            // Añadir condiciones de filtro
            $params = [':company_id' => $company_id];
            
            if (!empty($search)) {
                $sql .= " AND (j.title LIKE :search OR j.job_description LIKE :search OR c.name LIKE :search OR j.city LIKE :search)";
                $params[':search'] = "%{$search}%";
            }
            
            if ($status === 'active') {
                $sql .= " AND j.is_active = 1";
            } elseif ($status === 'inactive') {
                $sql .= " AND j.is_active = 0";
            }
            
            // Añadir ordenamiento
            switch ($sort) {
                case 'oldest':
                    $sql .= " ORDER BY j.created_at ASC";
                    break;
                case 'title_asc':
                    $sql .= " ORDER BY j.title ASC";
                    break;
                case 'title_desc':
                    $sql .= " ORDER BY j.title DESC";
                    break;
                case 'newest':
                default:
                    $sql .= " ORDER BY j.created_at DESC";
                    break;
            }
            
            try {
                // Usar la conexión del modelo
                $stmt = $this->model->getDbHelper()->getConnection()->prepare($sql);
                $stmt->execute($params);
                $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Cargar el componente de visualización de trabajos
                require_once 'views/components/html/companyJobs.php';
                $companyJobs = new CompanyJobs($view === 'grid' ? 'CARD' : 'TABLE', $jobs);
                
                // Devolver el HTML renderizado
                echo $companyJobs->render();
            } catch (PDOException $e) {
                // Registrar el error
                error_log("Error al obtener los trabajos de la empresa: " . $e->getMessage());
                echo '<div class="text-center py-10"><div class="text-red-500"><i data-lucide="alert-circle" class="w-12 h-12 mx-auto mb-4"></i><p>Error al cargar los trabajos. Por favor, inténtalo de nuevo.</p></div></div>';
            }
            return;
        }
        
        // Consultar trabajos de la empresa (para API JSON)
        $jobs = $this->model->select('jobs', ['company_id' => $company_id], 'created_at DESC');
        $this->sendJsonResponse(true, '', ['jobs' => $jobs]);
    }

    /**
     * Actualizar el estado de un trabajo (activar/desactivar)
     */
    public function updateJobStatus()
    {
        // Verificar si el usuario está autenticado y es una empresa
        if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
            $this->sendJsonResponse(false, 'Acceso denegado. Por favor, inicia sesión como empresa.');
            return;
        }

        $job_id = intval($_POST['job_id'] ?? 0);
        $is_active = intval($_POST['is_active'] ?? 0);
        $company_id = $_SESSION['company_id'];

        // Verificar que el trabajo pertenezca a la empresa
        $job = $this->model->select('jobs', ['id' => $job_id, 'company_id' => $company_id]);
        
        if (!$job) {
            $this->sendJsonResponse(false, 'No se encontró el trabajo o no tiene permisos para modificarlo.');
            return;
        }

        // Actualizar estado
        $result = $this->model->update('jobs', ['is_active' => $is_active, 'updated_at' => date('Y-m-d H:i:s')], ['id' => $job_id]);
        
        if ($result) {
            $status = $is_active ? 'activado' : 'desactivado';
            $this->logAction('update_job_status', "Trabajo $job_id $status");
            $this->sendJsonResponse(true, "Trabajo $status exitosamente");
        } else {
            $this->sendJsonResponse(false, 'Error al actualizar el estado del trabajo.');
        }
    }
    
    /**
     * Cambiar el estado de un trabajo (activar/desactivar) mediante GET
     */
    public function toggleJobStatus()
    {
        // Verificar si el usuario está autenticado y es una empresa
        if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
            $this->sendJsonResponse(false, 'Acceso denegado. Por favor, inicia sesión como empresa.');
            return;
        }

        $job_id = intval($_GET['id'] ?? 0);
        $status = intval($_GET['status'] ?? 0);
        $company_id = $_SESSION['company_id'];

        // Verificar que el trabajo pertenezca a la empresa
        $job = $this->model->select('jobs', ['id' => $job_id, 'company_id' => $company_id]);
        
        if (!$job) {
            $this->sendJsonResponse(false, 'No se encontró el trabajo o no tiene permisos para modificarlo.');
            return;
        }

        // Actualizar estado
        $result = $this->model->update('jobs', ['is_active' => $status, 'updated_at' => date('Y-m-d H:i:s')], ['id' => $job_id]);
        
        if ($result) {
            $statusText = $status ? 'activado' : 'desactivado';
            $this->logAction('toggle_job_status', "Trabajo $job_id $statusText");
            $this->sendJsonResponse(true, "Trabajo $statusText exitosamente");
        } else {
            $this->sendJsonResponse(false, 'Error al actualizar el estado del trabajo.');
        }
    }

    /**
     * Eliminar un trabajo
     */
    public function deleteJob()
    {
        // Verificar si el usuario está autenticado y es una empresa
        if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
            $this->sendJsonResponse(false, 'Acceso denegado. Por favor, inicia sesión como empresa.');
            return;
        }

        $job_id = isset($_GET['id']) ? intval($_GET['id']) : intval($_POST['job_id'] ?? 0);
        $company_id = $_SESSION['company_id'];

        // Verificar que el trabajo pertenezca a la empresa
        $job = $this->model->select('jobs', ['id' => $job_id, 'company_id' => $company_id]);
        
        if (!$job) {
            $this->sendJsonResponse(false, 'No se encontró el trabajo o no tiene permisos para eliminarlo.');
            return;
        }

        // Eliminar trabajo
        $result = $this->model->delete('jobs', ['id' => $job_id]);
        
        if ($result) {
            $this->logAction('delete_job', "Trabajo $job_id eliminado");
            $this->sendJsonResponse(true, 'Trabajo eliminado exitosamente');
        } else {
            $this->sendJsonResponse(false, 'Error al eliminar el trabajo.');
        }
    }
    
    /**
     * Obtener el formulario de edición de un trabajo
     */
    public function getJobEditForm()
    {
        // Verificar si el usuario está autenticado y es una empresa
        if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
            echo '<div class="text-center py-10"><div class="text-red-500"><i data-lucide="alert-circle" class="w-12 h-12 mx-auto mb-4"></i><p>Acceso denegado. Por favor, inicia sesión como empresa.</p></div></div>';
            return;
        }

        $job_id = intval($_GET['id'] ?? 0);
        $company_id = $_SESSION['company_id'];

        // Verificar que el trabajo pertenezca a la empresa
        $job = $this->model->select('jobs', ['id' => $job_id, 'company_id' => $company_id]);
        
        if (!$job) {
            echo '<div class="text-center py-10"><div class="text-red-500"><i data-lucide="alert-circle" class="w-12 h-12 mx-auto mb-4"></i><p>No se encontró el trabajo o no tiene permisos para editarlo.</p></div></div>';
            return;
        }
        
        // Obtener categorías, tipos de trabajo y tipos de empleo para el formulario
        $categories = $this->model->select('job_categories', [], 'name ASC');
        $jobTypes = $this->model->select('job_types', [], 'name ASC');
        $employmentTypes = $this->model->select('employment_types', [], 'name ASC');
        
        // Generar el formulario de edición
        include 'views/company/jobEditForm.php';
    }

    /**
     * Sanitizar entrada para prevenir inyección SQL
     */
    private function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Enviar respuesta JSON
     */
    private function sendJsonResponse($success, $message, $data = [])
    {
        $response = [
            'success' => $success,
            'message' => $message
        ];

        if (!empty($data)) {
            $response = array_merge($response, $data);
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    /**
     * Registrar acción en el log de auditoría
     */
    private function logAction($action, $details)
    {
        $logData = [
            'user_id' => $_SESSION['user_id'] ?? null,
            'action' => $action,
            'details' => $details,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->model->insert('audit_logs', $logData);
    }
}

// Procesar solicitudes
if (isset($_GET['action'])) {
    // Iniciar sesión si no está iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Conexión a la base de datos
    $config = new Config();
    $database = new Database($config);
    $pdo = $database->getConnection();
    $controller = new JobsController($pdo, $config);
    $action = $_GET['action'];
    
    switch ($action) {
        case 'createJob':
            $controller->createJob();
            break;
        case 'getCompanyJobs':
            $controller->getCompanyJobs();
            break;
        case 'updateJobStatus':
            $controller->updateJobStatus();
            break;
        case 'deleteJob':
            $controller->deleteJob();
            break;
        default:
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
            break;
    }
}
?>

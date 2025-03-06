<?php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require_once 'controllers/BaseController.php';

class setDataCandidateJsonController extends BaseController
{
    protected $modelBase;
    protected $configuration;

    public function __construct($pdo)
    {
        $this->configuration = new Config();
        $this->modelBase = new BaseModel($pdo);
    }
    public function saveDataResumeCandidate($action, $dataRecive)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

        session_start();
        $userId = $_SESSION['user_id'] ?? 8;

        $response = [
            'success' => false,
            'message' => 'Error general.',
            'data' => $dataRecive,
        ];

        if ($userId === null) {
            $response['message'] = 'Usuario no autenticado.';
            echo json_encode($response);
            return;
        }

        $allowedActions = ['save_education', 'save_experience', 'save_award', 'save_skill', 'delete_item', 'save_description'];
        if (!in_array($action, $allowedActions)) {
            $response['message'] = 'Acción no válida.';
            echo json_encode($response);
            return;
        }


        // Validación específica para delete_item
        if ($action === 'delete_item') {
            $type = $_POST['type'] ?? '';
            $id = $_POST['id'] ?? 0;
            //$id = filter_var($dataRecive, FILTER_VALIDATE_INT);
            if ($id === false) {
                $response['message'] = 'ID no válido.';
                echo json_encode($response);
                return;
            }
            $data = [
                'id' => $id,
                'type' => $type,
            ];
        } else if ($action === 'save_description') {
            $description = $_POST['description'] ?? '';
            $data = [
                'description' => $description,
            ];
        } else {
            $data = json_decode($dataRecive, true);
            if (!is_array($data)) {
                $response['message'] = 'Datos no válidos.';
                echo json_encode($response);
                return;
            }
        }
        //$data = json_decode($dataRecive, true);

        if (!is_array($data)) {
            $response['message'] = 'Datos no válidos.';
            echo json_encode($response);
            return;
        }
        switch ($action) {
            case 'save_education':
                $degree = isset($data['degree']) ? htmlspecialchars($data['degree'], ENT_QUOTES, 'UTF-8') : '';
                $institution = isset($data['institution']) ? htmlspecialchars($data['institution'], ENT_QUOTES, 'UTF-8') : '';
                $startYear = isset($data['startYear']) ? filter_var($data['startYear'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $endYear = isset($data['endYear']) ? filter_var($data['endYear'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $description = isset($data['description']) ? htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8') : '';

                if (isset($data['id']) && filter_var($data['id'], FILTER_VALIDATE_INT)) {
                    $dataUpdate = [
                        'degree' => $degree,
                        'institution' => $institution,
                        'start_year' => $startYear,
                        'end_year' => $endYear,
                        'description' => $description,
                    ];
                    $conditions = ['user_id' => $userId, 'id' => $data['id']];
                    $result = $this->modelBase->update('education', $dataUpdate, $conditions);
                    if ($result) {
                        $response = ['success' => true, 'id' => $data['id']];
                    } else {
                        $response['message'] = 'Error al actualizar la educación.';
                    }
                } else {
                    $dataSave = [
                        'user_id' => $userId,
                        'degree' => $degree,
                        'institution' => $institution,
                        'start_year' => $startYear,
                        'end_year' => $endYear,
                        'description' => $description,
                    ];
                    $result = $this->modelBase->insert('education', $dataSave);
                    if ($result) {
                        $response = ['success' => true, 'id' => $result];
                    } else {
                        $response['message'] = 'Error al guardar la educación.';
                    }
                }
                break;
            case 'save_experience':
                $jobTitle = isset($data['jobTitle']) ? htmlspecialchars($data['jobTitle'], ENT_QUOTES, 'UTF-8') : '';
                $company = isset($data['company']) ? htmlspecialchars($data['company'], ENT_QUOTES, 'UTF-8') : '';
                $startDate = isset($data['startDate']) ? htmlspecialchars($data['startDate'], ENT_QUOTES, 'UTF-8') : '';
                $endDate = isset($data['endDate']) ? htmlspecialchars($data['endDate'], ENT_QUOTES, 'UTF-8') : '';
                $description = isset($data['description']) ? htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8') : '';

                if (isset($data['id']) && filter_var($data['id'], FILTER_VALIDATE_INT)) {
                    $dataUpdate = [
                        'jobTitle' => $jobTitle,
                        'company' => $company,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'description' => $description,
                    ];
                    $conditions = ['user_id' => $userId, 'id' => $data['id']];
                    $result = $this->modelBase->update('experience', $dataUpdate, $conditions);
                    if ($result) {
                        $response = ['success' => true, 'id' => $data['id']];
                    } else {
                        $response['message'] = 'Error al actualizar la experiencia.';
                    }
                } else {
                    $dataSave = [
                        'user_id' => $userId,
                        'jobTitle' => $jobTitle,
                        'company' => $company,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'description' => $description,
                    ];
                    $result = $this->modelBase->insert('experience', $dataSave);
                    if ($result) {
                        $response = ['success' => true, 'id' => $result];
                    } else {
                        $response['message'] = 'Error al guardar la experiencia.';
                    }
                }
                break;
            case 'save_award':
                $title = isset($data['title']) ? htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8') : '';
                $organization = isset($data['organization']) ? htmlspecialchars($data['organization'], ENT_QUOTES, 'UTF-8') : '';
                $year = isset($data['year']) ? filter_var($data['year'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $description = isset($data['description']) ? htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8') : '';

                if (isset($data['id']) && filter_var($data['id'], FILTER_VALIDATE_INT)) {
                    $dataUpdate = [
                        'title' => $title,
                        'organization' => $organization,
                        'year' => $year,
                        'description' => $description,
                    ];
                    $conditions = ['user_id' => $userId, 'id' => $data['id']];
                    $result = $this->modelBase->update('awards', $dataUpdate, $conditions);
                    if ($result) {
                        $response = ['success' => true, 'id' => $data['id']];
                    } else {
                        $response['message'] = 'Error al actualizar el premio.';
                    }
                } else {
                    $dataSave = [
                        'user_id' => $userId,
                        'title' => $title,
                        'organization' => $organization,
                        'year' => $year,
                        'description' => $description,
                    ];
                    $result = $this->modelBase->insert('awards', $dataSave);
                    if ($result) {
                        $response = ['success' => true, 'id' => $result];
                    } else {
                        $response['message'] = 'Error al guardar el premio.';
                    }
                }
                break;

            case 'save_skill':
                $name = isset($data['name']) ? htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') : '';
                $level = isset($data['level']) ? htmlspecialchars($data['level'], ENT_QUOTES, 'UTF-8') : '';

                if (isset($data['id']) && filter_var($data['id'], FILTER_VALIDATE_INT)) {
                    $dataUpdate = [
                        'name' => $name,
                        'level' => $level,
                    ];
                    $conditions = ['user_id' => $userId, 'id' => $data['id']];
                    $result = $this->modelBase->update('skills', $dataUpdate, $conditions);
                    if ($result) {
                        $response = ['success' => true, 'id' => $data['id']];
                    } else {
                        $response['message'] = 'Error al actualizar la habilidad.';
                    }
                } else {
                    $dataSave = [
                        'user_id' => $userId,
                        'name' => $name,
                        'level' => $level,
                    ];
                    $result = $this->modelBase->insert('skills', $dataSave);
                    if ($result) {
                        $response = ['success' => true, 'id' => $result];
                    } else {
                        $response['message'] = 'Error al guardar la habilidad.';
                    }
                }
                break;
            case 'delete_item':
                $type = isset($data['type']) ? htmlspecialchars($data['type'], ENT_QUOTES, 'UTF-8') : '';
                $id = isset($data['id']) ? filter_var($data['id'], FILTER_VALIDATE_INT) : 0;

                $tableMap = ['education' => 'education', 'experience' => 'experience', 'award' => 'awards', 'skill' => 'skills'];
                $table = $tableMap[$type] ?? '';

                if (!$table) {
                    $response['message'] = 'Tipo de ítem no válido.';
                    break;
                }

                $conditions = ['user_id' => $userId, 'id' => $id];
                $result = $this->modelBase->delete($table, $conditions);

                if ($result) {
                    $response = ['success' => true, 'message' => 'Datos eliminados.'];
                } else {
                    $response['message'] = 'Error al eliminar datos.';
                }
                break;

            case 'save_description':
                $description = isset($data['description']) ? htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8') : '';

                $dataUpdate = ['description' => $description];
                $conditions = ['user_id' => $userId];
                $result = $this->modelBase->update('user_profile', $dataUpdate, $conditions);

                if ($result) {
                    $response = ['success' => true];
                } else {
                    $response['message'] = 'Error al guardar la descripción.';
                }
                break;

            default:
                $response['message'] = 'Acción no válida.';
                break;
        }

        echo json_encode($response);
    }

    public function setDataProfileCandidate($action, $dataRecive)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

        // Obtener el user_id de la sesión (ejemplo)
        session_start();
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 8;

        $response = [
            'success' => false,
            'message' => 'Error general.',
        ];

        if ($userId === null) {
            $response['message'] = 'Usuario no autenticado.';
            echo json_encode($response);
            return;
        }

        $allowedActions = ['save_social-form', 'save_contact-form', 'save_profile-form'];
        if (!in_array($action, $allowedActions)) {
            $response['message'] = 'Acción no válida.';
            echo json_encode($response);
            return;
        }

        $data = json_decode($dataRecive, true);

        if (!is_array($data)) {
            $response['message'] = 'Datos no válidos.';
            echo json_encode($response);
            return;
        }

        switch ($action) {
            case 'save_social-form':
                $facebook = isset($data['facebook']) ? filter_var($data['facebook'], FILTER_SANITIZE_URL) : '';
                $twitter = isset($data['twitter']) ? filter_var($data['twitter'], FILTER_SANITIZE_URL) : '';
                $linkedin = isset($data['linkedin']) ? filter_var($data['linkedin'], FILTER_SANITIZE_URL) : '';

                $dataUpdate = [
                    'facebook' => $facebook,
                    'twitter' => $twitter,
                    'linkedin' => $linkedin,
                ];
                $conditions = ['user_id' => $userId];
                $result = $this->modelBase->update('user_profile', $dataUpdate, $conditions);
                if ($result) {
                    $response = ['success' => true, 'message' => 'Redes guardadas'];
                } else {
                    $response = ['success' => false, 'message' => 'Error al guardar las redes.'];
                }
                break;

            case 'save_contact-form':
                $completeAddress = isset($data['complete_address']) ? htmlspecialchars($data['complete_address'], ENT_QUOTES, 'UTF-8') : '';
                $countryId = isset($data['country_id']) ? filter_var($data['country_id'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $cityId = isset($data['city_id']) ? filter_var($data['city_id'], FILTER_SANITIZE_NUMBER_INT) : 0;

                $dataUpdate = [
                    'complete_address' => $completeAddress,
                    'country_id' => $countryId,
                    'city_id' => $cityId,
                ];

                $conditions = ['user_id' => $userId];
                $result = $this->modelBase->update('user_profile', $dataUpdate, $conditions);
                if ($result) {
                    $response = ['success' => true, 'message' => 'Dirección guardada'];
                } else {
                    $response = ['success' => false, 'message' => 'Error al guardar la dirección.'];
                }
                break;

            case 'save_profile-form':
                $allowInSearchListing = isset($data['allow_in_search_listing']) && $data['allow_in_search_listing'] == 1 ? 1 : 0;
                $fullName = isset($data['full_name']) ? htmlspecialchars($data['full_name'], ENT_QUOTES, 'UTF-8') : '';
                $jobTitle = isset($data['job_title']) ? htmlspecialchars($data['job_title'], ENT_QUOTES, 'UTF-8') : '';
                $phone = isset($data['phone']) ? htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8') : '';
                $emailAddress = isset($data['email_address']) ? filter_var($data['email_address'], FILTER_SANITIZE_EMAIL) : '';
                $website = isset($data['website']) ? filter_var($data['website'], FILTER_SANITIZE_URL) : '';
                $currentSalaryRangeId = isset($data['current_salary_range_id']) ? filter_var($data['current_salary_range_id'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $expectedSalaryRangeId = isset($data['expected_salary_range_id']) ? filter_var($data['expected_salary_range_id'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $experience = isset($data['experience']) ? filter_var($data['experience'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $age = isset($data['age']) ? filter_var($data['age'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $educationLevels = isset($data['education_levels']) ? htmlspecialchars($data['education_levels'], ENT_QUOTES, 'UTF-8') : '';
                $languages = isset($data['languages']) ? htmlspecialchars($data['languages'], ENT_QUOTES, 'UTF-8') : '';
                $descriptionProfile = isset($data['description']) ? htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8') : '';

                // Manejo del logo
                $logoPath = null; // Inicializar la ruta del logo como null

                if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpName = $_FILES['logo']['tmp_name'];
                    $fileName = $_FILES['logo']['name'];
                    $fileType = $_FILES['logo']['type'];
                    $fileSize = $_FILES['logo']['size'];

                    // Validar el tipo de archivo y el tamaño (opcional)
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                    $maxFileSize = 1024 * 1024; // 1MB

                    if (!in_array($fileType, $allowedTypes) || $fileSize > $maxFileSize) {
                        $response = ['success' => false, 'message' => 'Tipo de archivo o tamaño no válido.'];
                        echo json_encode($response);
                        return;
                    }

                    // Generar un nombre de archivo único
                    $uniqueFileName = uniqid() . '_' . $fileName;

                    // Mover el archivo a una ubicación permanente
                    $uploadDir = 'uploads/'; // Directorio donde guardar los archivos
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    $uploadPath = $uploadDir . $uniqueFileName;

                    if (move_uploaded_file($fileTmpName, $uploadPath)) {
                        // El archivo se ha cargado correctamente
                        $logoPath = $uploadPath; // Guardar la ruta en la variable
                    } else {
                        $response = ['success' => false, 'message' => 'Error al cargar el archivo.'];
                        echo json_encode($response);
                        return;
                    }
                }

                $dataUpdate = [
                    'full_name' => $fullName,
                    'job_title' => $jobTitle,
                    'phone' => $phone,
                    'email_address' => $emailAddress,
                    'website' => $website,
                    'current_salary_range_id' => $currentSalaryRangeId,
                    'expected_salary_range_id' => $expectedSalaryRangeId,
                    'experience' => $experience,
                    'age' => $age,
                    'education_levels' => $educationLevels,
                    'languages' => $languages,
                    'description_profile' => $descriptionProfile,
                    'allow_in_search_listing' => $allowInSearchListing,
                ];

                // Agregar la ruta del logo si se cargó correctamente
                if ($logoPath !== null) {
                    $dataUpdate['logo_path'] = $logoPath;
                }

                $conditions = ['user_id' => $userId];
                $result = $this->modelBase->update('user_profile', $dataUpdate, $conditions);

                if ($result) {
                    $response = ['success' => true, 'message' => 'Perfil guardado'];
                } else {
                    $response = ['success' => false, 'message' => 'Error al guardar el perfil.'];
                }
                break;
        }

        echo json_encode($response);
    }
}

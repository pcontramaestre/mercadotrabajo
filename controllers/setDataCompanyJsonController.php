<?php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require_once 'controllers/BaseController.php';

class setDataCompanyJsonController extends BaseController
{
    protected $modelBase;
    protected $configuration;

   public function __construct($pdo)
   {
       $this->configuration = new Config();
       $this->modelBase = new BaseModel($pdo);
   }

   public function setDataProfileCompany($action, $dataRecive){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

        $userId = $_SESSION['company_id'] ?? null;
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
            case 'save_contact-form':
                $donde_empresa = $data['donde_empresa'] ?? 'true';
                $completeAddress = isset($data['complete_address']) ? htmlspecialchars($data['complete_address'], ENT_QUOTES, 'UTF-8') : '';
                $countryId = 1;
                $id_estado = isset($data['id_estado']) ? filter_var((int) $data['id_estado'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $id_municipio = isset($data['id_municipio']) ? filter_var((int) $data['id_municipio'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $id_parroquia = isset($data['id_parroquia']) ? filter_var((int) $data['id_parroquia'], FILTER_SANITIZE_NUMBER_INT) : 0;
                $ciudad = isset($data['ciudad']) ? htmlspecialchars($data['ciudad'], ENT_QUOTES, 'UTF-8') : '';

                $donde_empresa = filter_var($donde_empresa, FILTER_VALIDATE_BOOLEAN);

                if ($donde_empresa){
                    $estado = $this->modelBase->selectWithFields('estados', 'estado',"id_estado = $id_estado");
                    $municipio = $this->modelBase->selectWithFields('municipios', 'municipio',"id_municipio = $id_municipio");
                    $ubicacion = $estado[0]['estado'] . ', ' . $municipio[0]['municipio'];
                } else {
                    $id_estado = 0;
                    $id_municipio = 0;
                    $id_parroquia = 0;
                    $donde_empresa = 0;
                    $ubicacion = $data['localidad'];
                }

                $dataUpdate = [
                    'complete_address' => $completeAddress,
                    'country_id' => $countryId,
                    'id_estado' => $id_estado,
                    'id_municipio' => $id_municipio,
                    'id_parroquia' => $id_parroquia,
                    'ciudad' => $ciudad,
                    'is_venezuela'=> $donde_empresa,
                    'location'=> $ubicacion,
                ];

                $conditions = ['id' => $userId];
                $result = $this->modelBase->update('companies', $dataUpdate, $conditions);


                $response = $result ? 
                ['success' => true, 'message' => 'Dirección guardada'] : 
                ['success' => false, 'message' => 'Error al guardar la dirección.'];
                break;
            case 'save_social-form':
                $dataUpdate = [
                    'social_facebook' => $data['facebook'],
                    'social_x' => $data['twitter'],
                    'social_linkedin' => $data['linkedin'],
                ];
                $conditions = ['id' => $userId];
                $result = $this->modelBase->update('companies', $dataUpdate, $conditions);
                $response = $result ? 
                ['success' => true, 'message' => 'Redes Sociales guardadas'] : 
                ['success' => false, 'message' => 'Error al guardar las redes sociales.'];
                break;
            case 'save_profile-form':

                $description = $data['description'];
                $filteredDescription = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
                $safeDescription = nl2br($filteredDescription);

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

                    if (!in_array($fileType, $allowedTypes)) {
                        $response = ['success' => false, 'message' => 'Tipo de archivo no válido.'];
                        echo json_encode($response);
                        return;
                    }

                    if ($fileSize > $maxFileSize) {
                        $response = ['success' => false, 'message' => 'Tamaño de archivo no válido.'];
                        echo json_encode($response);
                        return;
                    }

                    // Generar un nombre de archivo único
                    $uniqueFileName = uniqid() . '_' . $fileName;

                    // Mover el archivo a una ubicación permanente
                    $uploadDir = 'assets/companies/img/uploads/'; // Directorio donde guardar los archivos
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    $uploadPath = $uploadDir . $uniqueFileName;

                    if (move_uploaded_file($fileTmpName, $uploadPath)) {
                        // El archivo se ha cargado correctamente
                        $logoPath = $uploadPath; // Guardar la ruta en la variable
                    } else {
                        $response = ['success' => false, 'message' => 'Error al cargar el logo de la empresa.'];
                        echo json_encode($response);
                        return;
                    }
                }


                $dataUpdate = [
                    'name' => $data['company_name'],
                    'mail' => $data['email_address'],
                    'phone' => $data['phone'],
                    'website' => $data['website'],
                    'founded_since' => $data['founded_since'],
                    'company_size' => $data['company_size'],
                    'description'=> $safeDescription,
                ];

                if ($logoPath !== null) {
                    $dataUpdate['logo_url'] = $logoPath;
                }

                $conditions = ['id' => $userId];
                $result = $this->modelBase->update('companies', $dataUpdate, $conditions);
                $response = $result ? 
                ['success' => true, 'message' => 'Perfil guardado', 'logo_url' => $logoPath, 'data' => $dataUpdate, 'FILES' => $_FILES] : 
                ['success' => false, 'message' => 'Error al guardar el perfil.'];
                break;
        }
        echo json_encode($response);
   }
}
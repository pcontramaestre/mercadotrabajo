<?php
require_once 'controllers/BaseController.php';
require_once 'config/config.php';
$configuration = new Config();
$database = new Database($configuration);
$db = $database->getConnection();
$controller = new BaseController($db);
$company_id = $_SESSION['company_id'];
$conditions = ['company_id' => $company_id];
$notifications = $controller->select('companies_notifications', $conditions, 'id DESC', 5);
$html = '';

if ($notifications) {
    foreach ($notifications as $notification) {
        $user = $controller->findRecords('user_profile', ['user_id' => $notification['user_id']]);  
        $job = $controller->findRecords('jobs', ['id' => $notification['job_id']]);
        $html .= '
            <div class="flex items-start gap-3">
                <div class="p-1 rounded-full bg-blue-100">
                    <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                        <i data-lucide="mail" class="w-4 h-4 text-blue-600"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-medium">'. $user[0]['full_name'] . ' <span class="font-normal text-gray-500">applied for a job</span></div>
                    <div class="text-sm text-blue-600 ">'. $job[0]['title'] .'</div>
                </div>
            </div>
        ';
    }
} else {
    $html = '<div class="text-center text-gray-500 py-4">No tiene notificaciones</div>';
}
?>

<div class="bg-white rounded-lg shadow-sm p-6">
    <h3 class="text-lg font-semibold mb-6">Notifications</h3>
    <div class="space-y-4">
        <?php echo $html; ?>
    </div>
</div>
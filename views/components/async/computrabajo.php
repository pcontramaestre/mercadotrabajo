<?php
require_once 'controllers/BaseController.php';
require_once 'config/config.php';
$configuration = new Config();
$database = new Database($configuration);
$db = $database->getConnection();
$controller = new BaseController($db);

$jobsComputrabajo = $controller->searchExternal('computrabajo','','', '');
?>

<div class="jobs-container auto-container grid grid-cols-3 gap-4">
    <?php 
    
    // Limitar a mostrar solo los primeros 9 trabajos
    $jobs = array_slice($jobsComputrabajo, 0, 9);
    
    foreach ($jobs as $job) { ?>
        
      <div class="job-card col-span-1 border rounded-lg p-4 shadow-md" id="job-<?php echo $job['id'] ?>">
        <div class="job-card-info">
          <h3 class="text-lg font-medium leading-none pb-4"><?php echo $job['title'] ?></h3>
          <!-- company -->
           <div class="flex flex-row items-center gap-1 pb-2">
            <i class="fas fa-building mr-1 text-gray-400"></i>
            <?php echo $job['company'] ?>
          </div>
          <!-- location -->
          <p class="text-gray-600 flex items-center gap-2 pb-4 leading-none">
            <i class="fas fa-map-marked"></i>
            <?php echo $job['location'] ?>
          </p>
          <a href="<?php echo $job['linkJob'] ?>" target="_blank" class="text-blue-500 font-bold hover:underline">Ver más</a>
        </div>
      </div>
    <?php } ?>
  </div>

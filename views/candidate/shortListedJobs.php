<?php
  if (empty($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script
  }

include_once 'config/config.php';
include_once 'views/candidate/header.php';

//data received $dataUserJobsSave, $dataUserProfile
?>
<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <section class="user-dashboard max-w-6xl mx-auto">
        <div class="dashboard-outer p-4">
            <div class="upper-title-box pb-4">
                <h3 class="text-2xl font-bold text-gray-800">Mis trabajos guardados!</h3>
                <p class="text text-gray-500 mt-1">En esta sección puedes gestionar los trabajos que has guardado.</p>
            </div>
            <div class="row">
                <div class="">
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Mis trabajos guardados</h4>
                            </div>
                            <div class="widget-content">
                                <div class="table-outer">
                                    <div class="table-outer">
                                        <table class="default-table manage-job-table">
                                            <thead>
                                                <tr>
                                                    <th>Título del trabajo</th>
                                                    <th>Fecha de guardado</th>
                                                    <th>Estado</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($dataUserJobsSave as $job) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="job-block">
                                                                <div class="inner-box">
                                                                    <div class="content">
                                                                        <span class="company-logo">
                                                                            <img alt="logo" loading="lazy" width="48" height="48" decoding="async" data-nimg="1" 
                                                                                src="<?php echo $job['logo']?>" 
                                                                                class="max-w-[48px] max-h-[48px] object-cover"
                                                                                style="color: transparent;">
                                                                        </span>
                                                                        <h4>
                                                                            <a href="
                                                                            <?php 
                                                                                echo $job['is_active'] ? SYSTEM_BASE_DIR.'searchjobs?job='.$job['id'] : '#'
                                                                            ?>"
                                                                            >
                                                                                <?php echo $job['title']?>
                                                                            </a>
                                                                        </h4>
                                                                        <ul class="flex flex-row gap-4">
                                                                            <li class="flex items-center text-sm text-gray-500">
                                                                                <i class="fas fa-briefcase pr-1"></i>
                                                                                <?php echo $job['category']?>
                                                                            </li>
                                                                            <li class="flex items-center text-sm text-gray-500">
                                                                                <i class="fas fa-map-marker-alt pr-1"></i>
                                                                                <?php echo $job['location']?>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $created_at = $job['create_at'];
                                                                $date = new DateTime($created_at);
                                                                $formatted_date = $date->format('M j, Y');
                                                                echo $formatted_date;
                                                            ?>
                                                        </td>
                                                        <td class="status">
                                                            <?php 
                                                                echo $job['is_active'] ? '<span class="active">Active</span>' : '<span class="no-active">No active</span>';
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="option-box">
                                                                <ul class="option-list">
                                                                    <li>
                                                                        <a 
                                                                            class="flex flex-row items-center justify-center boton-view"
                                                                            data-text="View job" href="<?php echo $job['is_active'] ? SYSTEM_BASE_DIR.'searchjobs?job='.$job['id'] : '#'?>">
                                                                            <i data-lucide="eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a 
                                                                            class="flex flex-row items-center justify-center boton-view"
                                                                            data-text="Delete favorite" href="#"
                                                                            data-id="<?php echo $job['is_active'] ? $job['id'] : '' ?>"
                                                                            >
                                                                            <i data-lucide="trash-2"></i>    
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
include_once 'views/candidate/footer.php';
?>
<?php
  if (empty($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script
  }

include_once 'config/config.php';
include_once 'views/candidate/header.php';

//data recibed $dataUserJobsSave, $dataUserProfile
// Array ( [0] => Array ( [id] => 3 [title] => Marketing Digital [location] => San Francisco [is_active] => 1 [isSaved] => 1 [category] => Marketing [company_logo] => assets/companies/img/company-1.webp [logo] => http://mercadotrabajo.localdev:8080/assets/companies/img/company-1.webp [create_at] => 2025-03-06 13:45:36 ) [1] => Array ( [id] => 9 [title] => Administrador de Base de Datos [location] => San Francisco [is_active] => 1 [isSaved] => 1 [category] => Developer [company_logo] => assets/companies/img/company-3.webp [logo] => http://mercadotrabajo.localdev:8080/assets/companies/img/company-3.webp [create_at] => 2025-03-06 12:02:48 ) [2] => Array ( [id] => 8 [title] => Analista de Datos [location] => San Francisco [is_active] => 1 [isSaved] => 1 [category] => Accounting / Finance [company_logo] => assets/companies/img/company-2.webp [logo] => http://mercadotrabajo.localdev:8080/assets/companies/img/company-2.webp [create_at] => 2025-03-06 11:43:48 ) [3] => Array ( [id] => 16 [title] => Analista de Recursos Humanos [location] => San Francisco [is_active] => 1 [isSaved] => 1 [category] => Human Resource [company_logo] => assets/companies/img/company-4.webp [logo] => http://mercadotrabajo.localdev:8080/assets/companies/img/company-4.webp [create_at] => 2025-03-06 11:42:29 ) [4] => Array ( [id] => 18 [title] => Diseñador de Cursos [location] => San Francisco [is_active] => 1 [isSaved] => 1 [category] => Design [company_logo] => assets/companies/img/company-5.webp [logo] => http://mercadotrabajo.localdev:8080/assets/companies/img/company-5.webp [create_at] => 2025-03-06 11:41:01 ) )

?>
<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <section class="user-dashboard max-w-6xl mx-auto">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3 class="text-2xl font-bold text-gray-800">Shortlisted jobs!</h3>
                <p class="text text-gray-500 mt-1">Ready to jump back in?</p>
            </div>
            <div class="mb-4 ms-0 show-1023"><button type="button" class="theme-btn toggle-filters"><span class="flaticon-menu-1"></span> Menu</button></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>My Favorite Jobs</h4>
                            </div>
                            <div class="widget-content">
                                <div class="table-outer">
                                    <div class="table-outer">
                                        <table class="default-table manage-job-table">
                                            <thead>
                                                <tr>
                                                    <th>Job Title</th>
                                                    <th>Date Save</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
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
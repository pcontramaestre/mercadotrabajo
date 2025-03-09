<?php
// views/components/formSearchJobs.php
require_once 'config/config.php';
require_once 'controllers/BaseController.php';
$configuration = new Config();
$database = new Database($configuration);
$db = $database->getConnection();
$controller = new BaseController($db);

//Busqueda de categorias con mas empleos
$queryManual = "SELECT 
                    categories.id AS category_id,
                    categories.name AS category_name,
                    categories.name_es AS category_name_es,
                    COUNT(jobs.id) AS job_count
                FROM 
                    jobs
                INNER JOIN categories ON jobs.category_id = categories.id
                WHERE 
                    jobs.is_active = 1
                GROUP BY 
                    categories.id, categories.name
                ORDER BY 
                    job_count DESC
                LIMIT 5";
$categories = $controller->findRecordsManual($queryManual);

?>
<form action="<?php echo SYSTEM_BASE_DIR ?>searchjobs" method="post" id="form-search-jobs">
    <div class="row">
        <div class="form-group col-lg-4 col-md-12 col-sm-12">
            <!-- <span class="icon flaticon-search-1"></span> -->
            <i class="icon fas fa-search"></i>
            <input type="text" placeholder="Job title, keywords, or company" data-translate-es="Títutlo del trabajo, palabras clave, compañia" data-translate-en="Job title, keywords, or company" name="field_job">
        </div>
        <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
            <!-- <span class="icon flaticon-map-locator"></span> -->
            <i class="icon fas fa-map-marker-alt"></i>
            <input type="text" placeholder="City or postcode" data-translate-en="City" data-translate-es="Ciudad" name="field_postal">
        </div>
        <div class="form-group col-lg-3 col-md-12 col-sm-12 category">
            <!-- <span class="icon flaticon-briefcase"></span> -->
            <i class="icon fas fa-briefcase"></i>
            <select class="chosen-single form-select" name="field_category" id="field_category">
                <option data-translate-en="All Categories" data-translate-es="Todas las Categorias" value="">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['category_id']; ?>" data-translate-en="<?php echo $category['category_name']; ?>" data-translate-es="<?php echo $category['category_name_es']; ?>">
                        <?php echo $category['category_name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-lg-2 col-md-12 col-sm-12 text-right">
            <button type="submit" class="theme-btn btn-style-one" data-translate-en="Find Jobss" data-translate-es="Buscar Trabajos">
                Find Jobs
            </button>
        </div>
    </div>
</form>

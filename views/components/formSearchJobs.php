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
                LIMIT 10";
$categories = $controller->findRecordsManual($queryManual);

?>
<form action="<?php echo SYSTEM_BASE_DIR ?>searchjobs" method="post" id="form-search-jobs">
    <div class="row">
        <div class="form-group col-lg-4 col-md-12 col-sm-12">
            <i class="icon fas fa-search"></i>
            <input type="text" placeholder="Job title, keywords, or company" data-translate-es="Título del trabajo, palabras clave, compañía" data-translate-en="Job title, keywords, or company" name="field_job">
        </div>
        <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
            <i class="icon fas fa-map-marker-alt"></i>
            <select class="chosen-single form-select" name="field_postal" id="field_postal">
                <option data-translate-en="All Locations" data-translate-es="Todas las Ubicaciones" value="United States">All Locations</option>
                <option data-translate-en="Alabama" data-translate-es="Alabama" value="Alabama">Alabama</option>
                <option data-translate-en="Alaska" data-translate-es="Alaska" value="Alaska">Alaska</option>
                <option data-translate-en="Arizona" data-translate-es="Arizona" value="Arizona">Arizona</option>
                <option data-translate-en="Arkansas" data-translate-es="Arkansas" value="Arkansas">Arkansas</option>
                <option data-translate-en="California" data-translate-es="California" value="California">California</option>
                <option data-translate-en="Colorado" data-translate-es="Colorado" value="Colorado">Colorado</option>
                <option data-translate-en="Connecticut" data-translate-es="Connecticut" value="Connecticut">Connecticut</option>
                <option data-translate-en="Delaware" data-translate-es="Delaware" value="Delaware">Delaware</option>
                <option data-translate-en="Florida" data-translate-es="Florida" value="Florida">Florida</option>
                <option data-translate-en="Georgia" data-translate-es="Georgia" value="Georgia">Georgia</option>
                <option data-translate-en="Hawaii" data-translate-es="Hawái" value="Hawaii">Hawaii</option>
                <option data-translate-en="Idaho" data-translate-es="Idaho" value="Idaho">Idaho</option>
                <option data-translate-en="Illinois" data-translate-es="Illinois" value="Illinois">Illinois</option>
                <option data-translate-en="Indiana" data-translate-es="Indiana" value="Indiana">Indiana</option>
                <option data-translate-en="Iowa" data-translate-es="Iowa" value="Iowa">Iowa</option>
                <option data-translate-en="Kansas" data-translate-es="Kansas" value="Kansas">Kansas</option>
                <option data-translate-en="Kentucky" data-translate-es="Kentucky" value="Kentucky">Kentucky</option>
                <option data-translate-en="Louisiana" data-translate-es="Luisiana" value="Louisiana">Louisiana</option>
                <option data-translate-en="Maine" data-translate-es="Maine" value="Maine">Maine</option>
                <option data-translate-en="Maryland" data-translate-es="Maryland" value="Maryland">Maryland</option>
                <option data-translate-en="Massachusetts" data-translate-es="Massachusetts" value="Massachusetts">Massachusetts</option>
                <option data-translate-en="Michigan" data-translate-es="Michigan" value="Michigan">Michigan</option>
                <option data-translate-en="Minnesota" data-translate-es="Minnesota" value="Minnesota">Minnesota</option>
                <option data-translate-en="Mississippi" data-translate-es="Mississippi" value="Mississippi">Mississippi</option>
                <option data-translate-en="Missouri" data-translate-es="Missouri" value="Missouri">Missouri</option>
                <option data-translate-en="Montana" data-translate-es="Montana" value="Montana">Montana</option>
                <option data-translate-en="Nebraska" data-translate-es="Nebraska" value="Nebraska">Nebraska</option>
                <option data-translate-en="Nevada" data-translate-es="Nevada" value="Nevada">Nevada</option>
                <option data-translate-en="New Hampshire" data-translate-es="New Hampshire" value="New Hampshire">New Hampshire</option>
                <option data-translate-en="New Jersey" data-translate-es="Nueva Jersey" value="New Jersey">New Jersey</option>
                <option data-translate-en="New Mexico" data-translate-es="Nuevo México" value="New Mexico">New Mexico</option>
                <option data-translate-en="New York" data-translate-es="Nueva York" value="New York">New York</option>
                <option data-translate-en="North Carolina" data-translate-es="Carolina del Norte" value="North Carolina">North Carolina</option>
                <option data-translate-en="North Dakota" data-translate-es="Dakota del Norte" value="North Dakota">North Dakota</option>
                <option data-translate-en="Ohio" data-translate-es="Ohio" value="Ohio">Ohio</option>
                <option data-translate-en="Oklahoma" data-translate-es="Oklahoma" value="Oklahoma">Oklahoma</option>
                <option data-translate-en="Oregon" data-translate-es="Oregón" value="Oregon">Oregon</option>
                <option data-translate-en="Pennsylvania" data-translate-es="Pensilvania" value="Pennsylvania">Pennsylvania</option>
                <option data-translate-en="Rhode Island" data-translate-es="Rhode Island" value="Rhode Island">Rhode Island</option>
                <option data-translate-en="South Carolina" data-translate-es="Carolina del Sur" value="South Carolina">South Carolina</option>
                <option data-translate-en="South Dakota" data-translate-es="Dakota del Sur" value="South Dakota">South Dakota</option>
                <option data-translate-en="Tennessee" data-translate-es="Tennessee" value="Tennessee">Tennessee</option>
                <option data-translate-en="Texas" data-translate-es="Texas" value="Texas">Texas</option>
                <option data-translate-en="Utah" data-translate-es="Utah" value="Utah">Utah</option>
                <option data-translate-en="Vermont" data-translate-es="Vermont" value="Vermont">Vermont</option>
                <option data-translate-en="Virginia" data-translate-es="Virginia" value="Virginia">Virginia</option>
                <option data-translate-en="Washington" data-translate-es="Washington" value="Washington">Washington</option>
                <option data-translate-en="West Virginia" data-translate-es="Virginia Occidental" value="West Virginia">West Virginia</option>
                <option data-translate-en="Wisconsin" data-translate-es="Wisconsin" value="Wisconsin">Wisconsin</option>
                <option data-translate-en="Wyoming" data-translate-es="Wyoming" value="Wyoming">Wyoming</option>
            </select>
            
        </div>
        <div class="form-group col-lg-3 col-md-12 col-sm-12 category">
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

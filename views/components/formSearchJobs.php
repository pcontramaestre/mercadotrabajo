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
            <!-- <span class="icon flaticon-search-1"></span> -->
            <i class="icon fas fa-search"></i>
            <input type="text" placeholder="Job title, keywords, or company" data-translate-es="Título del trabajo, palabras clave, compañía" data-translate-en="Job title, keywords, or company" name="field_job">
        </div>
        <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
            <!-- <span class="icon flaticon-map-locator"></span> -->
            <i class="icon fas fa-map-marker-alt"></i>
            <!-- <input type="text" placeholder="City or postcode" data-translate-en="City" data-translate-es="Ciudad" name="field_postal"> -->
            <select class="chosen-single form-select" name="field_postal" id="field_postal">
                <option data-translate-en="All Locations" data-translate-es="Todas las Ubicaciones" value="">All Locations</option>
                <option data-translate-en="Amazonas" data-translate-es="Amazonas" value="amazonas">Amazonas</option>
                <option data-translate-en="Anzoátegui" data-translate-es="Anzoátegui" value="anzoategui">Anzoátegui</option>
                <option data-translate-en="Apure" data-translate-es="Apure" value="apure">Apure</option>
                <option data-translate-en="Aragua" data-translate-es="Aragua" value="aragua">Aragua</option>
                <option data-translate-en="Barinas" data-translate-es="Barinas" value="barinas">Barinas</option>
                <option data-translate-en="Bolívar" data-translate-es="Bolívar" value="bolivar">Bolívar</option>
                <option data-translate-en="Carabobo" data-translate-es="Carabobo" value="carabobo">Carabobo</option>
                <option data-translate-en="Caracas" data-translate-es="Caracas" value="caracas">Caracas</option>
                <option data-translate-en="Cojedes" data-translate-es="Cojedes" value="cojedes">Cojedes</option>
                <option data-translate-en="Delta Amacuro" data-translate-es="Delta Amacuro" value="delta-amacuro">Delta Amacuro</option>
                <option data-translate-en="Falcón" data-translate-es="Falcón" value="falcon">Falcón</option>
                <option data-translate-en="Guárico" data-translate-es="Guárico" value="guarico">Guárico</option>
                <option data-translate-en="Lara" data-translate-es="Lara" value="lara">Lara</option>
                <option data-translate-en="Mérida" data-translate-es="Mérida" value="merida">Mérida</option>
                <option data-translate-en="Miranda" data-translate-es="Miranda" value="miranda">Miranda</option>
                <option data-translate-en="Monagas" data-translate-es="Monagas" value="monagas">Monagas</option>
                <option data-translate-en="Nueva Esparta" data-translate-es="Nueva Esparta" value="nueva-esparta">Nueva Esparta</option>
                <option data-translate-en="Portuguesa" data-translate-es="Portuguesa" value="portuguesa">Portuguesa</option>
                <option data-translate-en="Sucre" data-translate-es="Sucre" value="sucre">Sucre</option>
                <option data-translate-en="Táchira" data-translate-es="Táchira" value="tachira">Táchira</option>
                <option data-translate-en="Trujillo" data-translate-es="Trujillo" value="trujillo">Trujillo</option>
                <option data-translate-en="Yaracuy" data-translate-es="Yaracuy" value="yaracuy">Yaracuy</option>
                <option data-translate-en="Zulia" data-translate-es="Zulia" value="zulia">Zulia</option>
            </select>
            
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

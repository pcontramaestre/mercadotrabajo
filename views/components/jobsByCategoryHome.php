<?php
// views/components/jobsByCategoryHome.php
require_once 'controllers/BaseController.php';
require_once 'config/config.php';
$configuration = new Config();
$database = new Database($configuration);
$db = $database->getConnection();
$controller = new BaseController($db);
$categorys = $controller->findRecords('categories');

//Busqueda de categorias con mas empleos
$queryManual = "SELECT 
  categories.name AS category_name,
  categories.name_es AS category_name_es,
  categories.icon AS icon,
  categories.id AS category_id,
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
  LIMIT 6";
$categories = $controller->findRecordsManual($queryManual);
?>
<section class="layout-pb-0 jobs-category-section">
  <div class="auto-container">
    <div class="row justify-content-between align-items-end">
      <div class="col-lg-6">
        <div class="sect-title" data-aos="">
          <h2 class="fw-700 pl-2 text-3xl" data-translate-en="Jobs by category" data-translate-es="Trabajos por categoría">Jobs by category</h2>
          <div class="text mt-9 pl-2" data-translate-en="Find the best jobs in your area" data-translate-es="Encuentra los mejores trabajos en tu área">Find the best jobs in your area</div>
        </div>
      </div>
      <div class="col-auto">
        <a href="#" class="button-icon -arrow text-dark-blue">
          <span data-translate-en="Browse All" data-translate-es="Ver todas">Browse All </span><span class="fa fa-angle-right ms-1"></span></a>
      </div>
    </div>
    <div class="row grid-flex pt-50">
      <?php foreach ($categories as $category): ?>
        <div class="col-xl-auto col-lg-3 col-md-6 col-sm-12">
          <a class="icon-item -type-3 category-selected" href="javascript:void(0);" data-job-query="<?php echo $category['category_id'] ?>">
            <div class="icon-wrap">
              <?php echo $category['icon']; ?>
            </div>
            <div class="content">
              <h4 data-translate-es="<?php echo $category['category_name_es']; ?>" data-translate-en="<?php echo $category['category_name']; ?>">
                <?php echo $category['category_name']; ?>
              </h4>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const categoryLinks = document.querySelectorAll('.category-selected');
    const searchInput = document.querySelector('#form-search-jobs select[name="field_category"]');
    const searchForm = document.getElementById('form-search-jobs');

    categoryLinks.forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar la navegación por el enlace
        const jobQuery = this.getAttribute('data-job-query');
        searchInput.value = jobQuery;
        searchForm.submit();
      });
    });
  });
</script>
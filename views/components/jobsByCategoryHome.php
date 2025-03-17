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
<section class="layout-pb-md-5 layout-pb-sm-4 jobs-category-section bg-gray-50 py-12" id="jobsByCategory">
  <div class="auto-container">
    <!-- Section Header with Animation -->
    <div class="row justify-content-between align-items-end mb-8">
      <div class="col-lg-7">
        <div class="sect-title" data-aos="fade-right" data-aos-duration="800">
          <h2 class="fw-700 text-3xl mb-3 text-gray-800 relative pl-4 border-l-4 border-blue-500" 
              data-translate-en="Explore Jobs by Category" 
              data-translate-es="Explora Trabajos por Categoría">
            Explore Jobs by Category
          </h2>
          <div class="text text-gray-600 pl-4" 
               data-translate-en="Find the perfect job in your preferred industry" 
               data-translate-es="Encuentra el trabajo perfecto en tu industria preferida">
            Find the perfect job in your preferred industry
          </div>
        </div>
      </div>
      <div class="col-auto" data-aos="fade-left" data-aos-duration="800">
        <a href="#" class="button-icon -arrow text-blue-600 hover:text-blue-800 transition-colors flex items-center font-medium">
          <span data-translate-en="View All Categories" data-translate-es="Ver todas las categorías">View All Categories</span>
          <span class="fa fa-angle-right ms-2"></span>
        </a>
      </div>
    </div>
    
    <!-- Categories Grid with Uniform Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5" data-aos="fade-up" data-aos-delay="200">
      <?php foreach ($categories as $category): ?>
        <div class="category-card-wrapper h-full">
          <a class="category-card flex flex-col items-center justify-between p-6 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1 category-selected w-full h-full" 
             href="javascript:void(0);" 
             data-job-query="<?php echo $category['category_id'] ?>" 
             aria-label="<?php echo $category['category_name']; ?> jobs">
            
            <!-- Icon with Enhanced Styling -->
            <div class="icon-wrap flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-500 mb-4 transition-colors duration-300">
              <?php echo $category['icon']; ?>
            </div>
            
            <!-- Category Name -->
            <div class="content text-center w-full">
              <h4 class="font-semibold text-gray-800 mb-1 truncate max-w-full" 
                  data-translate-es="<?php echo $category['category_name_es']; ?>" 
                  data-translate-en="<?php echo $category['category_name']; ?>">
                <?php echo $category['category_name']; ?>
              </h4>
              
              <!-- Job Count Badge -->
              <span class="text-sm text-gray-500 block">
                <?php echo $category['job_count']; ?> 
                <span data-translate-en="jobs" data-translate-es="empleos">jobs</span>
              </span>
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
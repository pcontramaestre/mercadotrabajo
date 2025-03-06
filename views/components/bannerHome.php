<?php
require_once 'config/config.php';
require_once 'controllers/BaseController.php';
$configuration = new Config();
$database = new Database($configuration);
$db = $database->getConnection();
$controller = new BaseController($db);

  $query = "
    SELECT query, COUNT(*) AS total_searches
      FROM search_logs
      GROUP BY query
      ORDER BY total_searches DESC
      LIMIT 5;
  ";

  $popularJobs = $controller->findRecords($query);
?>

<section class="banner-section-four" style="background-image:url(<?php echo SYSTEM_BASE_DIR ?>assets/img/banner-home.png)">
  <div class="auto-container">
    <div class="cotnent-box">
      <div class="title-box aos-init aos-animate" data-aso-delay="500" data-aos="fade-up">
        <h3 data-translate-en="The Easiest Way to Get Your New Job" data-translate-es="La forma más fácil de conseguir un nuevo empleo">The Easiest Way to Get Your New Job</h3>
      </div>
      <div class="job-search-form aos-init aos-animate" data-aos-delay="700" data-aos="fade-up">
        <?php
          require_once 'views/components/formSearchJobs.php';
        ?>
      </div>
    </div>
    <div class="popular-searches aos-init aos-animate" data-aos="fade-up" data-aos-delay="1000"><span class="title">Popular Searches :</span> 
      <?php foreach ($popularJobs as $job): ?>
        <a href="javascript:void(0);" data-job-query="<?php echo $job['query'] ?>">
          | <?php echo strtoupper($job['query']) ?>
        </a>
      <?php endforeach; ?>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const popularSearchLinks = document.querySelectorAll('.popular-searches a');
    const searchInput = document.querySelector('#form-search-jobs input[name="field_job"]');
    const searchForm = document.getElementById('form-search-jobs');

    popularSearchLinks.forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar la navegación por el enlace
        const jobQuery = this.getAttribute('data-job-query');
        searchInput.value = jobQuery;
        searchForm.submit();
      });
    });
  });
</script>
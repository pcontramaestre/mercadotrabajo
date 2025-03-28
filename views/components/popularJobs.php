<?php
// views/components/popularJobs.php
include_once 'config/config.php';
include_once 'controllers/BaseController.php';
include_once 'views/components/html/jobCards.php';

$configuration = new Config();
$database = new Database($configuration);
$db = $database->getConnection();
$controller = new BaseController($db);

$user_id = $_SESSION['user_id'];

$fields = "
    jobs.id, 
    jobs.title AS title, 
    jobs.city as location, 
    0 AS isFavorite,
    jobs.is_external as isExternal,
    CASE 
        WHEN EXISTS (
            SELECT 1 
            FROM saved_jobs 
            WHERE saved_jobs.user_id = ".$user_id." AND saved_jobs.job_id = jobs.id
        ) THEN 1 
        ELSE 0 
    END AS isSaved,
    CONCAT('$', FORMAT(IFNULL(jobs.salary_min, 0), 2),' - $',FORMAT(IFNULL(jobs.salary_max, 0), 2)) AS salary,
    CASE
        WHEN TIMESTAMPDIFF(SECOND, jobs.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(SECOND, jobs.created_at, NOW()), ' seconds ago')
        WHEN TIMESTAMPDIFF(MINUTE, jobs.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, jobs.created_at, NOW()), ' minutes ago')
        WHEN TIMESTAMPDIFF(HOUR, jobs.created_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, jobs.created_at, NOW()), ' hours ago')
        WHEN TIMESTAMPDIFF(DAY, jobs.created_at, NOW()) < 30 THEN CONCAT(TIMESTAMPDIFF(DAY, jobs.created_at, NOW()), ' days ago')
        WHEN TIMESTAMPDIFF(MONTH, jobs.created_at, NOW()) < 12 THEN CONCAT(TIMESTAMPDIFF(MONTH, jobs.created_at, NOW()), ' months ago')
    ELSE CONCAT(TIMESTAMPDIFF(YEAR, jobs.created_at, NOW()), ' years ago')
    END AS timeAgo,
    CASE
        WHEN TIMESTAMPDIFF(SECOND, jobs.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(SECOND, jobs.created_at, NOW()), ' segundos atrás')
        WHEN TIMESTAMPDIFF(MINUTE, jobs.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, jobs.created_at, NOW()), ' minutos atrás')
        WHEN TIMESTAMPDIFF(HOUR, jobs.created_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, jobs.created_at, NOW()), ' horas atrás')
        WHEN TIMESTAMPDIFF(DAY, jobs.created_at, NOW()) < 30 THEN CONCAT(TIMESTAMPDIFF(DAY, jobs.created_at, NOW()), ' días atrás')
        WHEN TIMESTAMPDIFF(MONTH, jobs.created_at, NOW()) < 12 THEN CONCAT(TIMESTAMPDIFF(MONTH, jobs.created_at, NOW()), ' meses atrás')
        ELSE CONCAT(TIMESTAMPDIFF(YEAR, jobs.created_at, NOW()), ' años atrás')
    END AS timeAgoEs,
    categories.name AS category, 
    job_types.name AS job_type_name, 
    employment_types.name AS employment_type_name,
    companies.name AS company,
    companies.logo_url AS company_logo,
    CONCAT('" . SYSTEM_BASE_DIR . "', companies.logo_url) AS logo
";

$joinClause = "
    INNER JOIN categories ON jobs.category_id = categories.id 
    INNER JOIN job_types ON jobs.job_type_id = job_types.id 
    INNER JOIN employment_types ON jobs.employment_type_id = employment_types.id
    INNER JOIN companies ON jobs.company_id = companies.id
";

// Definir condiciones opcionales (por ejemplo, solo trabajos activos)
$conditions = 'jobs.is_active = 1';

// Llamar a la función selectWithFields
$results = $controller->findRecordsWithFields(
    'jobs',
    $fields,
    $conditions,
    'jobs.created_at DESC',
    0,
    50,
    $joinClause
);


// Codificar los resultados a JSON
$jsonResult = json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


//Busqueda de categorias con mas empleos
$queryManual = "SELECT 
                    categories.name AS category_name,
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
<div x-data="jobsData" class="mx-auto px-4 pb-16 auto-container">
    <!-- Título y Subtítulo -->
    <?php
    $titleSection = [
        'translate_es' => 'Trabajos más populares',
        'translate_en' => 'Most Popular Jobs'
    ];
    $titleSectionText = [
        'translate_es' => 'Conoce tu valor y encuentra el trabajo que califique tu vida',
        'translate_en' => 'Know your worth and find the job that qualify your life'
    ];
    include_once 'views/components/titleSections.php';
    ?>

    <!-- Pestañas -->
    <div class="section-pestanas flex justify-center space-x-2 mb-6 flex-wrap gap-2">
        <button
            @click="activeTab = 'All'"
            :class="{'bg-gray-200': activeTab === 'All'}"
            class="px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors border md:border-none">
            All
        </button>
        <?php foreach ($categories as $category): ?>
            <button
                @click="activeTab = '<?php echo $category['category_name']; ?>'"
                :class="{'bg-gray-200': activeTab === '<?php echo $category['category_name']; ?>'}"
                class="px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors border md:border-none">
                <?php echo $category['category_name']; ?>
            </button>
        <?php endforeach; ?>
    </div>
    <!-- Trabajos -->
    <!-- Trabajos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 aos-init aos-animate" data-aos="fade-up">
        <!-- Ejemplo de trabajo -->
        <template
            x-for="(job, index) in (activeTab === 'All' 
              ? jobs.slice(0, 8) 
              : jobs.filter(job => job.category === activeTab).slice(0, 8))"
            :key="job.id">
            <div class="">
                <?php
                    $clases = 'min-h-40';
                    $jobCard = new JobCards($clases);
                    echo $jobCard->render();
                ?>
            </div>
        </template>
    </div>
   
    <!-- <button @click="showMore" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg">
          Ver más
      </button> -->
</div>

<script>

    // Toast notification function
    function showToast(message, type = "success") {
        const toast = document.getElementById("toast");
        const toastMessage = document.getElementById("toast-message");

        // Set message and type
        toastMessage.textContent = message;
        toast.className = "toast";
        toast.classList.add(`toast-${type}`);

        // Show toast
        setTimeout(() => {
          toast.classList.add("show");
        }, 100);

        // Hide toast after 3 seconds
        setTimeout(() => {
          toast.classList.remove("show");
        }, 3000);
      }
</script>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("jobsData", () => ({
            activeTab: "All",
            jobs: <?php echo $jsonResult; ?>,
            limit: 10, // Límite inicial
            // isExternal: 1,
            showMore() {
                this.limit += 10; // Incrementa el límite en 10
            },
            toggleSaveJob(jobId) {
                const job = this.jobs.find(j => j.id === jobId);
                // comvertir jobId en numerico
                jobId = parseInt(jobId)

                fetch('<?php echo SYSTEM_BASE_DIR ?>save-job', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ job_id: jobId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        job.isSaved = !job.isSaved; // Actualizar el estado local
                        showToast(data.message);
                    } else {
                        showToast('Error :' + (data.message || 'Unknown error'), "error");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Ocurrió un error al guardar el trabajo. Error :' + (error || 'Unknown error'), "error");
                    alert('Ocurrió un error al guardar el trabajo.');
                });
            },
            // No lo usaremos por ahora
            get displayedJobs() {
                return this.activeTab === "All" ?
                    this.jobs.slice(0, this.limit) :
                    this.jobs
                    .filter((job) => job.category === this.activeTab)
                    .slice(0, this.limit);
            },
        }));
    });
</script>
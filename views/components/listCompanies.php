<?php
require_once 'controllers/BaseController.php';
require_once 'config/config.php';
$configuration = new Config();
$database = new Database($configuration);
$db = $database->getConnection();
$controller = new BaseController($db);
$sql = "
    SELECT 
        c.id AS company_id,
        c.name AS company_name,
        c.logo_url AS company_logo,
        c.website AS company_website,
        c.Ubicación	AS company_location,
        COUNT(j.id) AS total_jobs_published
    FROM 
        companies c
    LEFT JOIN 
        jobs j 
    ON 
        c.id = j.company_id
    WHERE 
        c.is_active = 1 AND j.is_active = 1
    GROUP BY 
        c.id, c.name
    ORDER BY 
        total_jobs_published DESC, c.name ASC
";

$results = $controller->findRecordsManual($sql);
?>

<div class="grid lg:grid-cols-2 md:grid-cols-2 xs:grid-cols-1 mx-auto px-4 pb-16 auto-container gap-4">
    <?php foreach ($results as $company): ?>
        <div class="border p-4 bg-white rounded-lg shadow-md p-4 border hover:shadow-lg transition-shadow cursor-pointer">
            <div class="single-company grid lg:grid-cols-12 md:grid-cols-1 gap-2" data-url-company="<?php echo SYSTEM_BASE_DIR ?>companies/<?php echo $company['company_id']; ?>">
                <div class="image-box col-span-3 grid align-content-center justify-center">
                    <figure class="image"><a href="companies/<?php echo $company['company_id']; ?>">
                        <img src="<?php echo SYSTEM_BASE_DIR.$company['company_logo'] ?>" alt=""></a>
                    </figure>
                </div>
                <div class="content col-span-9">
                    <div class="company-info leading-6">
                        <h2 class="font-medium text-xl"><a href="/companies/<?php echo $company['company_id']; ?>"><?php echo $company['company_name']; ?></a></h2>
                        <div>
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo $company['company_location']; ?></span>
                        </div>
                        <div>
                            <i class="fas fa-link"></i>
                            <a href="<?php echo $company['company_website']; ?>" target="_blank"><?php echo $company['company_website']; ?></a>
                        </div>
                        <div class="jobs-published float-right mt-2 bg-blue-100 text-blue-500 px-2 py-1 rounded">
                            <i class="fas fa-briefcase"></i>
                            <span><?php echo $company['total_jobs_published']; ?></span>
                            <span data-translate-es="Trabajos publicados" data-translate-en="Jobs published"> Jobs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const companyLinks = document.querySelectorAll('.single-company');
        companyLinks.forEach(link => {
            link.addEventListener('click', function() {
                const url = this.getAttribute('data-url-company');
                window.location.href = url;
            });
        });
    });
</script>
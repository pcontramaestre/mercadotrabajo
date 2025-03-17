<?php
// views/home.php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';
$titleSection = [
    'translate_es' => 'Detalle de la empresa',
    'translate_en' => 'Company details'
];
require_once 'views/components/pageTitleInternal.php';

//data recibida array $company y $jobsCompany[]

/* Data company
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `Ubicación` char(250) DEFAULT NULL,
  `Phone` char(250) DEFAULT NULL,
  `mail` char(250) DEFAULT NULL,
  `primary_industry` char(250) DEFAULT NULL,
  `company_size` char(250) DEFAULT NULL,
  `social_facebook` char(250) DEFAULT NULL,
  `social_x` char(250) DEFAULT NULL,
  `social_instagram` char(250) DEFAULT NULL,
  `social_linkedin` char(250) DEFAULT NULL,
  `notas` char(250) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
 */

$jobsCompanyJson = json_encode($jobsCompany, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>

<section class="companies-detail">
    <div class="company-detail-header bg-gray-100 p-4 mb-4">
        <div class="md:auto-container grid grid-cols-12 gap-4 items-center">
            <div class="company-detail-logo col-span-12 md:col-span-1 flex justify-center items-center">
                <img src="<?php echo SYSTEM_BASE_DIR . $company['logo_url'] ?>" alt="<?php echo $company['name'] ?>">
            </div>
            <div class="company-name col-span-12 md:col-span-11">
                <div class="company-name-inner">
                    <h1 class="text-2xl font-semibold pb-3 md:pb-0"><?php echo $company['name'] ?></h1>
                </div>
                <div class="company-data flex flex-row items-center text-sm text-gray-500 gap-4 flex-wrap">
                    <div>
                        <i class="fas fa-briefcase"></i>
                        <span><?php echo $company['primary_industry'] ?></span>
                    </div>
                    <div>
                        <i class="fas fa-users"></i>
                        <span><?php echo $company['company_size'] ?></span>
                    </div>
                    <div>
                        <i class="fas fa-map"></i>
                        <span><?php echo $company['location'] ?></span>
                    </div>
                    <div>
                        <i class="fas fa-phone"></i>
                        <span><?php echo $company['Phone'] ?></span>
                    </div>
                    <div>
                        <i class="fas fa-envelope"></i>
                        <span><?php echo $company['mail'] ?></span>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-8">
                <div class="company-detail">

                    <div class="company-detail-body">
                        <div class="company-detail-info">
                            <h2 class="text-2xl font-semibold" data-translate-en="About <?php echo $company['name'] ?>" data-translate-es="Acerca de <?php echo $company['name'] ?>">Acerca de <?php echo $company['name'] ?></h2>
                            <p><?php echo $company['description'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="company-detail-jobs">
                    <h2 class="text-2xl font-semibold mt-4 mb-4" data-translate-en="Jobs at <?php echo $company['name'] ?>" data-translate-es="Trabajos en <?php echo $company['name'] ?>">Trabajos en <?php echo $company['name'] ?></h2>
                    <div x-data="jobsData" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <template x-for="job in displayedJobs" :key="job.id">
                            <div class="job-item">
                                <div
                                    :data-url-job="'<?php echo SYSTEM_BASE_DIR . 'searchjobs?job=' ?>' + job.id"
                                    :id="'job-' + job.id"
                                    class="grid grid-cols-12 grid-rows-1 gap-2 relative  bg-white rounded-lg shadow-md p-4 border hover:shadow-lg transition-shadow cursor-pointer"
                                    data-url-job=""
                                    @click.prevent="window.location.href = $el.dataset.urlJob">
                                    <div class="col-span-2 grid justify-center align-content-center">
                                        <img
                                            :src="job.logo"
                                            alt="Company Logo"
                                            class="w-12 h-12 rounded-lg object-cover mr-2" />
                                    </div>
                                    <div class="col-span-10">
                                        <div class="col-span-10 pr-12 relative pb-2">
                                            <h2 class="text-lg font-semibold leading-6" x-text="job.title"></h2>
                                        </div>

                                        <div class="col-span-10 col-start-3 row-start-2 grid-rows-2">
                                            <div class="grid grid-cols-2 gap-2 ">
                                                <div class="col-span-1 row-start-1">
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <i class="far fa-building px-2"></i>
                                                        <span x-text="job.company"></span>
                                                    </div>
                                                </div>
                                                <div class="col-span-1 row-start-1">
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <i class="fas fa-map-marker-alt px-2"></i>
                                                        <span x-text="job.location"></span>
                                                    </div>
                                                </div>
                                                <div class="col-span-2 row-start-2">
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <i class="far fa-money-bill-alt px-2"></i>
                                                        <span x-text="job.salary"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-10 col-start-3 row-start-3">
                                            <div class="mt-2 flex space-x-2">
                                                <span
                                                    :class="{'bg-blue-100': job.tag === 'Full Time', 'bg-green-100': job.tag === 'Part Time', 'bg-yellow-100': job.tag === 'Urgent'}"
                                                    class="px-2 py-1 rounded-lg text-xs"
                                                    x-text="job.tag"></span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </template>
                    </div>
                </div>


            </div>
            <div class="col-lg-4">
                <div class="company-detail-sidebar bg-gray-100 p-4 grid grid-cols-2 gap-4">
                    <h3 class="col-span-1 font-semibold" data-translate-en="Primary industry" data-translate-es="Industria primaria">Primary industry</h3>
                    <div class="col-span-1 text-right">
                        <span><?php echo $company['primary_industry'] ?></span>
                    </div>
                    <h3 class="col-span-1 font-semibold" data-translate-en="Company size" data-translate-es="Tamaño de la empresa">Company size</h3>
                    <div class="col-span-1 text-right">
                        <span><?php echo $company['company_size'] ?></span>
                    </div>
                    <!-- Phone -->
                    <h3 class="col-span-1 font-semibold" data-translate-en="Phone" data-translate-es="Teléfono">Phone</h3>
                    <div class="col-span-1 text-right">
                        <span><?php echo $company['Phone'] ?></span>
                    </div>
                    <!-- Email -->
                    <h3 class="col-span-1 font-semibold" data-translate-en="Email" data-translate-es="Correo electrónico">Email</h3>
                    <div class="col-span-1 text-right">
                        <span><?php echo $company['mail'] ?></span>
                    </div>

                    <!-- location -->
                    <h3 class="col-span-1 font-semibold" data-translate-en="Location" data-translate-es="Ubicación">Location</h3>
                    <div class="col-span-1 text-right">
                        <span><?php echo $company['location'] ?></span>
                    </div>
                    <!-- Social networks -->
                    <h3 class="col-span-1 font-semibold" data-translate-en="Social networks" data-translate-es="Redes sociales">Social networks</h3>
                    <div class="col-span-1 text-right">
                        <a href="<?php echo $company['social_facebook'] ?>" target="_blank">
                            <i class="fab fa-facebook px-1"></i>
                        </a>
                        <a href="<?php echo $company['social_x'] ?>" target="_blank">
                            <i class="fab fa-twitter px-1"></i>
                        </a>
                        <a href="<?php echo $company['social_instagram'] ?>" target="_blank">
                            <i class="fab fa-instagram px-1"></i>
                        </a>
                        <a href="<?php echo $company['social_linkedin'] ?>" target="_blank">
                            <i class="fab fa-linkedin px-1"></i>
                        </a>
                    </div>

                    <!-- website -->
                    <div class="col-span-2 text-center">
                        <a href="<?php echo $company['website'] ?>" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="fas fa-globe"></i>
                            <span data-translate-en="Visit website" data-translate-es="Visitar sitio web">Visit website</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("jobsData", () => ({
            activeTab: "All",
            jobs: <?php echo $jobsCompanyJson; ?>,
            limit: 10, // Límite inicial
            showMore() {
                this.limit += 10; // Incrementa el límite en 10
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

<?php
include_once 'views/layout/footer.php';
?>
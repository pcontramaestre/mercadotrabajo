<?php
// views/home.php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';
$titleSection = [
    'translate_es' => 'Buscar trabajos',
    'translate_en' => 'Search Jobs'
];
require_once 'views/components/pageTitleInternal.php';
//Data recibida $results y $relatedJobs
$search = $results;
$related = $relatedJobs;

if (empty($search)) {
    $search = [];
} else {
    $countR = count($search);
    $searchJson = json_encode($search, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $relatedJobsJson = json_encode($related, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>

<div x-data="jobsData" class="mx-auto px-4 pb-16 auto-container">
    <div class="pt-3 pb-3 font-medium text-lg">
        <?php
        if (empty($search)) { ?>
            <h1 data-translate-en="No jobs were found for the search performed, but we recommend the following" data-translate-es="No se encontraron trabajos por la busqueda realizada, pero te recomendamos los siguientes" class="text-center pb-8 pt-8 text-xl">No jobs found</h1>
            <div class="grid grid-cols-12 no-trabajos-found">
                <div class="col-span-12">
                    <?php
                    include 'views/components/popularJobs.php';
                    ?>
                </div>
            </div>

        <?php } else { ?>
            <span data-translate-en="Found jobs" data-translate-es="Trabajos encontrados"></span>
            <?php echo ": $countR"; ?>
        <?php
        }
        ?>
    </div>



    <div class="grid grid-cols-10 gap-6">
        <!-- Lista de trabajos -->
        <div class="col-span-4 listado-trabajos" x-show="paginatedJobs.length > 0">
            <template x-for="(job, index) in paginatedJobs" :key="job.id">

                <div
                    :id="'job-' + job.id"
                    :tabindex="0"
                    :ref="index === 0 ? 'firstJob' : null"
                    :class="{ 'bg-yellow-100': selectedJob && selectedJob.id === job.id }"
                    class="grid grid-cols-12 grid-rows-1 gap-3 relative rounded-lg shadow-md p-4 border hover:shadow-lg transition-shadow cursor-pointer p-2 hover:bg-gray-100 mb-6 cursor-pointer p-2 hover:bg-gray-100 job-item"
                    @click="selectJob(job)">
                    <div class="col-span-12">
                        <div class="col-span-12 pr-12 relative">
                            <!-- Iconos de favoritos y guardar -->
                            <div class="flex justify-end space-x-4 absolute right-0 top-0">
                                <!-- Icono de corazón (favoritos) -->
                                <button
                                    @click="job.isFavorite = !job.isFavorite"
                                    class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i
                                        :class="{'fas text-red-500': job.isFavorite, 'far': !job.isFavorite}"
                                        class="fa-heart"></i>
                                </button>
                                <!-- Icono de guardar (bookmark) -->
                                <button
                                    @click="job.isSaved = !job.isSaved"
                                    class="text-gray-400 hover:text-blue-500 transition-colors">
                                    <i
                                        :class="{'fas text-blue-500': job.isSaved, 'far': !job.isSaved}"
                                        class="fa-bookmark"></i>
                                </button>
                            </div>

                            <h2 class="text-lg font-semibold" x-text="job.title"></h2>
                        </div>

                        <div class="col-span-12 col-start-3 row-start-2">
                            <div class="grid grid-cols-1 gap-1">
                                <div class="col-span-1">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="far fa-building px-2"></i>
                                        <span x-text="job.company"></span>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-map-marker-alt px-2"></i>
                                        <span x-text="job.location"></span>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="far fa-money-bill-alt px-2"></i>
                                        <span x-text="job.salary"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row items-center gap-4">
                            <!-- Employment type -->
                            <div class="mt-2 flex space-x-2">
                                <span
                                    :class="{'bg-blue-100': job.employment_type_name === 'Full-time', 'bg-green-100': job.employment_type_name === 'Part-time', 'bg-yellow-100': job.employment_type_name === 'Contract'}"
                                    class="px-2 py-1 rounded-lg text-xs bg-green-100"
                                    x-text="job.employment_type_name"></span>
                            </div>
                            <!-- Job Type -->
                            <div class="mt-2 flex space-x-2">
                                <span
                                    :class="{'bg-blue-100': job.job_type_name === 'Hybrid', 'bg-green-100': job.job_type_name === 'On-site', 'bg-yellow-100': job.job_type_name === 'Remote', 'bg-red-100': job.job_type_name === 'Freelance', 'bg-red-100': job.job_type_name === 'Temporary'}"
                                    class="bg-green-100 px-2 py-1 rounded-lg text-xs"
                                    x-text="job.job_type_name"></span>
                            </div>
                            <!-- Priority -->
                            <div class="mt-2 flex space-x-2">
                                <template x-if="job.priority === 'Urgent'">
                                    <span class="px-2 py-1 rounded-lg text-xs bg-red-200" x-text="job.priority"></span>
                                </template>
                                <template x-if="job.priority === 'High'">
                                    <span class="px-2 py-1 rounded-lg text-xs bg-green-100" x-text="job.priority"></span>
                                </template>
                                <!-- <span
                                    :class="{'bg-blue-100': job.priority === 'Normal', 'bg-green-100': job.priority === 'High', 'bg-red-100': job.priority === 'Urgent'}"
                                    class="px-2 py-1 rounded-lg text-xs bg-green-100"
                                    x-text="job.priority"></span> -->
                            </div>
                        </div>
                    </div>
                </div>



                <div
                    class="cursor-pointer p-2 hover:bg-gray-100"
                    :class="{ 'bg-gray-200': selectedJob && selectedJob.id === job.id }"
                    @click="selectJob(job)"
                    x-text="job.title"></div>
            </template>


            <!-- Botones de paginación -->
            <div class="flex justify-between mt-4">
                <!-- Botón Anterior -->
                <button
                    class="px-4 py-2 rounded"
                    :class="currentPage === 1 ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-600'"
                    @click="prevPage"
                    :disabled="currentPage === 1">
                    Anterior
                </button>

                <!-- Botón Siguiente -->
                <button
                    class="px-4 py-2 rounded"
                    :class="currentPage === totalPages ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-600'"
                    @click="nextPage"
                    :disabled="currentPage === totalPages">
                    Siguiente
                </button>
            </div>
        </div>

        <!-- Detalles del trabajo seleccionado -->
        <div class="col-span-6 descripcion-trabajos">
            <template x-if="selectedJob">
                <div>
                    <h2 class="text-xl font-bold" x-text="selectedJob.title"></h2>
                    <p class="text-gray-600" x-text="'Location: ' + selectedJob.location"></p>
                    <p class="text-gray-600" x-text="'Salary: ' + selectedJob.salary"></p>
                    <p class="text-gray-600" x-text="'Posted: ' + selectedJob.timeAgo"></p>
                    <p class="mt-4" x-text="'Category: ' + selectedJob.category"></p>
                    <p class="mt-4" x-text="'Job Type: ' + selectedJob.job_type_name"></p>
                    <p class="mt-4" x-text="'Employment Type: ' + selectedJob.employment_type_name"></p>
                    <p class="mt-4" x-text="'Company: ' + selectedJob.company"></p>
                    <img :src="selectedJob.logo" alt="Company Logo" class="mt-4 w-20 h-20">
                    <div class="mt-4">
                        <h3 class="font-semibold" data-translate-es="Descripción:" data-translate-en="Description:">Description:</h3>
                        <p x-html="selectedJob.description"></p>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-semibold" data-translate-es="Responsabilidades clave:" data-translate-en="Key Responsibilities:">Key Responsibilities:</h3>
                        <p x-html="selectedJob.key_responsibilities"></p>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-semibold" data-translate-es="Habilidades y experiencia:" data-translate-en="Skills & Experience:">Skills & Experience:</h3>
                        <p x-html="selectedJob.skills_experience"></p>
                    </div>
                </div>

            </template>
            <div class="jobs-related mt-4" x-data="relatedJobsData">
                <!-- Mostrar trabajos relacionados -->
                <template x-if="relatedJobs && relatedJobs[$store.selectedJobId]">
                    <div>
                        <h3 class="font-semibold pb-4" data-translate-es="Trabajos relacionados:" data-translate-en="Related Jobs:">Related Jobs:</h3>
                        <div class="grid grid-cols-1 gap-2">
                            <template x-for="job in relatedJobs[$store.selectedJobId]" :key="job.id">
                                <div
                                    :data-url-job="'<?php echo SYSTEM_BASE_DIR.'searchjobs?job=' ?>' + job.id"  
                                    @click.prevent="window.location.href = $el.dataset.urlJob"
                                    data-url-job="" 
                                    class="border rounded p-2 cursor-pointer hover:bg-gray-100" 
                                    >
                                    <h4 class="text-sm font-semibold" x-text="job.title"></h4>
                                    <p class="text-xs text-gray-500" x-text="job.city"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Mensaje si no hay trabajos relacionados -->
                <template x-if="!relatedJobs || !relatedJobs[$store.selectedJobId]">
                    <p>No hay trabajos relacionados disponibles.</p>
                </template>
            </div>
            <template x-if="!selectedJob">
                <p>No job selected.</p>
            </template>
        </div>
    </div>
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.store('selectedJobId', 0);
        console.log('Alpine initialized');
        console.log('Alpine store:', Alpine.store('selectedJobId'));

        Alpine.data("jobsData", () => ({
            jobs: <?php echo $searchJson; ?>, // Los 50 trabajos recibidos en el JSON
            selectedJob: null, // Trabajo seleccionado
            currentPage: 1, // Página actual
            perPage: 10, // Número de trabajos por página

            // Calcular el número total de páginas
            get totalPages() {
                return Math.ceil(this.jobs.length / this.perPage);
            },

            // Obtener los trabajos de la página actual
            get paginatedJobs() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                return this.jobs.slice(start, end);
            },

            // Seleccionar un trabajo
            selectJob(job) {
                this.selectedJob = job;
                this.$store.selectedJobId = job.id;
                console.log('Alpine store:', Alpine.store('selectedJobId'));
            },

            // Ir a la página anterior
            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    this.selectFirstJob(); // Seleccionar el primer trabajo de la nueva página
                    this.scrollToFirstJob();
                }
            },

            // Ir a la página siguiente
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    this.selectFirstJob(); // Seleccionar el primer trabajo de la nueva página
                    this.scrollToFirstJob();
                }
            },

            // Seleccionar el primer trabajo de la página actual
            selectFirstJob() {
                const firstJob = this.paginatedJobs[0];
                if (firstJob) {
                    this.selectJob(firstJob);
                    this.scrollToFirstJob();
                }
            },

            scrollToFirstJob() {
                // Espera a que Alpine actualice el DOM
                this.$nextTick(() => {
                    const firstJob = document.querySelector('.job-item');
                    if (firstJob) {
                        // Desplaza la vista hacia el primer registro
                        firstJob.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        // Ajuste adicional: Subir un poco más (por ejemplo, 100px)
                        const offset = 300; // Puedes ajustar este valor según sea necesario
                        window.scrollBy({
                            top: -offset,
                            behavior: 'smooth'
                        });
                        // Enfoca el primer registro
                        firstJob.focus();
                    }
                });
            },

            // Inicializar
            init() {
                if (this.jobs.length > 0) {
                    this.selectFirstJob(); // Seleccionar el primer trabajo automáticamente al cargar la página
                }
                this.$store.selectedJobId = this.selectedJob ? this.selectedJob.id : null;
            },
        }));

        Alpine.data("relatedJobsData", () => ({
            relatedJobs: <?php echo $relatedJobsJson; ?>, // Los trabajos relacionados
            selectedJobId: null, // ID del trabajo seleccionado
            selectRelatedJob(job) {
                // Lógica para seleccionar el trabajo relacionado (puedes reutilizar selectJob de jobsData)
                this.$dispatch('selectJob', job);
            },
            init() {
                this.$watch('$store.selectedJobId', (value) => {
                    this.selectedJobId = value;
                })
            }
        }));
    });
</script>

<?php
require_once 'views/layout/footer.php';
?>
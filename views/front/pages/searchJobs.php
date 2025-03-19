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
    $totalJobs = count($search);
    $searchJson = json_encode($search, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $relatedJobsJson = json_encode($related, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $clases = $countR == 1 ? 'one-job' : 'multiple-jobs';
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



    <div class="grid grid-cols-10 gap-6 <?php echo $clases; ?>">
        <!-- Lista de trabajos -->
        <div class="col-span-10 lg:col-span-4 listado-trabajos" x-show="paginatedJobs.length > 0">
            <template x-for="(job, index) in paginatedJobs" :key="job.id">

                <div
                    :id="'job-' + job.id"
                    :tabindex="0"
                    :ref="index === 0 ? 'firstJob' : null"
                    :data-dataEntityUrn="job.dataEntityUrn == null ? null : job.dataEntityUrn"
                    :data-url="'<?php echo SYSTEM_BASE_DIR ?>searchjobs?job=' + job.id"
                    :class="{ 'bg-blue2-100': selectedJob && selectedJob.id === job.id }"
                    class="grid grid-cols-12 grid-rows-1 gap-3 relative rounded-lg shadow-md p-4 border hover:shadow-lg transition-shadow cursor-pointer p-2 hover:bg-gray-100 mb-6 cursor-pointer p-2 hover:bg-gray-100 job-item"
                    @click="selectJob(job)"
                    data-url=""
                    data-dataEntityUrn=""
                    >
                    <div class="col-span-12">
                        <div class="col-span-12 pr-12 relative">
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
                                    :class="{'bg-blue-100': job.employment_type_name === 'Full-time', 
                                    'bg-green-100': job.employment_type_name === 'Part-time', 
                                    'bg-yellow-100': job.employment_type_name === 'Contract', 
                                    'bg-red-100': job.employment_type_name === 'Temporary',
                                    'bg-yellow-100': job.employment_type_name === 'LinkedIn',
                                    'bg-blue-200': job.employment_type_name === 'Computrabajo'
                                    }"
                                    class="px-2 py-1 rounded-lg text-xs bg-green-100"
                                    x-text="job.employment_type_name"></span>
                            </div>
                            <!-- Job Type -->
                            <div class="mt-2 flex space-x-2">
                                <span
                                    :class="{'bg-blue-100': job.job_type_name === 'Hybrid', 
                                    'bg-green-100': job.job_type_name === 'On-site', 
                                    'bg-yellow-100': job.job_type_name === 'Remote', 
                                    'bg-red-100': job.job_type_name === 'Freelance', 
                                    'bg-green-100': job.job_type_name === 'Enlace externo'}"
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
            <div class="flex justify-between mt-4 pagination">
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
        <div class="col-span-10 lg:col-span-6 descripcion-trabajos">
            <template x-if="selectedJob">
                <div>
                    <div class="bg-blue2-100 p-4 flex flex-column items-center">
                        <div class="text-center">
                            <img :src="selectedJob.logo" alt="Company Logo" class="w-20 h-20 mx-auto">
                            <p class="mt-1 mb-1" x-text="'Company: ' + selectedJob.company"></p>
                        </div>
                        <h2 class="text-xl font-bold text-center" x-text="selectedJob.title"></h2>
                        <div class="flex flex-row gap-2 md:gap-3 justify-center flex-wrap py-4 md:py-0">
                            <div class="flex flex-row items-center gap-1">
                                <i class="fas fa-map-marker-alt mr-1 text-gray-400"></i>
                                <span class="text-gray-600 text-[14px]" x-text="selectedJob.location"></span>
                            </div>
                            <template x-if="selectedJob.isExternal == '0'">
                                <div class="flex flex-row items-center gap-1">
                                    <i class="fas fa-money-bill-alt mr-1 text-gray-400"></i>
                                    <span class="text-gray-600 text-[14px]" x-text="selectedJob.salary"></span>
                                </div>
                            </template>
                            <div class="flex flex-row items-center gap-1">
                                <i class="far fa-clock mr-1 text-gray-400"></i>
                                <p class="text-gray-600 text-[14px]" x-text="selectedJob.timeAgo"></p>
                            </div>
                            <div class="flex flex-row items-center gap-1">
                                <i class="fas fa-briefcase mr-1 text-gray-400"></i>
                                <p class="text-gray-600 text-[14px]" x-text="selectedJob.category"></p>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <span class="px-2 py-1 rounded-lg text-xs bg-blue-200 text-blue-600" x-text="selectedJob.employment_type_name"></span>
                            <span class="px-2 py-1 rounded-lg text-xs bg-yellow-200 ml-3" x-text="selectedJob.job_type_name"></span>
                        </div>

                        <div class="btn-box mt-4 job-block-seven">
                                    <!-- Mostrar el botón "Apply For Job" solo si no se ha aplicado -->
                                    <template x-if="$store.selectedJobIsApplied == '0' && $store.isExternal == '0'">
                                        <a href="#" class="theme-btn btn-style-one" data-bs-toggle="modal"
                                        :data-bs-target="'#applyJobModal'+selectedJob.id"
                                        data-bs-target="#applyJobModal">
                                            Aplicar al trabajo
                                        </a>
                                    </template>

                                    <!-- Mostrar el botón "Apply For Job" solo si es de linkedin -->
                                    <template x-if="$store.selectedJobIsLinkedin == '1'">
                                        <a  
                                        :href="'https://www.linkedin.com/jobs/view/' + selectedJob.dataEntityUrn"
                                        class="theme-btn btn-style-one" target="_blank">
                                            Aplicar al trabajo
                                        </a>
                                    </template>

                                    <!-- Mostrar el botón "Apply For Job" solo si es de computrabajo -->
                                    <template x-if="$store.selectedJobIsComputrabajo == '1'">
                                        <a  
                                        :href="selectedJob.linkJob"
                                        class="theme-btn btn-style-one" target="_blank">
                                            Aplicar al trabajo
                                        </a>
                                    </template>

                                    <!-- Mostrar un mensaje alternativo si ya se aplicó -->
                                    <template x-if="$store.selectedJobIsApplied == '1' && $store.isExternal == '0'">
                                        <a href="#" class="theme-btn btn-style-one disabled" aria-disabled="true">
                                            Ya aplicaste a este trabajo
                                        </a>
                                    </template>

                                    <!-- Mostrar el botón de guardar solo si no es externo -->
                                    <template x-if="$store.isExternal == '0'">
                                        <button
                                            @click.stop="toggleSaveJob(selectedJob.id)"
                                            :class="{'text-blue-500': selectedJob.isSaved == '1', 'text-gray-400': selectedJob.isSaved == '0'}"
                                            class="bookmark-btn">
                                            <i
                                                :class="{'fas text-blue-500 hover:text-white': selectedJob.isSaved == '1', 'far': selectedJob.isSaved == '0'}"
                                                class="fa-bookmark far"></i>
                                        </button>
                                    </template>
                            </div>

                    </div>

                    <div class="mt-4">
                        <h3 class="font-semibold pb-2" data-translate-es="Descripción:" data-translate-en="Description:">Description:</h3>
                        <p x-html="selectedJob.description"></p>
                    </div>
                    <template x-if="selectedJob.key_responsibilities">
                        <div class="mt-4">
                            <h3 class="font-semibold" data-translate-es="Responsabilidades clave:" data-translate-en="Key Responsibilities:">Key Responsibilities:</h3>
                            <p x-html="selectedJob.key_responsibilities"></p>
                        </div>
                    </template>
                    <template x-if="selectedJob.skills_experience">
                        <div class="mt-4">
                            <h3 class="font-semibold" data-translate-es="Habilidades y experiencia:" data-translate-en="Skills & Experience:">Skills & Experience:</h3>
                            <p x-html="selectedJob.skills_experience"></p>
                        </div>
                    </template>
                </div>
            </template>

            <div class="modal fade"
                :id="'applyJobModal'+selectedJob.id"
                id="applyJobModal4" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="apply-modal-content modal-content">
                        <div class="text-center">
                            <h3 
                                :data-translate-es="'Aplicar a' + selectedJob.title"
                                :data-translate-en="'Apply for job ' + selectedJob.title"
                                class="title" x-text="'Aplicar a '+selectedJob.title"
                                >
                                Aplicar a {{selectedJob.title}}
                            </h3>
                            <button type="button" class="closed-modal" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                        </div>
                        <form
                            :data-id="selectedJob.id"
                            method="post"
                            class="default-form job-apply-form" method="post" data-id="">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="uploading-outer apply-cv-outer">
                                        <div id="uploaded-files">
                                            <!-- <select id="uploaded-my-cvs"></select> -->
                                        </div>
                                        <!-- <div class="uploadButton">
                                            <input class="uploadButton-input" accept=".doc, .docx, application/pdf" id="upload" required="" type="file" name="attachments[]">
                                            <label class="uploadButton-button ripple-effect" for="upload">Upload CV (doc, docx, pdf)</label>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea class="darma" name="cover_letter" id="cover_letter" placeholder="Message" required=""></textarea>
                                    <input type="hidden" name="job_id" :value="selectedJob.id" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="input-group checkboxes square">
                                        <input id="rememberMe" type="checkbox" name="remember-me">
                                        <label for="rememberMe" class="remember">
                                            <span class="custom-checkbox"></span> <span data-translate-es="Aceptas nuestros" data-translate-en="Accept our"></span>
                                            <span data-bs-dismiss="modal">
                                                <a href="/terms" target="_blank" data-translate-es="Términos y condiciones y política de privacidad" data-translate-en="Terms and Conditions and Privacy Policy">Terms and Conditions and Privacy Policy</a>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <button class="theme-btn btn-style-one w-100" type="submit" name="submit-form">
                                        <span data-translate-es="Aplicar al trabajo" data-translate-en="Apply for job"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="jobs-related mt-4" x-data="relatedJobsData">
                <!-- Mostrar trabajos relacionados -->
                <template x-if="relatedJobs && relatedJobs[$store.selectedJobId]">
                    <div>
                        <h3 class="font-semibold pb-4" data-translate-es="Trabajos relacionados:" data-translate-en="Related Jobs:">Related Jobs:</h3>
                        <div class="grid grid-cols-1 gap-2">
                            <template x-for="job in relatedJobs[$store.selectedJobId]" :key="job.id">
                                <div
                                    :data-url-job="'<?php echo SYSTEM_BASE_DIR . 'searchjobs?job=' ?>' + job.id"
                                    @click.prevent="window.location.href = $el.dataset.urlJob"
                                    data-url-job=""
                                    class="border rounded p-2 cursor-pointer hover:bg-gray-100">
                                    <h4 class="text-sm font-semibold" x-text="job.title"></h4>
                                    <p class="text-xs text-gray-500" x-text="job.city"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Mensaje si no hay trabajos relacionados -->
                <template x-if="!relatedJobs || !relatedJobs[$store.selectedJobId] && $store.isExternal == '0'">
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
    document.addEventListener('DOMContentLoaded', function() {
        //Abrir CV candidate
        loadFiles();

        // Escuchar el evento de envío del formulario de aplicación
        document.querySelectorAll('.job-apply-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Evitar el envío predeterminado del formulario

                const form = e.target; // Referencia al formulario actual
                const jobId = form.dataset.id; // ID del trabajo seleccionado
                const coverLetter = form.querySelector('#cover_letter').value.trim(); // Carta de presentación
                const cvSelect = form.querySelector('#uploaded-my-cvs'); // Select con los CVs cargados
                const termsCheckbox = form.querySelector('#rememberMe'); // Checkbox de términos y condiciones

                // Validar campos requeridos
                if (!cvSelect || cvSelect.value === '') {
                    showToast('Please select a CV to apply.', 'error');
                    return;
                }

                if (!coverLetter) {
                    showToast('Please write a cover letter.', 'error');
                    return;
                }

                if (!termsCheckbox.checked) {
                    showToast('You must accept the Terms and Conditions.', 'error');
                    return;
                }

                // Mostrar spinner o mensaje de carga
                const submitButton = form.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.textContent;
                submitButton.textContent = 'Submitting...';
                submitButton.disabled = true;

                // Preparar los datos para enviar al servidor
                const formData = new FormData();
                formData.append('action', 'apply_job'); // Acción para aplicar al trabajo
                formData.append('job_id', jobId); // ID del trabajo
                formData.append('cv_id', cvSelect.value); // ID del CV seleccionado
                formData.append('cover_letter', coverLetter); // Carta de presentación

                // Enviar los datos al backend
                fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/setdatacandidate', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            showToast('Application submitted successfully!', 'success');
                            form.reset(); // Limpiar el formulario
                            closeModal(form.closest('.modal')); // Cerrar el modal

                            // Actualizar el estado de isApplied en Alpine.js
                            Alpine.store('selectedJobIsApplied', 1);
                            console.log('Alpine store selectedJobIsApplied:', Alpine.store('selectedJobIsApplied'));
                        } else {
                            showToast('Error: ' + (data.message || 'Unknown error'), 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('An error occurred while submitting your application. Please try again.', 'error');
                    })
                    .finally(() => {
                        // Restaurar el botón de envío
                        submitButton.textContent = originalButtonText;
                        submitButton.disabled = false;
                    });
            });
        });

        // Función para cerrar el modal
        function closeModal(modal) {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            if (modalInstance) {
                modalInstance.hide();
            }
        }
    });

    function loadFiles() {
        fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/getdatacandidate')
            .then(response => response.json())
            .then(data => {
                const uploadedFilesContainer = document.getElementById('uploaded-files');
                uploadedFilesContainer.innerHTML = '';
                // if (data.success && data.cvs) {
                //     data.cvs.forEach(cv => {
                //         addFileToUI(cv.filename, cv.id); // Mostrar archivos del servidor
                //     });
                // } else {
                //     addFileToUI("", "");
                // }
                if (data.success && data.cvs) {
                    data.cvs.forEach(cv => addFileToUI(cv.filename, cv.id));
                } else {
                    addFileToUI(null, null); // Forzar mensaje de error
                }
            })
            .catch(error => {
                console.error('Error loading files:', error);
                showToast('Error loading your files. Please refresh the page.', 'error');
            });
    }

    function addFileToUI(filename, id) {
        const container = document.getElementById('uploaded-files');

        if (!filename && !id) {
            // Caso 1: No hay CVs cargados → Mostrar mensaje
            container.innerHTML = `
            <div class="no-cvs-message">
                <p data-bs-dismiss="modal">No tiene CVs cargados, <a href="<?php echo SYSTEM_BASE_DIR . 'dashboard/candidate/mycvmanager' ?>" target="blank" class="font-bold text-blue-500">haz clic aquí para agregar uno</a>.</p>
            </div>
        `;
        } else {
            // Caso 2: Agregar opciones al select
            let select = document.getElementById('uploaded-my-cvs');

            // Si el select no existe, crearlo
            if (!select) {
                select = document.createElement('select');
                select.id = 'uploaded-my-cvs';
                select.setAttribute('name', 'cv_id');
                select.className = 'cv-select'; // Agrega clases CSS según tu diseño
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Selecciona tu CV';
                select.appendChild(option);
                select.setAttribute('required', '');
                container.appendChild(select);
            }

            // Crear una nueva opción
            const option = document.createElement('option');
            option.value = id;
            option.textContent = filename;
            select.appendChild(option);
        }
    }

    

    document.addEventListener("alpine:init", () => {
        Alpine.store('selectedJobId', 0);
        Alpine.store('selectedJobIsApplied', 0);
        Alpine.store('selectedJobIsLinkedin', 0);
        Alpine.store('selectedJobIsComputrabajo', 0);
        Alpine.store('isExternal', 0);
        console.log('Alpine initialized');
        console.log('Alpine store:', Alpine.store('selectedJobId'));

        Alpine.data("jobsData", () => ({
            jobs: <?php echo $searchJson; ?>, // Los 50 trabajos recibidos en el JSON
            selectedJob: null, // Trabajo seleccionado
            currentPage: 1, // Página actual
            perPage: 20, // Número de trabajos por página
            // Calcular el número total de páginas
            get totalPages() {
                return Math.ceil(this.jobs.length / this.perPage);
            },

            toggleSaveJob(jobId) {
                const job = this.jobs.find(j => j.id === jobId);
                jobId = parseInt(jobId)

                fetch('<?php echo SYSTEM_BASE_DIR ?>save-job', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            job_id: jobId
                        }),
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
            // Obtener los trabajos de la página actual
            get paginatedJobs() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                return this.jobs.slice(start, end);
            },

            // Seleccionar un trabajo
            selectJob(job, firstJob = false, totalJobs = 0) {
                if (window.innerWidth < 768) {
                    if (firstJob && totalJobs == 1) {
                        this.selectedJob = job;
                        this.$store.selectedJobId = job.id;
                        this.$store.selectedJobIsApplied = job.isApplied;
                        this.$store.isExternal = job.isExternal;
                        return;
                    }

                    if (job.isExternal == '1') {
                        window.open(job.linkJob, '_blank');
                        return;
                    }

                    window.location.href = "<?php echo SYSTEM_BASE_DIR ?>searchjobs?job=" + job.id;
                } else {
                    this.selectedJob = job;
                    this.$store.selectedJobId = job.id;
                    this.$store.selectedJobIsApplied = job.isApplied;
                    this.$store.isExternal = job.isExternal;

                    if (job.isLinkedin == 'true' || job.isLinkedin == true) {
                        this.$store.selectedJobIsComputrabajo = 0;
                        this.$store.selectedJobIsLinkedin = 1;
                        job.description = '<br> Cargando...';

                        fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/searchlinkedinjobs/' + job.dataEntityUrn)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    job.description = data.description;
                                } else {
                                    job.description = 'No se pudo cargar la descripción';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                job.description = 'Ocurrió un error al cargar la descripción';
                            });
                    }

                    if (job.isComputrabajo == 'true' || job.isComputrabajo == true) {
                        this.$store.selectedJobIsComputrabajo = 1;
                        this.$store.selectedJobIsLinkedin = 0;
                        job.description = '<br> Cargando...';

                        fetch('<?php echo SYSTEM_BASE_DIR ?>api/v1/searchcomputrabajojob/' + job.dataEntityUrn)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    job.description = data.description;
                                } else {
                                    job.description = 'No se pudo cargar la descripción';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                job.description = 'Ocurrió un error al cargar la descripción';
                            });
                    }
                }


            },

            // Ir a la página anterior
            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                    if (window.innerWidth > 768) {
                        this.selectFirstJob();
                    }
                    this.scrollToFirstJob();
                }
            },

            // Ir a la página siguiente
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                    if (window.innerWidth > 768) {
                        this.selectFirstJob();
                    }
                    this.scrollToFirstJob();
                }
            },

            // Seleccionar el primer trabajo de la página actual
            selectFirstJob() {
                const firstJob = this.paginatedJobs[0];
                let totalJobs = this.jobs.length;
                if (firstJob) {
                    this.selectJob(firstJob, true, totalJobs);
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
                if (window.innerWidth > 768) {
                    if (this.jobs.length > 0) {
                        this.selectFirstJob();
                    }
                } else {
                    if (this.jobs.length == 1) {
                        this.selectFirstJob(); 
                    }
                }

                this.$store.selectedJobId = this.selectedJob ? this.selectedJob.id : null;
                this.$store.selectedJobIsApplied = this.selectedJob ? this.selectedJob.isApplied : null;
                console.log(this.jobs);
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
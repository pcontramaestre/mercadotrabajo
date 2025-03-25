<?php
if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script
}

/**
 * Data recibida
 * 
 * @param array $dataCompanyProfile - Datos del perfil de la empresa
 * @param array $dataCompanyJobs - Listado de trabajos publicados por la empresa
 */

require_once 'views/components/html/companyJobs.php';
$controllerCompanyJobs = new CompanyJobs('TABLE', $dataCompanyJobs);

include_once 'config/config.php';
include_once 'views/company/header.php';
?>

<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <div class="p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Title -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Mis Trabajos Publicados</h1>
                    <p class="text-gray-500 mt-1">Gestiona los trabajos que has publicado en la plataforma</p>
                </div>
                <a href="<?php echo SYSTEM_BASE_DIR; ?>dashboard/company/postjobs" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Publicar un trabajo
                </a>
            </div>

            <!-- Filter and Search -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="search" class="h-4 w-4 text-gray-400"></i>
                            </div>
                            <input type="text" id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" placeholder="Buscar por título, categoría...">
                        </div>
                    </div>
                    <div class="w-full md:w-48">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select id="status" name="status" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            <option value="">Todos</option>
                            <option value="active">Activos</option>
                            <option value="inactive">Inactivos</option>
                        </select>
                    </div>
                    <div class="w-full md:w-48">
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Ordenar por</label>
                        <select id="sort" name="sort" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            <option value="newest">Más recientes</option>
                            <option value="oldest">Más antiguos</option>
                            <option value="title_asc">Título (A-Z)</option>
                            <option value="title_desc">Título (Z-A)</option>
                        </select>
                    </div>
                    <div class="w-full md:w-auto self-end">
                        <button type="button" id="filter-button" class="w-full md:w-auto px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <i data-lucide="filter" class="w-4 h-4 inline-block mr-1"></i>
                            Filtrar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Toggle View -->
            <div class="flex justify-end mb-4">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button type="button" id="view-table" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-2 focus:ring-primary focus:text-primary active">
                        <i data-lucide="list" class="w-4 h-4 inline-block mr-1"></i>
                        Tabla
                    </button>
                    <button type="button" id="view-grid" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-2 focus:ring-primary focus:text-primary">
                        <i data-lucide="grid" class="w-4 h-4 inline-block mr-1"></i>
                        Tarjetas
                    </button>
                </div>
            </div>

            <!-- Jobs List -->
            <div id="jobs-container">
                <?php echo $controllerCompanyJobs->render(); ?>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Anterior
                    </a>
                    <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Siguiente
                    </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Mostrando <span class="font-medium">1</span> a <span class="font-medium">10</span> de <span class="font-medium">20</span> resultados
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Anterior</span>
                                <i data-lucide="chevron-left" class="h-5 w-5"></i>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                1
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                2
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">
                                3
                            </a>
                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                ...
                            </span>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                8
                            </a>
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Siguiente</span>
                                <i data-lucide="chevron-right" class="h-5 w-5"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal para editar trabajo -->
<div id="edit-job-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Editar Trabajo</h3>
            <button type="button" class="close-modal text-gray-400 hover:text-gray-500">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
        </div>
        <div id="edit-job-content">
            <!-- Contenido del formulario de edición se cargará aquí -->
            <div class="text-center py-10">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-primary"></div>
                <p class="mt-2 text-gray-500">Cargando...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div id="delete-confirm-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i data-lucide="alert-triangle" class="h-6 w-6 text-red-600"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">¿Eliminar este trabajo?</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Esta acción no se puede deshacer. ¿Estás seguro de que deseas eliminar este trabajo?
                </p>
            </div>
            <div class="flex justify-center gap-4 mt-4">
                <button type="button" class="close-modal px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
                <button type="button" id="confirm-delete" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Inicializar los iconos de Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Variables para almacenar el estado actual
    let currentView = 'table';
    let currentJobId = null;

    // Función para cambiar la vista entre tabla y tarjetas
    document.getElementById('view-table').addEventListener('click', function() {
        if (currentView !== 'table') {
            currentView = 'table';
            updateView();
            toggleActiveViewButton();
        }
    });

    document.getElementById('view-grid').addEventListener('click', function() {
        if (currentView !== 'grid') {
            currentView = 'grid';
            updateView();
            toggleActiveViewButton();
        }
    });

    function toggleActiveViewButton() {
        document.getElementById('view-table').classList.toggle('active', currentView === 'table');
        document.getElementById('view-grid').classList.toggle('active', currentView === 'grid');
    }

    // Función para actualizar la vista
    function updateView() {
        const jobsContainer = document.getElementById('jobs-container');
        
        // Mostrar un indicador de carga
        jobsContainer.innerHTML = '<div class="text-center py-10"><div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-primary"></div><p class="mt-2 text-gray-500">Cargando...</p></div>';
        
        // Obtener los filtros actuales
        const search = document.getElementById('search').value;
        const status = document.getElementById('status').value;
        const sort = document.getElementById('sort').value;
        
        // Realizar la solicitud AJAX para obtener los datos filtrados
        fetch(`<?php echo SYSTEM_BASE_DIR; ?>controllers/jobsController.php?action=getCompanyJobs&view=${currentView}&search=${encodeURIComponent(search)}&status=${encodeURIComponent(status)}&sort=${encodeURIComponent(sort)}`)
            .then(response => response.text())
            .then(data => {
                jobsContainer.innerHTML = data;
                // Reinicializar los iconos de Lucide después de actualizar el contenido
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            })
            .catch(error => {
                console.error('Error al cargar los trabajos:', error);
                jobsContainer.innerHTML = '<div class="text-center py-10"><div class="text-red-500"><i data-lucide="alert-circle" class="w-12 h-12 mx-auto mb-4"></i><p>Error al cargar los trabajos. Por favor, inténtalo de nuevo.</p></div></div>';
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
    }

    // Manejar el botón de filtro
    document.getElementById('filter-button').addEventListener('click', function() {
        updateView();
    });

    // Función para editar un trabajo
    window.editJob = function(jobId) {
        const modal = document.getElementById('edit-job-modal');
        const content = document.getElementById('edit-job-content');
        
        // Mostrar el modal
        modal.classList.remove('hidden');
        
        // Mostrar indicador de carga
        content.innerHTML = '<div class="text-center py-10"><div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-primary"></div><p class="mt-2 text-gray-500">Cargando...</p></div>';
        
        // Cargar el formulario de edición
        fetch(`<?php echo SYSTEM_BASE_DIR; ?>controllers/jobsController.php?action=getJobEditForm&id=${jobId}`)
            .then(response => response.text())
            .then(data => {
                content.innerHTML = data;
                // Reinicializar los iconos de Lucide
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            })
            .catch(error => {
                console.error('Error al cargar el formulario de edición:', error);
                content.innerHTML = '<div class="text-center py-10"><div class="text-red-500"><i data-lucide="alert-circle" class="w-12 h-12 mx-auto mb-4"></i><p>Error al cargar el formulario. Por favor, inténtalo de nuevo.</p></div></div>';
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
    };

    // Función para cambiar el estado de un trabajo (activar/desactivar)
    window.toggleJobStatus = function(jobId, newStatus) {
        fetch(`<?php echo SYSTEM_BASE_DIR; ?>controllers/jobsController.php?action=toggleJobStatus&id=${jobId}&status=${newStatus}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar la vista
                    updateView();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error al cambiar el estado del trabajo:', error);
                alert('Error al cambiar el estado del trabajo. Por favor, inténtalo de nuevo.');
            });
    };

    // Función para eliminar un trabajo
    window.deleteJob = function(jobId) {
        currentJobId = jobId;
        const modal = document.getElementById('delete-confirm-modal');
        modal.classList.remove('hidden');
    };

    // Manejar la confirmación de eliminación
    document.getElementById('confirm-delete').addEventListener('click', function() {
        if (currentJobId) {
            fetch(`<?php echo SYSTEM_BASE_DIR; ?>controllers/jobsController.php?action=deleteJob&id=${currentJobId}`)
                .then(response => response.json())
                .then(data => {
                    const modal = document.getElementById('delete-confirm-modal');
                    modal.classList.add('hidden');
                    
                    if (data.success) {
                        // Actualizar la vista
                        updateView();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar el trabajo:', error);
                    alert('Error al eliminar el trabajo. Por favor, inténtalo de nuevo.');
                    
                    const modal = document.getElementById('delete-confirm-modal');
                    modal.classList.add('hidden');
                });
        }
    });

    // Cerrar modales
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit-job-modal').classList.add('hidden');
            document.getElementById('delete-confirm-modal').classList.add('hidden');
        });
    });

    // Inicializar la vista al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar la vista
        toggleActiveViewButton();
    });
</script>

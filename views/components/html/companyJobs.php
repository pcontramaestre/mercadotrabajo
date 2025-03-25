<?php
/**
 * CompanyJobs Component
 * A reusable component for displaying company jobs with Alpine.js functionality
 * Basic usage:
 * $companyJobs = new CompanyJobs('CARD', $dataCompanyJobs);
 * echo $companyJobs->render();
 * With custom TYPE (TABLE, CARD)
 * $companyJobs = new CompanyJobs('TABLE', $dataCompanyJobs);
 * echo $companyJobs->render();
 * 
 * @property string $type The type of the component (TABLE, CARD)
 * @property array $dataCompanyJobs The data of the company jobs
 */

class CompanyJobs {
    private $type;
    private $dataCompanyJobs;

    public function __construct($type, $dataCompanyJobs) {
        $this->type = $type;
        $this->dataCompanyJobs = $dataCompanyJobs;
    }

    /**
     * Get the type of the component
     * @return string
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     * Get the data of the company jobs
     * @return array
     */
    public function getDataCompanyJobs() {
        return $this->dataCompanyJobs;
    }

    /**
     * Render the component based on the type
     * @return string
     */
    public function render() {
        if ($this->type === 'CARD') {
            return $this->renderCard();
        } elseif ($this->type === 'TABLE') {
            return $this->renderTable();
        } else {
            return '';
        }
    }

    /**
     * Render the component as cards
     * @return string
     */
    private function renderCard() {
        $html = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
        
        if (empty($this->dataCompanyJobs)) {
            $html .= '<div class="col-span-full text-center py-8">
                <div class="text-gray-500">
                    <i data-lucide="briefcase-x" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                    <h3 class="text-lg font-medium mb-2">No hay trabajos publicados</h3>
                    <p class="mb-4">Aún no has publicado ningún trabajo.</p>
                    <a href="' . SYSTEM_BASE_DIR . 'dashboard/company/postjobs" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Publicar un trabajo
                    </a>
                </div>
            </div>';
        } else {
            foreach ($this->dataCompanyJobs as $job) {
                $isActive = $job['is_active'] == 1;
                $statusClass = $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                $statusText = $isActive ? 'Activo' : 'Inactivo';
                
                $priorityClass = '';
                switch($job['priority']) {
                    case 'Urgent':
                        $priorityClass = 'bg-red-100 text-red-800';
                        break;
                    case 'High':
                        $priorityClass = 'bg-orange-100 text-orange-800';
                        break;
                    case 'Normal':
                        $priorityClass = 'bg-blue-100 text-blue-800';
                        break;
                    case 'Low':
                        $priorityClass = 'bg-gray-100 text-gray-800';
                        break;
                }
                
                $html .= '<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">' . htmlspecialchars($job['title']) . '</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium ' . $statusClass . '">' . $statusText . '</span>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium ' . $priorityClass . '">' . $job['priority'] . '</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">' . $job['city'] . '</span>
                        </div>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">' . htmlspecialchars(substr($job['job_description'], 0, 150)) . (strlen($job['job_description']) > 150 ? '...' : '') . '</p>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Publicado: ' . date('d/m/Y', strtotime($job['created_at'])) . '</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <a href="' . SYSTEM_BASE_DIR . 'searchjobs?job=' . $job['id'] . '" class="text-primary hover:text-primary-dark font-medium">
                                Ver detalles
                            </a>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-blue-600" onclick="editJob(' . $job['id'] . ')" title="Editar">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </button>
                                <button class="text-gray-500 hover:text-' . ($isActive ? 'red' : 'green') . '-600" onclick="toggleJobStatus(' . $job['id'] . ', ' . ($isActive ? 0 : 1) . ')" title="' . ($isActive ? 'Desactivar' : 'Activar') . '">
                                    <i data-lucide="' . ($isActive ? 'eye-off' : 'eye') . '" class="w-5 h-5"></i>
                                </button>
                                <button class="text-gray-500 hover:text-red-600" onclick="deleteJob(' . $job['id'] . ')" title="Eliminar">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
        
        $html .= '</div>';
        return $html;
    }

    /**
     * Render the component as a table
     * @return string
     */
    private function renderTable() {
        $html = '<div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Título</th>
                        <th scope="col" class="px-6 py-3">Categoría</th>
                        <th scope="col" class="px-6 py-3">Ubicación</th>
                        <th scope="col" class="px-6 py-3">Prioridad</th>
                        <th scope="col" class="px-6 py-3">Fecha</th>
                        <th scope="col" class="px-6 py-3">Estado</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>';

        if (empty($this->dataCompanyJobs)) {
            $html .= '<tr class="bg-white border-b">
                <td colspan="7" class="px-6 py-10 text-center">
                    <div class="text-gray-500">
                        <i data-lucide="briefcase-x" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                        <h3 class="text-lg font-medium mb-2">No hay trabajos publicados</h3>
                        <p class="mb-4">Aún no has publicado ningún trabajo.</p>
                        <a href="' . SYSTEM_BASE_DIR . 'dashboard/company/postjobs" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                            Publicar un trabajo
                        </a>
                    </div>
                </td>
            </tr>';
        } else {
            foreach ($this->dataCompanyJobs as $job) {
                $isActive = $job['is_active'] == 1;
                $statusClass = $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                $statusText = $isActive ? 'Activo' : 'Inactivo';
                
                $priorityClass = '';
                switch($job['priority']) {
                    case 'Urgent':
                        $priorityClass = 'bg-red-100 text-red-800';
                        break;
                    case 'High':
                        $priorityClass = 'bg-orange-100 text-orange-800';
                        break;
                    case 'Normal':
                        $priorityClass = 'bg-blue-100 text-blue-800';
                        break;
                    case 'Low':
                        $priorityClass = 'bg-gray-100 text-gray-800';
                        break;
                }
                
                $html .= '<tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        <a href="' . SYSTEM_BASE_DIR . 'searchjobs?job=' . $job['id'] . '" class="hover:text-primary">
                            ' . htmlspecialchars($job['title']) . '
                        </a>
                    </td>
                    <td class="px-6 py-4">' . ($job['category_name'] ?? 'N/A') . '</td>
                    <td class="px-6 py-4">' . htmlspecialchars($job['city']) . '</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium ' . $priorityClass . '">' . $job['priority'] . '</span>
                    </td>
                    <td class="px-6 py-4">' . date('d/m/Y', strtotime($job['created_at'])) . '</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium ' . $statusClass . '">' . $statusText . '</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-3">
                            <button class="text-gray-500 hover:text-blue-600" onclick="editJob(' . $job['id'] . ')" title="Editar">
                                <i data-lucide="edit" class="w-5 h-5"></i>
                            </button>
                            <button class="text-gray-500 hover:text-' . ($isActive ? 'red' : 'green') . '-600" onclick="toggleJobStatus(' . $job['id'] . ', ' . ($isActive ? 0 : 1) . ')" title="' . ($isActive ? 'Desactivar' : 'Activar') . '">
                                <i data-lucide="' . ($isActive ? 'eye-off' : 'eye') . '" class="w-5 h-5"></i>
                            </button>
                            <button class="text-gray-500 hover:text-red-600" onclick="deleteJob(' . $job['id'] . ')" title="Eliminar">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </td>
                </tr>';
            }
        }
        
        $html .= '</tbody></table></div>';
        return $html;
    }
}
?>

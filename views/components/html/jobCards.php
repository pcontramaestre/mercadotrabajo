<?php

/**
 * JobCards Component
 * * A reusable component for displaying job cards with Alpine.js functionality
 * * Basic usage:
 * $jobCard = new JobCards();
 * echo $jobCard->render();
 * * With custom classes:
 * $jobCard = new JobCards('custom-class');
 * echo $jobCard->render();
 * * echo JobCards::create('custom-class-here');
 * */
class JobCards {
    private $additionalClasses;
    private $systemBaseDir;
    
    /**
     * Constructor for the JobCards class
     * * @param string $additionalClasses Additional CSS classes to add to the job card container
     */
    public function __construct($additionalClasses = '') {
        $this->additionalClasses = $additionalClasses;
        $this->systemBaseDir = SYSTEM_BASE_DIR;
    }
    
    /**
     * Render method for the JobCards class
     * * @return string The HTML for the job card
     */
    public function render() {
    return <<<HTML
        <div 
            :data-url-job="'{$this->systemBaseDir}searchjobs?job=' + job.id" 
            :id="'job-' + job.id"
            :class="{'bg-blue-50': job.isSaved == '1', 'bg-white': job.isSaved == '0'}"
            class="grid grid-cols-12 grid-rows-1 gap-2 relative rounded-lg shadow-md p-4 border hover:shadow-lg transition-shadow cursor-pointer {$this->additionalClasses}"
            data-url-job=""
            @click.prevent="window.location.href = \$el.dataset.urlJob"
        >
            <div class="col-span-2 grid justify-center align-content-center">
                <img
                    :src="job.logo"
                    alt="Company Logo"
                    class="w-16 h-auto md:h-16 rounded-lg object-cover mr-2" />
            </div>
            <div class="col-span-10">
                <div class="col-span-10 pr-12 relative pb-2">
                    <div class="flex justify-end space-x-4 absolute -right-4 -top-4 job-block-seven">
                        <button
                            @click.stop="toggleSaveJob(job.id)"
                            :class="{'text-blue-500': job.isSaved == '1', 'text-gray-400': job.isSaved == '0'}"
                            class="text-gray-400 hover:text-blue-500 transition-colors bookmark-btn"
                            :data-text="job.isSaved == '0' ? 'Guardar en favoritos' : 'Eliminar de favoritos'"
                            >
                            <i
                                :class="{'fas text-blue-500': job.isSaved  == '1', 'far': job.isSaved  == '0'}"
                                class="fa-bookmark"></i>
                        </button>
                    </div>

                    <h2 class="text-lg font-semibold" x-text="job.title"></h2>
                </div>

                <div class="col-span-10 col-start-3 row-start-2">
                    <div 
                    :class="{'grid-rows-2': job.isExternal == '1', 'grid-rows-1': job.isExternal == '0'}"
                    class="grid grid-cols-2 gap-2">
                        
                        <div 
                        :class="{'col-span-2': job.isExternal == '0', '': job.isExternal == '1'}">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="far fa-clock px-2"></i>
                                <span 
                                    x-text="job.timeAgo"
                                    :data-translate-en="job.timeAgo"
                                    :data-translate-es="job.timeAgoEs"
                                    data-translate-en=""
                                    data-translate-es=""
                                ></span>
                            </div>
                        </div>
                        
                        <div 
                        :class="{'col-start-1 row-start-1': job.isExternal == '1', 'col-span-1': job.isExternal == '0'}">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="far fa-building px-2"></i>
                                <span x-text="job.company"></span>
                            </div>
                        </div>

                        <div 
                        :class="{'row-span-2 col-start-2 row-start-1': job.isExternal == '1', 'col-span-1': job.isExternal == '0'}">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt px-2"></i>
                                <span x-text="job.location"></span>
                            </div>
                        </div>
                        <template x-if="job.isExternal == 0 || job.isExternal == '0'">
                            <div class="col-span-2">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="far fa-money-bill-alt px-2"></i>
                                    <span x-text="job.salary"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <template x-if="job.isExternal == 0 || job.isExternal == '0'">
                    <div class="col-span-10 col-start-3 row-start-3">
                        <div class="mt-2 flex space-x-2">
                            <span
                                :class="{'bg-blue-100': job.tag === 'Full Time', 'bg-green-100': job.tag === 'Part Time', 'bg-yellow-100': job.tag === 'Urgent'}"
                                class="px-2 py-1 rounded-lg text-xs"
                                x-text="job.tag"></span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
HTML;
}
    
    /**
     * Static method to quickly create and render a job card
     * * @param string $additionalClasses Additional CSS classes to add to the job card container
     * @return string The HTML for the job card
     */
    public static function create($additionalClasses = '') {
        $card = new self($additionalClasses);
        return $card->render();
    }
}
?>
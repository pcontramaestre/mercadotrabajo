<?php
/**
 * JobsAppliedCompany Component
 * * A reusable component for displaying job cards with Alpine.js functionality
 * * Basic usage:
 * $jobsApplied = new JobsAppliedCompany('CARD', $dataUserJobsApplied);
 * echo $jobsApplied->render();
 * * With custom TYPE (TABLE, CARD)
 * $jobsApplied = new JobsAppliedCompany('CARD', $dataUserJobsApplied);
 * echo $jobsApplied->render();
 * * echo JobsAppliedCompany::create('CARD', $dataUserJobsApplied);
 * 
 * @property string $type The type of the component (TABLE, CARD)
 * @property array $dataUserJobsApplied The data of the user jobs applied
 * 
 * $fields ="
                job_applications.created_at,
                job_applications.user_id,
                user_profile.full_name AS user_profile_fullname,
                user_profile.email_address AS user_profile_email,
                user_profile.phone AS user_profile_phone,
                user_profile.logo_path AS user_profile_avatar,
                job_applications.job_id,
                jobs.title AS job_title,
                jobs.company_id AS job_company_id,
                job_applications.cv_id,
                candidate_cv.path AS path_cv,
                job_applications.cover_letter,
                job_applications.status
            ";
    $dataUserJobsApplied = [
        'created_at' => '2025-03-11 11:27:09',
        'user_id' => '1',
        'user_profile_fullname' => 'User Name',
        'user_profile_email' => 'User Email',
        'user_profile_phone' => 'User Phone',
        'user_profile_avatar' => 'uploads/avatars/65668c2a5d9e8/avatar_67ccfcdc60d7a4.28189541.png',
        'job_id' => '1',
        'job_title' => 'Job Title',
        'job_company_id' => '1',
        'cv_id' => '1',
        'path_cv' => 'uploads/resumes/65668c2a5d9e8/cv_67ccfcdc60d7a4.28189541.pdf',
        'cover_letter' => 'Cover Letter',
        'status' => 'aplicado',
    ];
 */

class JobsAppliedCompany {
    private $type;
    private $dataUserJobsApplied;
    public function __construct($type, $dataUserJobsApplied) {
        $this->type = $type;
        $this->dataUserJobsApplied = $dataUserJobsApplied;
    }
    /**
     * Summary of getType
     * @return string
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     * Summary of getDataUserJobsApplied
     * @return array
     */
    public function getDataUserJobsApplied() {
        return $this->dataUserJobsApplied;
    }


    //dependiendo del type, renderer un tipo u otro
    public function render() {
        if ($this->type === 'CARD') {
            return $this->renderCard();
        } elseif ($this->type === 'TABLE') {
            return $this->renderTable();
        } else {
            return '';
        }
    }
    private function renderCard() {
        $html = '';
        foreach ($this->dataUserJobsApplied as $job) {
            $html .= '<div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">';
            $html .= '<div class="candidate-block-three col-lg-6 col-md-12 col-sm-12">';
            $html .= '</div>';
        }
        return $html;
    }
    private function renderTable() {
        $html = '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Job</th>
                <th scope="col" class="px-6 py-3">Avatar</th>
                <th scope="col" class="px-6 py-3">Nombre del aplicante</th>
                <th scope="col" class="px-6 py-3">Contacto</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($this->dataUserJobsApplied as $job) {
            $html .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">';
            $html .= '<td class="px-6 py-4">' . $job['created_at'] . '</td>';
            $html .= '<td class="px-6 py-4">' 
                        . '<a href="' . SYSTEM_BASE_DIR.'searchjobs?job='.$job['job_id'] . '" target="_blank" class="text-blue-500">' 
                        . $job['job_title'] 
                        . '</a>' 
                        . '</td>';
            $html .= '<td class="px-6 py-4"> <img class="w-16 h-16 rounded-full object-cover" src="' . $job['user_profile_avatar'] . '" alt="' . $job['user_profile_fullname'] . '" class="w-8 h-8 rounded-full"> </td>';
            $html .= '<td class="px-6 py-4"><a href="' . SYSTEM_BASE_DIR.'dashboard/company/candidate-detail/' . $job['user_id'] . '" target="_blank" class="text-blue-500">' . $job['user_profile_fullname'] . '</a></td>';
            $html .= '<td class="flex gap-2 px-6 py-4"> 
                        <a href="mailto:' . $job['user_profile_email'] . '" target="_blank" class="text-blue-500">
                            <i data-lucide="mail"></i>
                        </a> 
                        <a href="tel:' . $job['user_profile_phone'] . '" target="_blank" class="text-blue-500">
                            <i data-lucide="phone"></i>
                        </a>
                        <a href="' . SYSTEM_BASE_DIR.$job['path_cv'] . '" target="_blank" class="text-blue-500">
                            <i data-lucide="file"></i>
                        </a>
                      </td>';
            $html .= '<td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="' . SYSTEM_BASE_DIR.'dashboard/company/candidate-detail/' . $job['user_id'] . '"
                                class="text-blue-500" data-text="View Aplication">
                                <i data-lucide="eye"></i>
                            </a>
                            <button class="text-blue-500" data-text="Approve Aplication">
                                <i data-lucide="check"></i>
                            </button>
                            <button class="text-blue-500"  data-text="Reject Aplication">
                                <i data-lucide="x"></i>
                            </button>
                            <button class="text-blue-500" data-text="Delete Aplication">
                                <i data-lucide="trash"></i>
                            </button>
                        </div>
                     </td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';
        return $html;
    }
}
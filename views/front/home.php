<?php
// views/home.php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';

//Components
include_once 'views/components/bannerHome.php';
include_once 'views/components/popularJobs.php';
include_once 'views/components/howItWorks.php';

//titleSection companies
$titleSection = [
    'translate_es' => 'Empresas más populares',
    'translate_en' => 'Top Company Registered'
];
$titleSectionText = [
    'translate_es' => 'Algunas de las empresas a las que hemos ayudado a reclutar excelentes candidatos a lo largo de los años.',
    'translate_en' => 'Some of the companies we have helped recruit excellent applicants over the years.'
];
$titleSectionClass ="md:pt-16 pb-6 text-left pl-8";
?>
<div class="top-companies style-two pt-8 mb-8">
    <?php
    include 'views/components/titleSections.php';
    //Listado de empresas
    require_once 'views/components/listCompanies.php';
    ?>
</div>


<?php
include_once 'views/components/jobsByCategoryHome.php';

//titleSection jobs linkedin
$titleSection = [
    'translate_es' => 'Trabajos en LinkedIn',
    'translate_en' => 'Jobs on LinkedIn'
];
$titleSectionText = [
    'translate_es' => 'Algunos de los trabajos más recientes en LinkedIn.',
    'translate_en' => 'Some of the most recent jobs on LinkedIn.'
];
$titleSectionClass ="md:pt-16 pb-6 text-left";
$titleSectionClassH1 = "fw-700 text-3xl mb-3 text-gray-800 relative pl-4 border-l-4 border-blue-500";
?>
<div class="jobs-linkedin style-two pt-8 mb-8">
    <?php
    //include 'views/components/titleSections.php';
    //Listado de trabajos
    //require_once 'views/components/async/linkedin2.php';
    ?>
</div>

<?php

//titleSection jobs computrabajo
$titleSection = [
    'translate_es' => 'Trabajos en Computrabajo',
    'translate_en' => 'Jobs on Computrabajo'
];
$titleSectionText = [
    'translate_es' => 'Algunos de los trabajos más recientes en Computrabajo.',
    'translate_en' => 'Some of the most recent jobs on Computrabajo.'
];
$titleSectionClass ="md:pt-16 pb-6 text-left";
$titleSectionClassH1 = "fw-700 text-3xl mb-3 text-gray-800 relative pl-4 border-l-4 border-blue-500";
?>
<div class="jobs-computrabajo style-two pt-8 mb-8">
    <?php
    //include 'views/components/titleSections.php';
    //Listado de trabajos
    //require_once 'views/components/async/computrabajo.php';
    ?>
</div>

<?php

include_once 'views/layout/footer.php';
?>
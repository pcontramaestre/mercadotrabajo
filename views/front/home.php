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
$titleSectionClass ="pt-16 pb-6 text-left pl-8";
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
include_once 'views/layout/footer.php';
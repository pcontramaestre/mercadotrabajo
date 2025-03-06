<?php
// views/home.php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';
$titleSection = [
    'translate_es' => 'Empresas',
    'translate_en' => 'Companies'
];
require_once 'views/components/pageTitleInternal.php';

//titleSection
    $titleSection = [
        'translate_es' => 'Empresas más populares',
        'translate_en' => 'Most Popular Companies'
    ];
    $titleSectionText = [
        'translate_es' => 'Conoce las empresas más populares en tu área',
        'translate_en' => 'Know the most popular companies in your area'
    ];
    $titleSectionClass ="pt-16 pb-6";
    require_once 'views/components/titleSections.php';
    //Listado de empresas
    require_once 'views/components/listCompanies.php';
?>


<?php
include_once 'views/layout/footer.php';
?>
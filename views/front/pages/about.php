<?php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';
$titleSection = [
    'translate_es' => 'Sobre Nosotros',
    'translate_en' => 'About Us'
];
require_once 'views/components/pageTitleInternal.php';


// Configuración del título de la sección
$titleSection = [
    'translate_es' => 'Sobre Nosotros',
    'translate_en' => 'About Us'
];
$titleSectionText = [
    'translate_es' => 'Conoce más sobre nosotros',
    'translate_en' => 'Learn more about us'
];
$titleSectionClass = "pt-16 pb-6";
require_once 'views/components/titleSections.php';
?>

<div class="auto-container">
    <!-- Contenido: Sobre Nosotros -->
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-medium mb-4">Sobre Nosotros</h2>
                <div class="about-us-container">
                    <p class="mb-4">
                        En <strong>Mercado Trabajo</strong>, comenzamos con una simple pero poderosa idea: conectar talento con oportunidades. Fundada en 2025, nuestra plataforma nació con el objetivo de facilitar la búsqueda de empleo y ayudar a las empresas a encontrar los mejores profesionales. Desde entonces, hemos crecido hasta convertirnos en un referente confiable en el mercado laboral venezolano.
                    </p>

                    <p class="mb-4">
                        Nuestra misión es brindar una plataforma innovadora que conecte empleadores y candidatos de manera eficiente, transparente y segura. Creemos que cada persona merece una oportunidad laboral que se ajuste a sus habilidades y aspiraciones, y que cada empresa necesita el talento adecuado para alcanzar sus objetivos.
                    </p>

                    <p class="mb-4">
                        Aspiramos a ser la principal fuente de conexión laboral en Venezuela y la región, liderando la transformación digital del reclutamiento. Queremos empoderar a las personas para que alcancen su máximo potencial profesional mientras ayudamos a las empresas a crecer con los mejores equipos.
                    </p>

                    <p class="mb-4">
                        Detrás de Mercado Trabajo hay un equipo apasionado y dedicado que trabaja diariamente para hacer realidad nuestra misión. A continuación, te presentamos a algunos de nuestros miembros clave:
                    </p>

                    <!-- Equipo -->
                    <div class="team-grid grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="team-member bg-gray-100 rounded-lg p-4 text-center">
                            <img src="/uploads/candidates/candidate-1.webp" alt="Foto de Juan Pérez" class="rounded-full mx-auto mb-2">
                            <h3 class="font-medium">Juan Pérez</h3>
                            <p>Fundador y CEO</p>
                        </div>
                        <div class="team-member bg-gray-100 rounded-lg p-4 text-center">
                            <img src="/uploads/candidates/candidate-1.webp" alt="Foto de María Gómez" class="rounded-full mx-auto mb-2">
                            <h3 class="font-medium">María Gómez</h3>
                            <p>Directora de Operaciones</p>
                        </div>
                        <div class="team-member bg-gray-100 rounded-lg p-4 text-center">
                            <img src="/uploads/candidates/candidate-1.webp" alt="Foto de Carlos López" class="rounded-full mx-auto mb-2">
                            <h3 class="font-medium">Carlos López</h3>
                            <p>Líder de Desarrollo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'views/layout/footer.php';
?>
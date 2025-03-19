<?php
include_once 'views/layout/header.php';
include_once 'views/layout/navbar.php';
$titleSection = [
    'translate_es' => 'Términos y condiciones',
    'translate_en' => 'Terms and Conditions'
];
require_once 'views/components/pageTitleInternal.php';

//titleSection
$titleSection = [
    'translate_es' => 'Términos y condiciones',
    'translate_en' => 'Terms and Conditions'
];
$titleSectionText = [
    'translate_es' => 'Términos y condiciones',
    'translate_en' => 'Terms and Conditions'
];
$titleSectionClass = "pt-16 pb-6";
require_once 'views/components/titleSections.php';
?>

<div class="auto-container">
    <!-- Content Terms and Conditions -->
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-medium mb-4">Términos y Condiciones de Uso</h2>
                <div class="terms-container">
                    <p class="mb-4">
                        Bienvenido a <strong>Mercado Trabajo</strong>. Al acceder y utilizar este sitio web, usted
                        acepta cumplir con los presentes Términos y Condiciones, así como con todas las leyes y
                        regulaciones aplicables. Si no está de acuerdo con alguno de estos términos, le rogamos
                        abstenerse de usar nuestros servicios. Este sitio está diseñado para conectar empleadores y
                        candidatos en busca de oportunidades laborales, y su uso está sujeto a las condiciones descritas
                        a continuación.
                    </p>

                    <p class="mb-4">
                        El contenido de este sitio, incluyendo pero no limitado a textos, gráficos, logotipos, imágenes
                        y software, está protegido por derechos de autor y otras leyes de propiedad intelectual. Queda
                        estrictamente prohibido copiar, reproducir, modificar, distribuir o explotar cualquier parte del
                        contenido sin el consentimiento previo por escrito de <strong>Mercado Trabajo</strong>. Los
                        usuarios pueden utilizar el sitio únicamente con fines legítimos y de conformidad con estos
                        términos.
                    </p>

                    <p class="mb-4">
                        Al publicar ofertas de empleo o currículos en nuestro portal, los usuarios garantizan que toda
                        la información proporcionada es precisa, completa y veraz. <strong>Mercado Trabajo</strong> no
                        se hace responsable de la autenticidad o exactitud de los datos compartidos por los usuarios.
                        Asimismo, no garantizamos que todas las ofertas de empleo resulten en una contratación exitosa
                        ni que todos los currículos sean revisados por los empleadores. Nos reservamos el derecho de
                        eliminar cualquier contenido que consideremos inapropiado o que viole nuestras políticas.
                    </p>

                    <p class="mb-4">
                        El uso de este sitio es bajo la propia responsabilidad del usuario. <strong>Mercado
                            Trabajo</strong> no será responsable por daños directos, indirectos, incidentales o
                        consecuentes que puedan surgir del uso o la imposibilidad de usar nuestros servicios. Nos
                        reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento, y dichas
                        modificaciones entrarán en vigor inmediatamente después de su publicación en el sitio. Es
                        responsabilidad del usuario revisar periódicamente esta página para estar informado sobre
                        cualquier cambio.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'views/layout/footer.php';
?>
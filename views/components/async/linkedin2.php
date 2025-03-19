<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Symfony\Component\DomCrawler\Crawler;

// Configuración inicial
$urls = [
    'linkedin'=> 'https://www.linkedin.com/jobs/search?keywords=%20&location=Venezuela&geoId=101490751&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0&currentJobId=4184308683',
    'computrabajo'=> 'https://ve.computrabajo.com/trabajo-de-asesor-de-ventas-en-tachira',
];

// Crear cliente HTTP
$client = new Client();

try {
    // Crear un array de promesas
    $promises = [];
    foreach ($urls as $type => $url) {
        $promises[$type] = $client->getAsync($url, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'es-ES,es;q=0.9',
                'Connection' => 'close',
                'Cache-Control' => 'no-cache',
                'Pragma' => 'no-cache',
            ],
        ]);
    }

    // Esperar a que todas las promesas se resuelvan
    $results = Promise\Utils::settle($promises)->wait();

    // Procesar los resultados
    $allJobs = [];
    foreach ($results as $type => $result) {
        if ($result['state'] === 'fulfilled') {
            // Obtener el contenido HTML
            $html = $result['value']->getBody()->getContents();

            // Analizar el HTML con DomCrawler
            $crawler = new Crawler($html);

            // Extraer los datos relevantes
            if ($type === 'linkedin') {
                $count = 60;
                $jobs = $crawler->filter('.job-search-card')->each(function (Crawler $node) use (&$count) {
                    $count++;
                    $linkJob = "";
                    $title = $node->filter('.base-search-card__title')->text();
                    $linkJob1 = $node->filter('.base-search-card--link')->attr('href');
                    $linkJob2 = $node->filter('a')->attr('href');;
                    $company = $node->filter('.base-search-card__subtitle')->text();
                    $location = $node->filter('.job-search-card__location')->text();
                    $listDate = $node->filter('time')->text();

                    if ($linkJob1) {
                        $linkJob = explode('?', $linkJob1)[0];
                    }
                    if ($linkJob2) {
                        $linkJob = explode('?', $linkJob2)[0];
                    }

                    
                    return [
                        'title' => trim($title),
                        'company_logo' => '/assets/companies/img/linkedin.svg',
                        'description' => '<p>
                            Para más información, visita el sitio web de LinkedIn en el siguiente 
                            <a href="' . $linkJob . '" target="_blank">enlace</a>.
                        </p>',
                        'skills_experience'=> '',
                        'salary'=> '',
                        'priority'=> 'Urgente',
                        'logo' => SYSTEM_BASE_DIR . 'assets/companies/img/linkedin.svg',
                        'key_responsibilities'=> '',
                        'linkJob' => $linkJob,
                        'company' => trim($company),
                        'location' => trim($location),
                        'timeAgo' => $listDate,
                        'isExternal' => true,
                        'isLinkedin' => true,
                        'isComputrabajo' => false,
                        'isSaved'=> 0,
                        'isFavorite'=> 0,
                        'isApplied'=> 0,
                        'employment_type_name'=> '',
                        'id'=> $count,
                    ];
                });
            } else {
                $jobs = [];
            }

            // Agregar los trabajos al array global
            $allJobs = array_merge($allJobs, $jobs);
        } else {
            echo "Error al procesar la URL: $url\n";
        }
    }

} catch (\Exception $e) {
    echo "Error general: " . $e->getMessage();
}
?>
<div class="jobs-container auto-container grid grid-cols-3 gap-4">
    <?php 
    
    // Limitar a mostrar solo los primeros 9 trabajos
    $jobs = array_slice($allJobs, 0, 9);
    
    foreach ($jobs as $job) { ?>
        
      <div class="job-card col-span-1 border rounded-lg p-4 shadow-md" id="job-<?php echo $job['id'] ?>">
        <div class="job-card-info">
          <h3 class="text-lg font-medium leading-none pb-4"><?php echo $job['title'] ?></h3>
          <p class="text-gray-600 flex items-center gap-2 pb-2 leading-none">
            <i class="far fa-building"></i>
            <?php echo $job['company'] ?>
          </p>
          <p class="text-gray-600 flex items-center gap-2 pb-2">
            <i class="fas fa-map-marked"></i>
            <?php echo $job['location'] ?>
          </p>
          <p class="text-gray-600 flex items-center gap-2 pb-4 leading-none">
            <i class="fas fa-clock"></i>
            <?php echo $job['timeAgo'] ?>
          </p>
          <a href="<?php echo $job['linkJob'] ?>" target="_blank" class="text-blue-500 font-bold hover:underline">Ver más</a>
        </div>
      </div>
    <?php } ?>
  </div>

  

<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

// Configuración inicial
//$url = "https://www.linkedin.com/jobs/search?keywords=Desarrollo%20Web&position=1&location=Venezuela";
//$url = "https://www.linkedin.com/jobs/search?keywords=&location=Venezuela&position=1&pageNum=0";
$url ="https://www.linkedin.com/jobs/search?keywords=Desarrollo%20backend&location=Venezuela&geoId=101490751&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0";
// Crear cliente HTTP
$client = new Client();

try {
    // Realizar la solicitud GET
    $response = $client->request('GET', $url, [
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        ],
    ]);

    // Obtener el contenido HTML
    $html = $response->getBody()->getContents();
    // Analizar el HTML con DomCrawler
    $crawler = new Crawler($html);

    // Extraer los datos relevantes
    $jobs = $crawler->filter('.job-search-card')->each(function (Crawler $node) {
        $title = $node->filter('.base-search-card__title')->text();
        $linkJob = $node->filter('.base-search-card--link')->attr('href');
        $linkJob2 = "";
        $company = $node->filter('.base-search-card__subtitle')->text();
        $location = $node->filter('.job-search-card__location')->text();
        $listDate  = "";

        $imageCompany = '';
        if ($node->filter('.search-entity-media img')->count() > 0) {
            $imageCompany = $node->filter('.search-entity-media img')->attr('src');
        } else {
            $imageCompany = 'No disponible';
        }

        return [
            'title' => $title,
            'linkJob' => $linkJob,
            'linkJob2'=> $linkJob2,
            'company' => $company,
            'imageCompany' => $imageCompany,
            'location'=> $location,
            'listDate' => $listDate,
        ];

        
    });

    // //recorrer jobs, si el linkJob es null, no mostrar el job. El link job, eliminar los parametros, es decir lo que esta despues de ?
    // $jobs = array_filter($jobs, function ($job) {
    //     return $job['linkJob'] !== null;
    // });
    // $jobs = array_map(function ($job) {
    //     $job['linkJob'] = explode('?', $job['linkJob'])[0];
    //     return $job;
    // }, $jobs);

    
    // Mostrar los resultados
    //print_r($jobs);
?>
  <div class="jobs-container auto-container">
    <?php foreach ($jobs as $job) { ?>
        
      <div class="job-card">
        <div class="job-card-image">
        <i data-lucide="linkedin"></i>
        </div>
        <div class="job-card-info">
          <h3><?php echo $job['title'] ?></h3>
          <p><?php echo $job['company'] ?></p>
          <p><?php echo $job['location'] ?></p>
          <p><?php echo $job['listDate'] ?></p>
          <a href="<?php echo $job['linkJob'] ?>" target="_blank">Ver más</a>
          <a href="<?php echo $job['linkJob2'] ?>" target="_blank">Ver más</a>
        </div>
      </div>
    <?php } ?>
  </div>
<?php

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Symfony\Component\DomCrawler\Crawler;

// Configuración inicial
$urls = [
    "https://www.linkedin.com/jobs/search?keywords=Desarrollo%20backend&location=Venezuela&geoId=101490751&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0",
    // Agrega más URLs si necesitas paginación o múltiples búsquedas
];

// Crear cliente HTTP
$client = new Client();

try {
    // Crear un array de promesas
    $promises = [];
    foreach ($urls as $url) {
        $promises[$url] = $client->getAsync($url, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            ],
        ]);
    }

    // Esperar a que todas las promesas se resuelvan
    $results = Promise\Utils::settle($promises)->wait();

    // Procesar los resultados
    $allJobs = [];
    foreach ($results as $url => $result) {
        if ($result['state'] === 'fulfilled') {
            // Obtener el contenido HTML
            $html = $result['value']->getBody()->getContents();

            // Analizar el HTML con DomCrawler
            $crawler = new Crawler($html);

            // Extraer los datos relevantes
            $jobs = $crawler->filter('.job-search-card')->each(function (Crawler $node) {
                $title = $node->filter('.base-search-card__title')->text();
                $linkJob = $node->filter('.base-search-card--link')->attr('href');
                $linkJob2 = "";
                $company = $node->filter('.base-search-card__subtitle')->text();
                $location = $node->filter('.job-search-card__location')->text();
                $listDate = "";

                $imageCompany = '';
                if ($node->filter('.search-entity-media img')->count() > 0) {
                    $imageCompany = $node->filter('.search-entity-media img')->attr('src');
                } else {
                    $imageCompany = 'No disponible';
                }

                return [
                    'title' => trim($title),
                    'linkJob' => $linkJob,
                    'linkJob2' => $linkJob2,
                    'company' => trim($company),
                    'imageCompany' => $imageCompany,
                    'location' => trim($location),
                    'listDate' => $listDate,
                ];
            });

            // Agregar los trabajos al array global
            $allJobs = array_merge($allJobs, $jobs);
        } else {
            echo "Error al procesar la URL: $url\n";
        }
    }

    // Mostrar los resultados
    print_r($allJobs);

} catch (\Exception $e) {
    echo "Error general: " . $e->getMessage();
}
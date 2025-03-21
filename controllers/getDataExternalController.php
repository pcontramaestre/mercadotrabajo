<?php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'models/BaseModel.php';
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Symfony\Component\DomCrawler\Crawler;

class getDataExternalController {


  /**
   * Summary of searchExternalJobs
   * @param mixed $type
   * @param mixed $field_job
   * @param mixed $field_postal
   * @param mixed $field_category
   * @return array
   */
  public function searchExternalJobs($field_job='', $field_postal='', $field_category='') {
    $results = [];
    $search = '';

    $type = $field_category;
    $typeSearch = ['linkedin', 'computrabajo','empleate','bumeran'];

        //LinkedIn
        $keywords = $field_job.'%20' . $field_postal;
        $location = $field_postal;

        if (empty($field_postal)) {
            $location = 'Venezuela';
        }
        $searchLinkedIn = "https://www.linkedin.com/jobs-guest/jobs/api/seeMoreJobPostings/search?keywords=$keywords&location=$location&geoId=101490751&trk=public_jobs_jobs-search-bar_search-submit&position=1&pageNum=0&start=0";



        //Computrabajo
        $search = 'empleos-en-extranjero'; // Default search
        // Clean and format search terms
        $keywords = !empty($field_job) ? str_replace(' ', '-', trim($field_job)) : '';
        $location = !empty($field_postal) ? str_replace(' ', '-', trim($field_postal)) : '';
        
        // Build search query based on available parameters
        if (!empty($keywords) && !empty($location)) {
            $search = 'trabajo-de-' . $keywords . '-en-' . $location;
        } elseif (!empty($keywords)) {
            $search = 'trabajo-de-' . $keywords;
        } elseif (!empty($location)) {
            $search = 'empleos-en-' . $location;
        }
        $searchComputrabajo = "https://ve.computrabajo.com/$search";

        //Empleate.com
        $search = 'trabajos-en-venezuela';
        
        // Process location if provided
        $location = !empty($field_postal) ? 'en-la-ciudad-de-' . str_replace(' ', '-', trim($field_postal)) : '';
        
        // Process keywords if provided
        $keywords = !empty($field_job) ? 'busqueda-por-' . str_replace(' ', '-', trim($field_job)) : '';
        
        // Build the final search URL with available parameters
        $parts = array_filter([$keywords, $location]);
        if (!empty($parts)) {
            $search .= '-' . implode('-', $parts);
        }
        $searchEmplate = "https://www.emplate.com/venezuela/empleos_encontrados/1/$search";

        //Bumeran
        $searchBumeran = "https://www.bumeran.com.ve/empleos.html";
    
    $urls = [
        'linkedin' => $searchLinkedIn,
        'computrabajo' => $searchComputrabajo,
        'empleate' => $searchEmplate,
        'bumeran' => $searchBumeran,
    ];

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
                    'Cache-Control' => 'max-age=0'
                ]
            ]);
        }

        // Esperar a que todas las promesas se resuelvan
        $responses = Promise\Utils::settle($promises)->wait();

        // Procesar las respuestas
        foreach ($responses as $type => $response) {
            if ($response['state'] === 'fulfilled') {
                // $html[$type] = $response['value']->getBody()->getContents();
                // $response['data'][$type] = $html[$type];
                $responseJson[$type]['type'] = $type;
                // $crawler = new Crawler($html[$type]);
                //$results[$type] = $this->parseJobs($crawler, $type);
            } else {
                //$html[$type] = [];
                $responseJson[$type]['data'][$type] = [];
                $responseJson[$type]['type'] = $type;
                $responseJson[$type]['messages'] = 'Error al obtener datos externos';
            }
        }
        return $responseJson;

    } catch (\Exception $e) {
        error_log('Error al obtener datos externos: ' . $e->getMessage());
        $responseJson['status'] = 500;
        $responseJson['message'] = 'Error al obtener datos externos';
        $responseJson['type'] = $type;
        $responseJson['messages'] = 'Error al obtener datos externos';
        return $responseJson;
    }
  }
}

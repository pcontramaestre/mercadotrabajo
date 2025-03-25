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
   * Summary of getDatabase
   * @return PDO
   */
  private function getDatabase() {
    $configuration = new Config();
    $database = new Database($configuration);
    //$database = new Database();
    $db = $database->getConnection();
    return $db;
  }

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
        $searchEmplate = "https://www.empleate.com/venezuela/ofertas/empleos_encontrados/1/$search";

        //Bumeran
        $search = "empleos.html";
        $location = !empty($field_postal) ? "en-$field_postal/" : '';
        $keywords = !empty($field_job) ? "empleos-busqueda-".str_replace(' ', '-', trim($field_job)).".html" : '';
        
        if (!empty($location) && !empty($keywords)) {
            $search = $location . $keywords;
        }
        if (!empty($location) && empty($keywords)) {
            $search = $location . "empleos.html";
        }
        if (empty($location) && !empty($keywords)) {
            $search = $keywords;
        }

        $searchBumeran = "https://www.bumeran.com.ve/$search";
    
    $urls = [
        'linkedin' => $searchLinkedIn,
        'computrabajo' => $searchComputrabajo,
        'empleate' => $searchEmplate,
        // 'bumeran' => $searchBumeran,
    ];

    $client = new Client();
    $responseJson = [];
    
    try {
        // Configuración para timeout y manejo de errores
        $requestOptions = [
            'timeout' => 5, // Timeout de 5 segundos por solicitud
            'connect_timeout' => 3, // Timeout de conexión de 3 segundos
            'http_errors' => false, // No lanzar excepciones por errores HTTP
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'es-ES,es;q=0.9',
                'Connection' => 'close',
                'Cache-Control' => 'max-age=3600, must-revalidate',
                'Pragma' => 'cache',
            ]
        ];
        
        // Crear un array de promesas
        $promises = [];
        foreach ($urls as $type => $url) {
            $promises[$type] = $client->getAsync($url, $requestOptions);
        }
        
        // Establecer un tiempo máximo para todas las solicitudes (10 segundos)
        $results = Promise\Utils::settle($promises)->wait(true);
        
        // Procesar las respuestas
        foreach ($results as $type => $result) {
            // $responseJson[$type] = ['type' => $type];
            
            if ($result['state'] === 'fulfilled') {
                $response = $result['value'];
                $statusCode = $response->getStatusCode();
                
                if ($statusCode >= 200 && $statusCode < 300) {
                    // Éxito - solo guardamos la URL para mostrar al usuario
                    //$responseJson[$type]['url'] = $urls[$type];
                    //$responseJson['success'] = true;
                    switch ($type) {
                        case 'linkedin':
                            $count = 600000;
                            $crawler = $response->getBody()->getContents();
                            $crawler = new Crawler($crawler);
                            $crawler->filter('.job-search-card')->slice(0, 10)->each(function (Crawler $node) use (&$count, &$responseJson, $type) {
                                $count++;
                                $linkJob = "";
                                $dataEntityUrn = $node->attr('data-entity-urn');
                                $jobId = '';
                                
                                if ($dataEntityUrn !== null) {
                                    // Extraer solo los números del formato "urn:li:jobPosting:4137048490"
                                    preg_match('/urn:li:jobPosting:(\d+)/', $dataEntityUrn, $matches);
                                    if (isset($matches[1])) {
                                        $jobId = $matches[1];
                                        $dataEntityUrn = $jobId;
                                        $linkJobLink = "https://www.linkedin.com/jobs/view/" . $jobId;
                                        $linkJob = "https://www.linkedin.com/jobs-guest/jobs/api/jobPosting/" . $jobId;
                                    }
                                }

                                $title = $node->filter('.base-search-card__title')->text();
                                $company = $node->filter('.base-search-card__subtitle')->text();
                                $location = 'No disponible';
                                $description ='';
                                if ($node->filter('.job-search-card__location')->count() > 0) {
                                    $location = $node->filter('.job-search-card__location')->text();
                                }
                                $listDate = 'No disponible';
                                if ($node->filter('time')->count() > 0) {
                                    $listDate = $node->filter('time')->text();
                                }
                                $responseJson[$count] =[
                                    'id'=> $count,
                                    'type'=> $type,
                                    'dataEntityUrn' => $dataEntityUrn,
                                    'title' => trim($title),
                                    'company_logo' => '/assets/companies/img/linkedin.svg',
                                    'description' => $description,
                                    'skills_experience'=> '',
                                    'salary'=> 'No disponible',
                                    'priority'=> 'Urgente',
                                    'logo' => SYSTEM_BASE_DIR . 'assets/companies/img/linkedin.svg',
                                    'key_responsibilities'=> '',
                                    'linkJob' => $linkJobLink,
                                    'company' => trim($company),
                                    'location' => trim($location),
                                    'timeAgo' => $listDate,
                                    'isExternal' => true,
                                    'isLinkedin' => true,
                                    'isComputrabajo' => false,
                                    'isSaved'=> 0,
                                    'isFavorite'=> 0,
                                    'isApplied'=> 0,
                                    'isInternalExternal'=> 0,
                                    'employment_type_name'=> 'LinkedIn',
                                    'job_type_name'=> 'Enlace externo',
                                    'category'=> 'LinkedIn',
                                ];
                            });
                        
                        case 'computrabajo':
                            $count = 700000;
                            $crawler = $response->getBody()->getContents();
                            $crawler = new Crawler($crawler);
                            $crawler->filter('.box_offer')->slice(0, 10)->each(function ($node) use (&$count, &$crawler, &$responseJson, &$type) {
                                $count++;
                                $linkJob = "";
                                $title = $node->filter('h2 > a.js-o-link')->text();
                                $linkJob1 = $node->filter('h2 > a.js-o-link')->attr('href');
                                $linkJob2 = $node->filter('h2 > a.js-o-link')->attr('href');
                                $dataId = $node->attr('data-id');
                                $company = '';
                                if ($node->filter('p.dFlex.vm_fx.fs16.fc_base.mt5 a.fc_base.t_ellipsis')->count() > 0) {
                                    $company = $node->filter('p.dFlex.vm_fx.fs16.fc_base.mt5 a.fc_base.t_ellipsis')->text();
                                } else {
                                    $company = 'No disponible';
                                }
                                $location = 'No disponible';
                                if ($node->filter('p.fs16.fc_base.mt5 span')->count() > 0) {
                                    $location = $node->filter('p.fs16.fc_base.mt5 span')->text();
                                } else {
                                    $location = 'No disponible';
                                }
                                $listDate = ""; //p.fs13.fc_aux
                                if ($node->filter('p.fs13.fc_aux')->count() > 0) {
                                    $listDate = $node->filter('p.fs13.fc_aux')->text();
                                    $listDate = trim($listDate);
                                } else {
                                    $listDate = 'No disponible';
                                }


                                if ($linkJob1) {
                                    $linkJob = "https://ve.computrabajo.com" . $linkJob1;
                                }
                                if ($linkJob2) {
                                    $linkJob = "https://ve.computrabajo.com" . $linkJob2;
                                }

                                // Extraer el salario
                                $salary = '';
                                if ($node->filter('.fs13.mt15 .icon.i_salary')->count() > 0) {
                                    // El salario está en el texto dentro del mismo contenedor que el ícono
                                    $salary = $node->filter('.fs13.mt15 span.dIB')->eq(0)->text();
                                    $salary = trim(preg_replace('/\s+/', ' ', $salary)); // Limpiar espacios extra
                                } else {
                                    $salary = 'No disponible';
                                }
                                $responseJson[$count] = [
                                    'id'=> $count,
                                    'type'=> $type,
                                    'dataEntityUrn' => $dataId,
                                    'title' => trim($title),
                                    'company_logo' => '/assets/companies/img/computrabajo.webp',    
                                    'isInternalExternal'=> 0,
                                    'description' => '',
                                    'skills_experience'=> '',
                                    'salary'=> $salary,
                                    'priority'=> 'Urgente',
                                    'logo' => SYSTEM_BASE_DIR . 'assets/companies/img/computrabajo.webp',
                                    'key_responsibilities'=> '',
                                    'linkJob' => $linkJob,
                                    'company' => trim($company),
                                    'location' => trim($location),
                                    'timeAgo' => $listDate,
                                    'isExternal' => true,
                                    'isLinkedin' => false,
                                    'isComputrabajo' => true,
                                    'isSaved'=> 0,
                                    'isFavorite'=> 0,
                                    'isApplied'=> 0,
                                    'employment_type_name'=> 'Computrabajo',
                                    'job_type_name'=> 'Enlace externo',
                                    'category'=> 'Computrabajo',
                                ];
                            });
                        
                        case 'empleate':
                            $count = 800000;
                            $crawler = $response->getBody()->getContents();
                            $crawler = new Crawler($crawler);
                            $crawler->filter('.card.w-100.align-middle.mt-3.mb-3.shadow')->slice(0, 10)->each(function ($node) use (&$count, &$crawler, &$responseJson, &$type) {
                                $count++;
                                $linkJob = $node->filter('a')->attr('href');
                                $title = $node->filter('.cargo-titulo')->text();
                                $company = $node->filter('.nombre-empresa')->text();
                                $location = $node->filter('.ubicacion-empresa')->text();
                                $description = $node->filter('.descripcion-cargo')->text();
                                $timeago = $node->filter('.fecha-publi')->text();
                                $dataEntityUrnArray = explode('/', $linkJob);
                                $dataEntityUrn = $dataEntityUrnArray[4];




                                $responseJson[$count] = [
                                    'id'=> $count,
                                    'type'=> $type,
                                    'title'=> $title,
                                    'dataEntityUrn' => $dataEntityUrn,
                                    'company' => trim($company),
                                    'location' => trim($location),
                                    'description' => trim($description),
                                    'skills_experience' => '',
                                    'salary'=> 'N/A',
                                    'priority'=> 'Normal',
                                    'logo' => SYSTEM_BASE_DIR . 'assets/companies/img/empleate.png',
                                    'key_responsibilities'=> '',
                                    'linkJob' => $linkJob,
                                    'timeAgo' => $timeago,
                                    'isExternal' => true,
                                    'isLinkedin' => false,
                                    'isComputrabajo' => false,
                                    'isEmpleate'=> true,
                                    'isInternalExternal'=> 0,
                                    'isSaved'=> 0,
                                    'isFavorite'=> 0,
                                    'isApplied'=> 0,
                                    'employment_type_name'=> 'Empleate',
                                    'job_type_name'=> 'Enlace externo',
                                    'category'=> 'Empleate',
                                ];
                            });
                        default:
                            break;
                    }
                } else {
                    // Error HTTP
                    $responseJson[$type]['status'] = 'error';
                    $responseJson[$type]['url'] = $urls[$type];
                    $responseJson[$type]['message'] = 'Error HTTP: ' . $statusCode;
                }
            } else {
                // Error en la solicitud
                $responseJson[$type]['status'] = 'error';
                $responseJson[$type]['message'] = $result['reason']->getMessage();
            }
        }
        $results = $responseJson;
        return $results;

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

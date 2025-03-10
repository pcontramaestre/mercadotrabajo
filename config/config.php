<?php
require_once 'controllers/BaseController.php';
require_once 'config/database.php';
class Config {
    private $url_base = 'http://mercadotrabajo.localdev:8080/';
    private $host = "127.0.0.1";
    private $db_name = "mercadotrabajo";
    private $username = "pcontramaestre";
    private $password = "";
    private $home_url = 'https://quinteroandassociates.com/';
    private $emailsCC = 'administration@quinteroandassociates.com, customerservice@quinteroandassociates.com';
    private $emailFrom = 'pcontramaestre@localhost';
    static $table;

    private $tableNames = [
        'item_list_services' => 'item_list_services', // Establecer el nombre de la tabla donde se encuentran los servicios.
        'billing_invoice' => 'billing_invoice', // Establecer el nombre de la tabla de  billing_invoice.
        'billing_invoice_items' => 'billing_invoice_items', // Establecer el nombre de la tabla de  billing_invoice_items.
        'customers' => 'customers', // Establecer el nombre de la tabla de  customers.
        'individuals' => 'individuals', // Establecer el nombre de la tabla de  individuals.
        'addresses' => 'addresses', // Establecer el nombre de la tabla de  addresses.
        'emails' => 'emails', // Establecer el nombre de la tabla de  emails.
        'businesses' => 'businesses', // Establecer el nombre de la tabla de  businesses.
        'business_addresses' => 'business_addresses', // Establecer el nombre de la tabla de  business_addresses.
        'business_emails' => 'business_emails', // Establecer el nombre de la tabla de  business_emails.
    ];

    public function getUrlBase() {
        return $this->url_base;
    }

    public function getHost() {
        return $this->host;
    }

    public function getDbName() {
        return $this->db_name;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTable() {
        return $this->tableNames;
    }

    public function getHomeUrl() {
        return $this->home_url;
    }


    public function getEmailsCC() {
        return $this->emailsCC;
    }

    public function getEmailFrom() {
        return $this->emailFrom;
    }
}
    session_start();
    $_SESSION['user_id'] = 8;
    

    $config = new Config();
    define('SYSTEM_BASE_DIR', $config->getUrlBase());
    define('SYSTEM_HOME_URL', $config->getHomeUrl());

    $database = new Database($config);
    //$database = new Database();
    $db = $database->getConnection();
    $controller = new BaseController($db);
    $conditions = [
        'id'=> $_SESSION['user_id']
    ];

    $resultUser = $controller->findRecord('users', $conditions);
    if (empty($resultUser)) {
        $_SESSION['user_uid'] = '';
        $_SESSION['role_id'] = '';

    } else {
        $_SESSION['user_uid'] = $resultUser['uid'];
        $_SESSION['role_id'] = $resultUser['role_id'];
    }
?>
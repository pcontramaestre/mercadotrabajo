<?php
include_once 'config/config.php';

$configuration = new Config();

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct($configuration) {
        $this->host = $configuration->getHost();
        $this->db_name = $configuration->getDbName();
        $this->username = $configuration->getUsername();
        $this->password = $configuration->getPassword();

        // Validar que la configuración no esté vacía
        if (empty($this->host) || empty($this->db_name) || empty($this->username)) {
            throw new Exception("Error: La configuración de la base de datos está incompleta.");
        }
    }

    public function getConnection(): PDO {
        $this->conn = null;

        try {
            // Establecer la conexión con la codificación UTF-8
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );

            // Configurar el modo de error para lanzar excepciones
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception) {
            throw new Exception("Error de conexión: " . $exception->getMessage());
        }

        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>
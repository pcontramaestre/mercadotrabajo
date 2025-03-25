<?php

/**
 * DatabaseHelper Class
 * 
 * This class provides generic database operations such as saving, updating, deleting, querying, and fetching records.
 * It includes additional functionalities like pagination, record counting, and security measures to prevent SQL injection.
 */
class DatabaseHelper {

    /**
     * Database connection instance.
     *
     * @var PDO|null
     */
    private $connection;

    /**
     * Constructor to initialize the database connection.
     *
     * @param PDO $pdo An instance of PDO for database connection.
     */
    public function __construct($pdo) {
        $this->connection = $pdo;
    }

    /**
     * Inicia una transacción.
     */
    public function beginTransaction(): void {
        $this->connection->beginTransaction();
    }

    /**
     * Confirma una transacción.
     */
    public function commit(): void {
        $this->connection->commit();
    }

    /**
     * Revierte una transacción.
     */
    public function rollBack(): void {
        $this->connection->rollBack();
    }
    

    /**
     * Insert data into a table.
     *
     * Usage:
     * ```php
     * $dbHelper->insert('users', ['name' => 'John', 'email' => 'john@example.com']);
     * ```
     *
     * Security Note: The use of PDO with placeholders (e.g., :column) prevents SQL injection.
     *
     * @param string $table The name of the table where data will be inserted.
     * @param array $data An associative array of column-value pairs to insert.
     * @return int The ID of the last inserted record.
     */
    public function insert(string $table, array $data): int {
        if (empty($table) || empty($data)) {
            error_log("Error: Los parámetros 'table' y 'data' son obligatorios.");
            print_r('Table: ' . $table);
            print_r('Data: ' . $data);
            return false;
        }
        
        
        try {            
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->connection->prepare($query);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();

            //si hay un error al inserter mostrar el error
            if ($this->connection->errorCode() != 0) {
                error_log("Error: " . $this->connection->errorInfo());

                return false;
            } else {

                return $this->connection->lastInsertId();
            }

        } catch (Exception $e) {
            error_log("Error inserting data: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update data in a table.
     *
     * Usage:
     * ```php
     * $dbHelper->update('users', ['name' => 'John Doe'], ['id' => 1]);
     * ```
     *
     * Security Note: The use of PDO with placeholders (e.g., :column) prevents SQL injection.
     *
     * @param string $table The name of the table where data will be updated.
     * @param array $data An associative array of column-value pairs to update.
     * @param array $conditions An associative array of column-value pairs to identify the row(s) to update.
     * @return int The ID of the last updated record.
     */
    public function update(string $table, array $data, array $conditions): int {
        if (empty($table) || empty($data) || empty($conditions)) {
            error_log("Error: Los parámetros 'table', 'data' y 'conditions' son obligatorios.");
            return false;
        }
        try {
            $setClauses = [];
            foreach ($data as $key => $value) {
                $setClauses[] = "$key = :$key";
            }
            $setClause = implode(", ", $setClauses);

            $whereClauses = [];
            foreach ($conditions as $key => $value) {
                $whereClauses[] = "$key = :cond_$key";
            }
            $whereClause = implode(" AND ", $whereClauses);

            $query = "UPDATE $table SET $setClause WHERE $whereClause";

            $stmt = $this->connection->prepare($query);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            foreach ($conditions as $key => $value) {
                $stmt->bindValue(":cond_$key", $value);
            }

            $stmt->execute();
            

            // Verificar si hubo un error al ejecutar la consulta
            if ($this->connection->errorCode() != 0) {
                error_log("Error: " . $this->connection->errorInfo());
                return false;
            } 

            // Retornar el número de filas afectadas
            return true; 

        } catch (Exception $e) {
            error_log("Error updating data: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete data from a table.
     *
     * Usage:
     * ```php
     * $dbHelper->delete('users', ['id' => 1]);
     * ```
     *
     * Security Note: The use of PDO with placeholders (e.g., :column) prevents SQL injection.
     *
     * @param string $table The name of the table where data will be deleted.
     * @param array $conditions An associative array of column-value pairs to identify the row(s) to delete.
     * @param int $respondeJson Response json
     * @return int The number of rows affected by the operation.
     */
    public function delete(string $table, array $conditions,?int $responseJson = 0 ): int {
        if (empty($table) || empty($conditions)) {
            error_log("Error: Los parámetros 'table' y 'conditions' son obligatorios.");
            print_r('Table: ' . $table);
            print_r('Conditions: ' . $conditions);
            return false;
        }
        try {
            $whereClauses = [];
            foreach ($conditions as $key => $value) {
                $whereClauses[] = "$key = :$key";
            }
            $whereClause = implode(" AND ", $whereClauses);

            $query = "DELETE FROM $table WHERE $whereClause";
            $stmt = $this->connection->prepare($query);

            foreach ($conditions as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();

            //si hay un error al insertar mostrar el error
            if ($this->connection->errorCode() != 0) {
                error_log("Error: " . $this->connection->errorInfo());
                if ($responseJson){
                    $result = json_encode(['success' => false, 'message' => $this->connection->errorInfo() ]);
                    return $result;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } catch (Exception $e) {
            error_log("Error deleting data: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Query data from a table with optional JOIN, conditions, and pagination.
     *
     * Usage:
     * ```php
     * // Sin JOIN
     * $results = $dbHelper->select('users', ['status' => 1], 0, 10); // Fetch first 10 active users
     *
     * // Con JOIN
     * $joinClause = "INNER JOIN profiles ON users.id = profiles.user_id";
     * $results = $dbHelper->select('users', ['status' => 1], 0, 10, $joinClause); // Fetch users with profiles
     * ```
     *
     * Security Note: The use of PDO with placeholders (e.g., :column) prevents SQL injection.
     *
     * @param string $table The name of the table to query.
     * @param array $conditions An associative array of column-value pairs to filter results.
     * @param int $offset The starting point for pagination (default: 0).
     * @param int|null $limit The maximum number of records to fetch (default: null).
     * @param string|null $joinClause The JOIN clause to include in the query (default: null).
     * @param string|null $orderBy The ORDER BY clause to include in the query (default: null).
     * @return array|null An array of results, or null if no results are found.
     */
    public function select(
        string $table,
        array $conditions = [],
        ?string $orderBy = 'id DESC',
        int $offset = 0,
        ?int $limit = null,
        ?string $joinClause = null
    ): ?array {

        if (empty($table)) {
            error_log("Error: Los parámetros 'table' y 'conditions' son obligatorios.");
            print_r('Table: ' . $table);
            print_r('Conditions: ' . $conditions);
            return [];
        }
        try {
            // Construir la cláusula WHERE
            $whereClauses = [];
            foreach ($conditions as $key => $value) {
                $whereClauses[] = "$key = :$key";
            }
            $whereClause = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";

            // Construir la cláusula LIMIT
            $limitClause = $limit !== null ? "LIMIT $offset, $limit" : "";

            // Construir la consulta SQL
            $query = "SELECT * FROM $table";
            if ($joinClause) {
                $query .= " $joinClause"; // Agregar JOIN si está presente
            }
            $query .= " $whereClause $limitClause";

            $query .= "ORDER BY $orderBy";

            // Preparar y ejecutar la consulta
            $stmt = $this->connection->prepare($query);
            foreach ($conditions as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();

            //si hay un error al insertar mostrar el error
            if ($this->connection->errorCode() != 0) {
                error_log("Error: " . $this->connection->errorInfo());
                return [false];
            } else {
                // Devolver los resultados
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }


        } catch (Exception $e) {
            error_log("Error querying data: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Query data from table manually
     * $results = $dbHelper->select('SELECT * FROM users WHERE status = 1', 0, 10);
     * @param string $query The query to execute.
     */

     public function selectManual(string $query, int $offset = 0, ?int $limit = null): ?array {
        if (empty($query)) {
            error_log("Error: Los parámetros 'query' son obligatorios.");
            return [];
        }
        try {
            // Construir la cláusula LIMIT
            $limitClause = $limit !== null ? "LIMIT $offset, $limit" : "";

            // Preparar y ejecutar la consulta
            $stmt = $this->connection->prepare($query . " $limitClause");
            $stmt->execute();

            // Verificar errores
            if ($this->connection->errorCode() != 0) {
                error_log("Error: " . $this->connection->errorInfo());
                return [];
            }
            // Devolver los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error querying data: " . $e->getMessage());
            return [];
        }
    }


    /**
     * Registrar una búsqueda en la tabla search_logs.
     */
    public function logSearch(string $query, ?int $userId = null): bool {
        // Limpiar el término de búsqueda
        $cleanQuery = $this->cleanSearchQuery($query);

        // Si el término limpio está vacío, no registrar la búsqueda
        if (empty($cleanQuery)) {
            return false;
        }

        $data = [
            'user_id' => $userId,
            'query' => $cleanQuery,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        ];

        // Llamada al método insert dentro de la misma clase
        $result = $this->insert('search_logs', $data);

        if ($result) {
            return true; // La inserción fue exitosa
        } else {
            return false; // Hubo un error
        }
    }

    /**
     * Limpia un término de búsqueda eliminando palabras cortas y comunes.
     */
    private function cleanSearchQuery(string $query): string {
        $stopWords = [
            'a', 'al', 'ante', 'bajo', 'cabe', 'con', 'contra', 'de', 'desde', 'durante',
            'e', 'el', 'en', 'entre', 'hacia', 'hasta', 'la', 'las', 'lo', 'los', 'o', 'por',
            'que', 'se', 'sin', 'sobre', 'tras', 'un', 'una', 'unos', 'unas', 'y',
            'para', 'mediante', 'entre', 'desde', 'hacia', 'durante', 'con', 'sin', 'sobre',
            'empleo', 'trabajo', 'vacante', 'oferta', 'puesto', 'cargo', 'posición',
            'remoto', 'presencial', 'híbrido', 'temporal', 'permanente',
            'experiencia', 'senior', 'junior', 'semi', 'busco', 'deseo', 'quiero',
            'aplicar', 'postular', 'salario', 'sueldo', 'remuneración', 'beneficios'
        ];

        // Convertir a minúsculas para normalizar
        $query = mb_strtolower($query, 'UTF-8');

        // Dividir el término de búsqueda en palabras
        $words = preg_split('/\s+/', $query); // Divide por espacios
        $query = preg_replace('/[^\w\s]/u', '', $query); //eliminar signos de puntuación o caracteres no alfanuméricos

        // Filtrar palabras cortas y comunes
        $filteredWords = array_filter($words, function ($word) use ($stopWords) {
            return strlen($word) >= 3 && !in_array($word, $stopWords);
        });

        // Unir las palabras restantes en un solo string
        return implode(' ', $filteredWords);
    }

    /**
     * Search jobs with optional filters.
     *
     * @param string|null $jobTitle The job title or keyword to search for.
     * @param string|null $location The location (city) to filter by.
     * @param int|null $categoryId The category ID to filter by.
     * @param int $limit The maximum number of records to fetch (default: 50).
     * @param int|null $idJob, Id job
     * @return array An array of results, or an empty array if no results are found.
     */
    public function searchJobs(
        ?string $jobTitle = null,
        ?string $location = null,
        ?int $categoryId = null,
        int $limit = 50,
        ?int $idJob = null
    ): array {
        try {
            $isInternalExternal = "0 AS isInternalExternal";
            if ($_SESSION['user_id']){
                $saveJob = "
                    CASE 
                        WHEN EXISTS (
                            SELECT 1 
                            FROM saved_jobs 
                            WHERE saved_jobs.user_id = ".$_SESSION['user_id']." AND saved_jobs.job_id = jobs.id
                        ) THEN 1 
                        ELSE 0 
                    END AS isSaved
                ";

                $ApplyJob = "
                    CASE 
                        WHEN EXISTS (
                            SELECT 1 
                            FROM   job_applications
                            WHERE  job_applications.user_id = ".$_SESSION['user_id']." AND job_applications.job_id = jobs.id
                        ) THEN 1 
                        ELSE 0 
                    END AS isApplied
                ";
                $isInternalExternal = "
                    CASE 
                        WHEN jobs.is_external = 1 AND jobs.external_id != '' THEN 1 
                        ELSE 0 
                    END AS isInternalExternal
                ";
                // $ApplyJob = "0 AS isApplied";
            } else {
                $saveJob = "0 AS isSaved";
                $ApplyJob = "0 AS isApplied";
            }
            // Definir los campos a seleccionar
            $fields = "
                jobs.id, 
                jobs.title AS title, 
                jobs.city AS location, 
                jobs.job_description AS description,
                jobs.key_responsibilities,
                jobs.skills_experience,
                jobs.priority,
                0 AS isFavorite,
                jobs.is_external AS isExternal,
                jobs.Fuente AS fuente,
                jobs.external_url AS externalUrl,
                ".$isInternalExternal.",
                ".$saveJob.",
                ".$ApplyJob.",
                CONCAT('$', FORMAT(IFNULL(jobs.salary_min, 0), 2),' - $',FORMAT(IFNULL(jobs.salary_max, 0), 2)) AS salary,
                CASE
                    WHEN TIMESTAMPDIFF(SECOND, jobs.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(SECOND, jobs.created_at, NOW()), ' seconds ago')
                    WHEN TIMESTAMPDIFF(MINUTE, jobs.created_at, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, jobs.created_at, NOW()), ' minutes ago')
                    WHEN TIMESTAMPDIFF(HOUR, jobs.created_at, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, jobs.created_at, NOW()), ' hours ago')
                    WHEN TIMESTAMPDIFF(DAY, jobs.created_at, NOW()) < 30 THEN CONCAT(TIMESTAMPDIFF(DAY, jobs.created_at, NOW()), ' days ago')
                    WHEN TIMESTAMPDIFF(MONTH, jobs.created_at, NOW()) < 12 THEN CONCAT(TIMESTAMPDIFF(MONTH, jobs.created_at, NOW()), ' months ago')
                    ELSE CONCAT(TIMESTAMPDIFF(YEAR, jobs.created_at, NOW()), ' years ago')
                END AS timeAgo,
                categories.name AS category, 
                job_types.name AS job_type_name, 
                employment_types.name AS employment_type_name,
                companies.name AS company,
                companies.logo_url AS company_logo,
                CONCAT('" . SYSTEM_BASE_DIR . "', companies.logo_url) AS logo
            ";

            // Definir la cláusula JOIN
            $joinClause = "
                INNER JOIN categories ON jobs.category_id = categories.id 
                INNER JOIN job_types ON jobs.job_type_id = job_types.id 
                INNER JOIN employment_types ON jobs.employment_type_id = employment_types.id
                INNER JOIN companies ON jobs.company_id = companies.id
            ";

            // Construir la cláusula WHERE
            $whereClauses = ["jobs.is_active = 1"];
            $params = [];



            if (!empty($jobTitle)) {
                $whereClauses[] = "MATCH(jobs.title, jobs.job_description) AGAINST (:jobTitle IN BOOLEAN MODE)";
                $params[':jobTitle'] = $jobTitle;
            }

            if (!empty($location)) {
                $whereClauses[] = "jobs.city LIKE :location";
                $params[':location'] = "%$location%";
            }

            if ($categoryId !== null) {
                $whereClauses[] = "jobs.category_id = :categoryId";
                $params[':categoryId'] = $categoryId;
            }

            if ($idJob !== null) {
                $whereClauses[] = "jobs.id = :idJob";
                $params[':idJob'] = $idJob;
            }

            $whereClause = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";

            // Construir la consulta SQL completa
            $query = "
                SELECT $fields
                FROM jobs
                $joinClause
                $whereClause
                ORDER BY jobs.created_at DESC
                LIMIT :limit
            ";
            // Preparar y ejecutar la consulta  
            $stmt = $this->connection->prepare($query);

            // Vincular los parámetros
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            // Vincular el límite
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                $this->logSearch($jobTitle,1);
                return $result;        
            } else {
                return [];
            }
        } catch (Exception $e) {
            error_log("Error searching jobs: " . $e->getMessage());
            return [];
        }
    }
      

/**
     * Buscar trabajos relacionados en base al ID de un trabajo.
     *
     * @param int $jobId ID del trabajo actual.
     * @return array Lista de trabajos relacionados.
     */
    public function getRelatedJobs(int $jobId, int $limit): array {
        try {
            // Obtener los detalles del trabajo actual
            $currentJob = $this->getJobDetails($jobId);
            if (!$currentJob) {
                return [];
            }

            // Extraer datos relevantes del trabajo actual
            $categoryId = $currentJob['category_id'];
            $employmentTypeId = $currentJob['employment_type_id'];
            $city = $currentJob['city'];
            $searchQuery = $currentJob['title'] . ' ' . $currentJob['job_description'];

            // Consulta SQL para buscar trabajos relacionados
            $query = "
                SELECT 
                    jobs.id, 
                    jobs.title, 
                    jobs.category_id, 
                    jobs.employment_type_id, 
                    jobs.city, 
                    MATCH(jobs.title, jobs.job_description) AGAINST(:search_query IN NATURAL LANGUAGE MODE) AS relevance
                FROM 
                    jobs
                
                WHERE 
                    jobs.id != :job_id
                    AND jobs.category_id = :category_id
                    AND jobs.is_active = 1
                    AND MATCH(title, job_description) AGAINST(:search_query IN NATURAL LANGUAGE MODE) >= 1
                ORDER BY 
                    relevance DESC, 
                    jobs.category_id = :category_id DESC, 
                    jobs.employment_type_id = :employment_type_id DESC, 
                    city = :city DESC
                LIMIT $limit
            ";

            // Preparar y ejecutar la consulta
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':search_query', $searchQuery);
            $stmt->bindValue(':job_id', $jobId, PDO::PARAM_INT);
            $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->bindValue(':employment_type_id', $employmentTypeId, PDO::PARAM_INT);
            $stmt->bindValue(':city', $city ?? '', PDO::PARAM_STR);
            $stmt->execute();

            // Devolver los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching related jobs: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener los detalles de un trabajo por su ID.
     *
     * @param int $jobId ID del trabajo.
     * @return array|null Detalles del trabajo o null si no existe.
     */
    private function getJobDetails(int $jobId): ?array {
        try {
            $query = "SELECT id, title, job_description, category_id, employment_type_id, city FROM jobs WHERE id = :job_id AND is_active = 1";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':job_id', $jobId, PDO::PARAM_INT);
            $stmt->execute();
            $job = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($job) {
                return $job;
            } else {
                return null;
            }
        } catch (Exception $e) {
            error_log("Error fetching job details: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Query data from a table with select fields. optional JOIN, conditions, pagination, and order by.
     * Usage:
     * ```php
     * // Sin JOIN
     * $results = $dbHelper->selectWithFields('users', 'user.id, user.name, user.created_at', "status = 1", 0, 10); // Fetch first 10 active users
     * with fields user.id, user.name, user.created_at
     *
     * // Con JOIN
     * $joinClause = "INNER JOIN profiles ON users.id = profiles.user_id";
     * $results = $dbHelper->selectWithFields('users','user.id, user.name, user.created_at', "status = 1", 0, 10, $joinClause); // Fetch users with profiles
     * ```
     *
     * Security Note: The use of PDO with placeholders (e.g., :column) prevents SQL injection.
     *
     * @param string $table The name of the table to query.
     * @param string $fields The fields to select.
     * @param string $conditions An associative array of column-value pairs to filter results.
     * @param int $offset The starting point for pagination (default: 0).
     * @param int|null $limit The maximum number of records to fetch (default: null).
     * @param string|null $joinClause The JOIN clause to include in the query (default: null).
     * @param string|null $orderBy The ORDER BY clause to include in the query (default: null).
     * @return array|null An array of results, or null if no results are found. 
     */

     public function selectWithFields(
        string $table,
        string $fields,
        string $conditions = '',
        ?string $orderBy = null,
        int $offset = 0,
        ?int $limit = null,
        ?string $joinClause = null
    ): ?array {
        if (empty($table) || empty($fields)) {
            error_log("Error: Los parámetros 'table' y 'fields' son obligatorios.");
            return ['Error'];
        }
    
        try {
            // Construir la cláusula WHERE
            $whereClauses = $conditions;
            
            $whereClause = !empty($whereClauses) ? "WHERE " . $whereClauses : "";
    
            // Construir la cláusula LIMIT
            $limitClause = $limit !== null ? "LIMIT $offset, $limit" : "";
    
            // Construir la consulta SQL
            $query = "SELECT $fields FROM $table";

            if ($joinClause) {
                $query .= " $joinClause"; // Agregar JOIN si está presente
            }
            $query .= " $whereClause";
            if ($orderBy !== null) {
                $query .= " ORDER BY $orderBy";
            }
            $query .= " $limitClause";


            //ejecutar consulta sin prepare
            $stmt = $this->connection->prepare($query);
            
            $stmt->execute();
            

            
            // Verificar errores
            if ($this->connection->errorCode() != 0) {
                error_log("Error: " . $this->connection->errorInfo());
                return [];
            }
            // Devolver los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error querying data: " . $e->getMessage());
            return [];
        }
    }




    /**
     * Get the last inserted record from a table.
     *
     * Usage:
     * ```php
     * $lastRecord = $dbHelper->getLastRecord('users');
     * ```
     *
     * @param string $table The name of the table to fetch the last record from.
     * @return array|null An associative array representing the last record, or null if no records exist.
     */
    public function getLastRecord(string $table): ?array {
        try {
            // Validar que la tabla existe
            $tables = $this->connection->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
            if (!in_array($table, $tables)) {
                error_log("Table '$table' does not exist");
                return null;
            }
            
            // Obtener la clave primaria de la tabla
            $primaryKey = 'id'; // valor por defecto
            $stmt = $this->connection->prepare("SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $primaryKey = $result['Column_name'];
            }
            
            // Preparar y ejecutar la consulta usando parámetros seguros
            $query = "SELECT * FROM `$table` ORDER BY `$primaryKey` DESC LIMIT 1";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching last record from '$table': " . $e->getMessage());
            return null;
        }
    }

    

    /**
     * Count the total number of records in a table.
     *
     * Usage:
     * ```php
     * $totalUsers = $dbHelper->countRecords('users', ['status' => 1]); // Count active users
     * ```
     *
     * @param string $table The name of the table to count records from.
     * @param array $conditions An associative array of column-value pairs to filter results.
     * @return int The total number of records matching the conditions.
     */
    public function countRecords( string $table, array $conditions = []): int {
        try {
            $whereClauses = [];
            foreach ($conditions as $key => $value) {
                $whereClauses[] = "$key = :$key";
            }
            $whereClause = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";

            $query = "SELECT COUNT(*) AS total FROM $table $whereClause";
            $stmt = $this->connection->prepare($query);

            foreach ($conditions as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$result['total'];
        } catch (Exception $e) {
            error_log("Error counting records: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Paginate records from a table.
     *
     * Usage:
     * ```php
     * $page = 2; // Page number
     * $perPage = 10; // Records per page
     * $results = $dbHelper->paginate('users', ['status' => 1], $page, $perPage);
     * ```
     *
     * @param string $table The name of the table to paginate.
     * @param array $conditions An associative array of column-value pairs to filter results.
     * @param int $page The current page number (starting from 1).
     * @param int $perPage The number of records per page.
     * @return array An array containing paginated results and total pages.
     */
    public function paginate( string $table, array $conditions = [], int $page = 1, int $perPage = 10): array {
        try {
            $offset = ($page - 1) * $perPage;

            // Fetch paginated results
            $results = $this->select($table, $conditions, $offset, $perPage);

            // Count total records
            $totalRecords = $this->countRecords($table, $conditions);
            $totalPages = ceil($totalRecords / $perPage);

            return [
                'results' => $results,
                'totalPages' => $totalPages,
                'currentPage' => $page,
                'totalRecords' => $totalRecords,
            ];
        } catch (Exception $e) {
            error_log("Error paginating records: " . $e->getMessage());
            return [
                'results' => [],
                'totalPages' => 0,
                'currentPage' => $page,
                'totalRecords' => 0,
            ];
        }
    }

    /**
     * Get user by email and password.
     * @param mixed $email
     * @param mixed $password
     * @return array
     */
    public function getUserByEmail($email, $password): array {
        try {
            // First get the user by email only
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Debug: Log the user data
            error_log("User data: " . print_r($user, true));
            
            // If user exists and has a password field, verify password
            if ($user && isset($user['password_hash']) && !empty($user['password_hash'])) {
                if (password_verify($password, $user['password_hash'])) {
                    //update last login
                    $this->updateLastLogin($user['id']);
                    return $user;
                }
            } else if ($user) {
                // Temporary solution: If there's no hashed password yet, allow login
                // This should be removed in production and proper password hashing implemented
                error_log("User found but no password hash exists");
                return $user;
            }
            return [];
        } catch (Exception $e) {
            error_log("Error getting user by email: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Update the last login time for a user.
     * @param int $userId The ID of the user to update.
     */
    private function updateLastLogin($userId) {
        $query = "UPDATE users SET last_login = NOW() WHERE id = :userId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
    }

    /**
     * Get the last login time for a user.
     * @param int $userId The ID of the user to get.
     * @return string The last login time.
     */
    public function getLastLogin($userId) {
        $query = "SELECT last_login FROM users WHERE id = :userId";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

}
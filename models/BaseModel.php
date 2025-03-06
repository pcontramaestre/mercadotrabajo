<?php
// models/BaseModel.php
require_once 'functions/functions.php';
require_once 'config/config.php';
require_once 'helpers/DatabaseHelper.php';

class BaseModel {
    protected $dbHelper;
    protected $tableName;
    protected $configuration;

    public function __construct($pdo) {
        $this->dbHelper = new DatabaseHelper($pdo);
        $this->configuration = new Config();
    }

    public function getTableName($tableName) {
        return $this->tableName = $tableName;
    }

    public function getDbHelper() {
        return $this->dbHelper;
    }

    public function getLastRecord() {
        return $this->dbHelper->getLastRecord($this->tableName);
    }

    public function countRecords($conditions = []) {
        return $this->dbHelper->countRecords($this->tableName, $conditions);
    }

    public function paginate($conditions = [], $page = 1, $perPage = 10) {
        return $this->dbHelper->paginate($this->tableName, $conditions, $page, $perPage);
    }

    public function insert(string $table, array $data) {
        return $this->dbHelper->insert($table, $data);
    }

    public function update(string $table, array $data, array $conditions): int {
        return $this->dbHelper->update($table, $data, $conditions);
    }

    public function delete(string $tablaName,array $conditions) {
        return $this->dbHelper->delete($tablaName, $conditions);
    }

    public function select($tableName, $conditions = [], $orderBy = 'id DESC', $offset = 0, $limit = null, $joinClause = null) {
        return $this->dbHelper->select($tableName, $conditions, $orderBy, $offset, $limit, $joinClause);
    }

    public function selectWithFields($tableName, $fields, $conditions ='', $orderBy = 'id DESC', $offset = 0, $limit = null, $joinClause = null) {
        return $this->dbHelper->selectWithFields($tableName, $fields, $conditions, $orderBy, $offset, $limit, $joinClause);
    }

    public function selectManual(string $query, int $offset = 0, ?int $limit = null): array{
        return $this->dbHelper->selectManual($query, $offset, $limit);
    }

    public function searchJobs($field_job, $field_postal, $field_category, $limit, $jobID = null): array{
        return $this->dbHelper->searchJobs($field_job, $field_postal, $field_category, $limit, $jobID);
    }

    public function getRelatedJobs($jobID, $limit): array{
        return $this->dbHelper->getRelatedJobs($jobID, $limit);
    }
}
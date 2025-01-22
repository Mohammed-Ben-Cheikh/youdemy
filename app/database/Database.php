<?php

class Database
{
    private $host = "localhost";
    private $db_name = "youdemy";
    private $username = "root";
    private $password = "";
    private $conn = null;
    private $error;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db_name}";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                error_log("Database connection error: {$this->error}", 0); // Log errors instead of echoing them
                return null;
            }
        }

        return $this->conn;
    }

    public function getError()
    {
        return $this->error;
    }
}

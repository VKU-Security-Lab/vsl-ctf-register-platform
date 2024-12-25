<?php
class Database
{
    private $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/Database.php';

        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function select($query, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            die("Select query failed: " . $e->getMessage());
        }
    }

    public function execute($query, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Execute query failed: " . $e->getMessage());
        }
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function close()
    {
        $this->pdo = null;
    }

}
?>
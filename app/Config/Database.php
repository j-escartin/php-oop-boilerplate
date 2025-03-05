<?php
namespace James\PhpOopBoilerplate\Config;

use PDO;
use PDOException;
use RuntimeException;

class Database {
  private static ?Database $instance = null;
  private  PDO $conn;

  private function __construct(array $config)  {
    try {
      $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['db_name']};charset=utf8mb4";
      $this->conn = new PDO($dsn, $config['username'], $config['password']);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException  $e) {
      throw new RuntimeException("Database connection failed: " . $e->getMessage());
    }
  }

  public static  function getInstance(array $config) {
    if(!self::$instance) {
      self::$instance = new Database($config);
    }
    return self::$instance;
  }

  public function getConnection()  {
    return $this->conn;
  }
}
<?php
namespace James\PhpOopBoilerplate\Config;

use PDO;
use PDOException;

class Database {
  private static $instance = null;
  private $conn;

  private function __construct()  {
    //load env variables
    $env =  parse_ini_file(__DIR__ .  '/../../.env');

    $host = $env['DB_HOST'] ?? 'localhost';
    $port = $env['DB_PORT'] ?? '3306';
    $db_name =  $env['DB_NAME'] ?? 'app';
    $username = $env['DB_USER'] ?? 'root';
    $password = $env['DB_PASS'] ?? '';

    try {
      $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4";
      $this->conn = new PDO($dsn, $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException  $e) {
      die("Database connection failed: " . $e->getMessage());
    }
  }

  public static  function getInstance() {
    if(!self::$instance) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection()  {
    return $this->conn;
  }
}
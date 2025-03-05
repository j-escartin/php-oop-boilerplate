<?php
namespace James\PhpOopBoilerplate\Models;

use James\PhpOopBoilerplate\Config\Database;
use PDO;

class Student {
  private PDO $conn;

  public function  __construct(PDO $conn) {
    $this->conn = $conn;
  }

  public function create($name, $age,  $year_level) {
    $sql = "INSERT INTO student (name, age,  year_level) VALUES (:name, :age, :year_level)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':year_level', $year_level);
    return $stmt->execute();
  }
}
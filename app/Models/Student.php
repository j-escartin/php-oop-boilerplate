<?php
namespace James\PhpOopBoilerplate\Models;

use James\PhpOopBoilerplate\Config\Database;

class Student {
  private $conn;

  public function  __construct() {
    $this->conn = Database::getInstance()->getConnection();
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
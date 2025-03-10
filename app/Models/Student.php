<?php
namespace James\PhpOopBoilerplate\Models;

use James\PhpOopBoilerplate\Config\Database;
use PDO;
use PDOException;

class Student {
  private PDO $conn;

  public function  __construct(PDO $conn) {
    $this->conn = $conn;
  }

  public function create($name, $age,  $year_level) {
    try {
      $sql = "INSERT INTO student (name, age,  year_level) VALUES (:name, :age, :year_level)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':age', $age);
      $stmt->bindParam(':year_level', $year_level);
      return $stmt->execute();
    }  catch (PDOException $e) {
      return false;
    }
  }

  public function getStudents() {
    try{
      $sql = "SELECT * FROM student";
      $stmt = $this->conn->query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  catch (PDOException $e) {
      return [];
    }
  }

  public function getStudentById($id){
    try {
      $sql = "SELECT * FROM student WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return [];
    }
  }
}
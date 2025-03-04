<?php

use James\PhpOopBoilerplate\Config\Database;
use James\PhpOopBoilerplate\Models\Student;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase {
  public function testCreateMethod(){
    // Mock PDO and PDO Statement
    $pdoMock = $this->createMock(PDO::class);
    $stmtMock = $this->createMock(PDOStatement::class);

    // Ensure prepare()return  a mock statement
    $pdoMock->method('prepare')->willReturn($stmtMock);

    // Ensure execute() is  called and return true
    $stmtMock->method('execute')->willReturn(true);

    //Mock Database Class
    $dbMock = $this->createMock(Database::class);
    $dbMock->method('getConnection')->willReturn($pdoMock);

    //Inject MockDb to Student
    $student = new Student();
    
    //Use Reflection to override private $conn
    $reflection = new \ReflectionClass($student);
    $property = $reflection->getProperty('conn');
    $property->setAccessible(true);
    $property->setValue($student, $pdoMock);

    // Run Test
    $result = $student->create('Jake', 15, '10');

    // Assert that it return true
    $this->assertTrue($result);
    
  } 
}
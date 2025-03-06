<?php
use James\PhpOopBoilerplate\Models\Student;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

use function PHPUnit\Framework\once;

class StudentTest extends TestCase {
  public function testCreateStudentSuccessfully(){

    $stmtMock = $this->createMock(PDOStatement::class);
    $stmtMock->expects($this->once())->method('execute')->willReturn(true);

    $pdoMock = $this->createMock(PDO::class);
    $pdoMock->expects($this->once())->method('prepare')->willReturn($stmtMock);

    /**
     * @var PDO&MockObject $pdoMock
     */
    $student = new Student($pdoMock);
    $result  = $student->create('John',  16, '12');

    $this->assertTrue($result);
  } 

  public function testCreateStudentFail() {
    $stmtMock = $this->createMock(PDOStatement::class);
    $stmtMock->expects($this->once())
      ->method('execute')
      ->willReturn(false);

    $pdoMock = $this->createMock(PDO::class);
    $pdoMock->expects($this->once())
      ->method('prepare')
      ->willReturn($stmtMock);

     /**
     * @var PDO&MockObject $pdoMock
     */
    $student = new Student($pdoMock);
    $result =  $student->create("Jane",  11, "Junior");

    $this->assertFalse($result);
  }

  public function testGetStudentsSuccess() {
    $stmtMock = $this->createMock(PDOStatement::class);
    $mockData = [
      ['id' => 1, 'name' => 'Jack', 'age' => 21, 'year_level' => '3'],
      ['id' => 2, 'name' => 'Jill', 'age' => 22, 'year_level' => '4'],
    ];

    $stmtMock->method('fetchAll')->willReturn($mockData);

    $pdoMock = $this->createMock(PDO::class);
    $pdoMock->method('query')->willReturn($stmtMock);

    /**
     * @var PDO&MockObject $pdoMock
     */
    $student = new Student($pdoMock);
  
    $this->assertEquals($mockData, $student->getStudents());
  }

  public function testGetStudentsReturnsNullOnException() {
    $mockPdo =  $this->createMock(PDO::class);
    $mockPdo->method('query')->willThrowException(new  PDOException("DB Error"));

    /**
     * @var PDO&MockObject $mockPdo
     */
    $studentModel = new Student($mockPdo);

    $this->assertEmpty($studentModel->getStudents());
  }
}
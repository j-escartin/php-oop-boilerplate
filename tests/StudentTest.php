<?php
use James\PhpOopBoilerplate\Models\Student;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

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
    $stmtMock =  $this->createMock(PDOStatement::class);
    $stmtMock->expects($this->once())->method('execute')->willReturn(false);

    $pdoMock = $this->createMock(PDO::class);
    $pdoMock->expects($this->once())->willReturn($stmtMock);

     /**
     * @var PDO&MockObject $pdoMock
     */
    $student = new  Student($pdoMock);
    $result =  $student->create("Jane",  11, "Junior");

    $this->assertFalse($result);
  }
}
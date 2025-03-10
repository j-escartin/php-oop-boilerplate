<?php

use James\PhpOopBoilerplate\Controllers\StudentController;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use James\PhpOopBoilerplate\Models\Student;;

class StudentControllerTest extends TestCase {
  public function testStoreCreatesStudentSuccessfully() {
    /**
     * @var Student&MockObject $mockStudent 
     */
    $mockStudent = $this->createMock(Student::class);
    $mockStudent->expects($this->once())
      ->method('create')
      ->with('Jake', 20, '1st Year')
      ->willReturn(true);

    $controller = new StudentController($mockStudent, [
      'name' => 'Jake',
      'age' => 20,
      'year_level' => '1st Year'
    ]);

    $result = $controller->store();
    $this->assertTrue($result);
  }

  public function testRetrieveStudents() {
    $studentModelMock =  $this->createMock(Student::class);

    $expectedStudents = [
      ['name' => 'Jack', 'age' => 20, 'year_level' => 'Sophomore'],
      ['name' => 'Jane Smith', 'age' => 22, 'year_level' => 'Senior']
    ];

    $studentModelMock->method('getStudents')->willReturn($expectedStudents);

    /**
     * @var Student&MockObject $studentModelMock
     */
    $controller = new StudentController($studentModelMock);

    $actualStudents = $controller->retrieveStudents();
    $this->assertEquals($expectedStudents, $actualStudents);
  }

  public function testRetrieveStudentById() {
    $studentModelMock = $this->createMock(Student::class);

    $expectedResult = [
      ['name' => 'Jack', 'age' => 20, 'year_level' => 'Sophomore'],
    ];

    $studentModelMock->method('getStudentById')->willReturn($expectedResult);

    /**
     * @var Student&MockObject $studentModelMock
     */
    $controller = new StudentController($studentModelMock, ['id' => 1]);

    $actualResult = $controller->retrieveStudentById();
    $this->assertEquals($expectedResult, $actualResult);
  }
}
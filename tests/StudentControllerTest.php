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
}
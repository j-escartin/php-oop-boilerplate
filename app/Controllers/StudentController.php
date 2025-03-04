<?php

namespace James\PhpOopBoilerplate\Controllers;

use James\PhpOopBoilerplate\Models\Student;

class StudentController {
  private $studentModel;
  private $requestData;

  public function __construct(Student $studentModel, array $requestData = []) {
    $this->studentModel = $studentModel;
    $this->requestData = $requestData;
  }

  public function store()  {
    if (empty($this->requestData['name'] || empty($this->requestData['age'] || empty($this->requestData['year_level'])))) {
      return false;
    }

    return $this->studentModel->create(
      $this->requestData['name'],
      $this->requestData['age'],
      $this->requestData['year_level']
    );
  }
}
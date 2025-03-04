<?php

namespace James\PhpOopBoilerplate\Controllers;

use James\PhpOopBoilerplate\Models\Student;

class StudentController {
  public function store() {
    if($_SERVER['REQUEST_METHOD'] ===  'POST') {
      $name = $_POST['name'];
      $age = $_POST['age'];
      $year_level = $_POST['year_level'];

      if(!empty($name) && !empty($age) && !empty($year_level)){
        $student = new Student();
    
        if($student->create($name, $age, $year_level))  {
          header("Location: /?success=1");
          exit();
        } else {
          header("Location: /create?error=1");
          exit();
        }
      }
    }
  }
}
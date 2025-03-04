<?php
require_once __DIR__ . '/../vendor/autoload.php';

use James\PhpOopBoilerplate\Controllers\StudentController;
use James\PhpOopBoilerplate\Models\Student;

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if($request === '/' ||  $request === 'index.php') {
  require __DIR__ . '/../app/Views/landing.php';
} else if($request === '/create' && $_SERVER['REQUEST_METHOD'] === 'GET') {
  require_once __DIR__ . '/../app/Views/create.php';
} else if($request === '/create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $studentController = new StudentController(new Student(), $_POST);

  if($studentController->store()) {
    header('Location: /?success=1');
    exit();
  } else {
    header('Location: /create?error=1');
    exit();
  }
  
} else {
  http_response_code(404);
  echo "404 Not Found";
}
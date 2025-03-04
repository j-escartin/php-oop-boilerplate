<?php
require_once __DIR__ . '/../vendor/autoload.php';

use James\PhpOopBoilerplate\Controllers\StudentController;

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$student_controller = new  StudentController();

if($request === '/' ||  $request === 'index.php') {
  require __DIR__ . '/../app/Views/landing.php';
} else if($request === '/create' && $_SERVER['REQUEST_METHOD'] === 'GET') {
  require_once __DIR__ . '/../app/Views/create.php';
} else if($request === '/create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $student_controller->store();
} else {
  http_response_code(404);
  echo "404 Not Found";
}
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use James\PhpOopBoilerplate\Config\Database;
use James\PhpOopBoilerplate\Controllers\StudentController;
use James\PhpOopBoilerplate\Models\Student;

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$env = parse_ini_file(__DIR__ . '/../.env');

$dbConf = [
  'host' => $env['DB_HOST'] ?? 'localhost',
  'port' => $env['DB_PORT'] ?? '3306',
  'db_name' => $env['DB_NAME'] ?? 'app',
  'username' => $env['DB_USER'] ?? 'root',
  'password' => $env['DB_PASS'] ?? ''
];

//Get database Instance
$database = Database::getInstance($dbConf);
$pdo = $database->getConnection();

if($request === '/' ||  $request === 'index.php') {
  require __DIR__ . '/../app/Views/landing.php';
} else if($request === '/create' && $_SERVER['REQUEST_METHOD'] === 'GET') {
  require_once __DIR__ . '/../app/Views/create.php';
} else if($request === '/create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $studentController = new StudentController(new Student($pdo), $_POST);

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
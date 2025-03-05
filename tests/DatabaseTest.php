<?php

use James\PhpOopBoilerplate\Config\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase{
  public function testGetInstanceReturnsDatabaseInstance(){
    $config = [
      'host' => 'db',
      'port' => '3306',
      'db_name' => 'app',
      'username' => 'app',
      'password' => 'app',
    ];

    $db  = Database::getInstance($config);

    $this->assertInstanceOf(Database::class, $db);
    $this->assertInstanceOf(PDO::class, $db->getConnection());
  }

  public function  testGetInstanceThrowsExceptionOnFailure(){
    $config = [
      'host' => 'invalid_host',
      'port' => '3306',
      'db_name' => 'app',
      'username' => 'app',
      'password' => 'app',
    ];

    Database::getInstance($config);
    
    $this->expectException(\RuntimeException::class);
  }
}
<?php

namespace App;

use PDO;
use PDOException;
use Dotenv\Dotenv as Dotenv;

    $dotenv = Dotenv::createUnsafeImmutable( __DIR__.'/..');
    $dotenv->load();


class Database
{

    public $mysql;

    public function __construct()
    {
        try {
            $this->mysql = $this->getConnection();
           
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    private function getConnection()
    {

        $host       = getenv('DB_HOST');
        $user       = getenv('DB_USER');
        $pass       = getenv('DB_PASS');
        $database   = getenv('DB_DATABASE');

//        $host = "mysql8";
//        $user = "root";
//        $pass = "root";
//        $database = "crud";
        $charset = "utf-8";
        $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
        $pdo = new pdo("mysql:host={$host};dbname={$database};charset{$charset}", $user, $pass, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}

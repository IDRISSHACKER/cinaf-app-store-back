<?php

namespace Migration;

use Symfony\Component\Dotenv\Dotenv;

use \PDO;
use PDOException;

class Base{

    private static $_init;
    private static $dbhost;
    private static $dbname;
    private static $dbuser;
    private static $dbpass;

    public static function init()
    {

        if (is_null(self::$_init)) {
            $dotenv = new Dotenv();
            $dotenv->load(dirname(__DIR__) . '/.env');
            $dotenv->load(dirname(__DIR__) . '/.env', dirname(__DIR__) . '/.env.dev');

            self::$_init = new self();

            self::$dbhost = $_ENV['DB_HOST'];
            self::$dbname = $_ENV['DB_NAME'];
            self::$dbuser = $_ENV['DB_USER'];
            self::$dbpass = $_ENV['DB_PASS'];
            
        }

        return self::$_init;
    }
 
    public function queryHost(){
        $host = self::$dbhost;
        $dbname = self::$dbname;
        $dbuser = self::$dbuser;
        $dbpass = self::$dbpass;

        $pdo = new PDO("mysql:host=$host", $dbuser, $dbpass);

        $pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    }

    public function queryDb($request){
        $host = self::$dbhost;
        $dbname = self::$dbname;
        $dbuser = self::$dbuser;
        $dbpass = self::$dbpass;

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
        
        $pdo->query($request);
    }
}


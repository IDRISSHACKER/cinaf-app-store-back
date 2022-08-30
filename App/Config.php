<?php 
namespace App;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
	private $settings = [];
	private static $_init;

    public function __construct(){
		$dotenv = new Dotenv();
		$dotenv->load(dirname(__DIR__) . '/.env');
		$dotenv->load(dirname(__DIR__) . '/.env', dirname(__DIR__) . '/.env.dev');

    	$this->settings = [
			"DB_HOST" => $_SERVER['DB_HOST'],
			"DB_NAME" => $_SERVER['DB_NAME'],
			"DB_USER" => $_SERVER['DB_USER'],
			"DB_PASS" => $_SERVER['DB_PASS'],
		];

		//die(var_dump($this->settings));

    }


    public static function init(){

    	if(is_null(self::$_init)){

    		self::$_init = new self();
    	}

    	return self::$_init;
    }

	public function get($key){

		return $this->settings[$key];
	}

    
}

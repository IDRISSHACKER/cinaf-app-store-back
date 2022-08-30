<?php

namespace App;

use App\Database;
use App\Config;
/**
 * summary
 */
class App
{

    private static $database;
    
    /**
     * summary
     */
    public static function bdd()
    {

       if(is_null(self::$database)){

    		self::$database = new Database(

                Config::init()->get("DB_NAME"),
                Config::init()->get("DB_USER"),
                Config::init()->get("DB_PASS"),
                Config::init()->get("DB_HOST")

            );
       }

    	return self::$database;

    }

    public static function notFound(){

        header("HTTP/1.0 404 Not Found");
    
    }

}
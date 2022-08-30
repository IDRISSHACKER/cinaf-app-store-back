<?php
namespace Migration;

use Migration\Base;

class AdminMigration extends Base
{
    private static $_init;

    public static function init()
    {

        if (is_null(self::$_init)) {

            self::$_init = new self();
        }

        return self::$_init;
    }

    public function up()
    {
        $req = "CREATE TABLE IF NOT EXISTS admin (
            id int(11) AUTO_INCREMENT NOT NULL, 
            email VARCHAR(255),
            username VARCHAR(255),
            password VARCHAR(255),
            islogged BOOLEAN NOT NULL DEFAULT 0,
            jwt VARCHAR(455),
            createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updatedAt  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY(id)
        )";

        return self::queryDb($req);
    }
    
    public function down()
    {
        //
    }
    
    public function seed()
    {
        //
    }

    
}





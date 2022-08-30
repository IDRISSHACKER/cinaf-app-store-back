<?php

namespace Migration;

use Migration\Base;

class CoverMigration extends Base
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
        $req = "CREATE TABLE IF NOT EXISTS cover  (
                id int(11) AUTO_INCREMENT NOT NULL,
                fkSoftware int(11) NOT NULL,
                title VARCHAR(255) NOT NULL,
                img VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updatedAt  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY(id)
            );";

        self::queryDb($req);
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

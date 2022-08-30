<?php

namespace Migration;

use Migration\Base;

class VersionMigration extends Base
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
        $req ="CREATE TABLE IF NOT EXISTS version  (
                id int(11) AUTO_INCREMENT NOT NULL,
                fkSoftware int(11) NOT NULL,
                versionTag VARCHAR(10) NOT NULL,
                path VARCHAR(255) NOT NULL,
                slug VARCHAR(255),
                isCurrent BOOLEAN NOT NULL DEFAULT false,
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

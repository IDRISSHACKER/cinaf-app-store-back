<?php

namespace Migration\Relation;

use Migration\Base;

class Relation extends Base
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
        self::queryDb("ALTER TABLE media ADD FOREIGN KEY IF NOT EXISTS (fkSoftware) REFERENCES software (id) ON UPDATE CASCADE ON DELETE CASCADE;");
        self::queryDb("ALTER TABLE version ADD FOREIGN KEY IF NOT EXISTS (fkSoftware) REFERENCES software (id) ON UPDATE CASCADE ON DELETE CASCADE;");
        self::queryDb("ALTER TABLE downloaded ADD FOREIGN KEY IF NOT EXISTS (fkSoftware) REFERENCES software (id) ON UPDATE CASCADE ON DELETE CASCADE;");
        self::queryDb("ALTER TABLE software ADD FOREIGN KEY IF NOT EXISTS (fkSupport) REFERENCES support (id) ON UPDATE CASCADE ON DELETE CASCADE;");
        self::queryDb("ALTER TABLE cover ADD FOREIGN KEY IF NOT EXISTS (fkSoftware) REFERENCES software (id) ON UPDATE CASCADE ON DELETE CASCADE;");
    }

    public function down()
    {
        //
    }
}

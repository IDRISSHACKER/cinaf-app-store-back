<?php

namespace migration;

use Migration\Base;
use Migration\AdminMigration;
use Migration\DownloadedMigration;
use Migration\VersionMigration;
use Migration\SoftwareMigration;
use Migration\MediaMigration;
use Migration\SupportMigration;
use Migration\CoverMigration;
use Migration\Relation\Relation;

interface MigrationInterface
{
    public function up();
    public function down();
    public function seed();
}

class Migration
{
    public function up()
    {
        Base::init()->queryHost();
        AdminMigration::init()->up();
        DownloadedMigration::init()->up();
        VersionMigration::init()->up();
        SoftwareMigration::init()->up();
        MediaMigration::init()->up();
        SupportMigration::init()->up();
        CoverMigration::init()->up();
        Relation::init()->up();
    }
    
    public function down()
    {
        
    }

    public function seed()
    {
        
    }

}



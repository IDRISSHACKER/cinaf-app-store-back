<?php

namespace Model;

use Model\BaseModel;

interface VersionInterface
{
    const VERSION_TABLE = "media";
}

class Version extends BaseModel implements VersionInterface
{

    public function __construct()
    {
    }

    public function setVersion($version)
    {
        self::bdd()->save("INSERT INTO version (fkSoftware, versionTag, path) VALUES (?, ?, ?)", $version);
    }

    public function deleteVersion($id)
    {
        self::bdd()->delete("DELETE FROM version WHERE id = :id", ["id" => $id]);
    }

    public function getFkSoftware($path)
    {
        return self::bdd()->query("SELECT version.fkSoftware FROM version WHERE version.path = '$path'");
    }
}

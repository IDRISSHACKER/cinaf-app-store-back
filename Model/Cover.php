<?php

namespace Model;

use Model\BaseModel;
use Model\Software;

interface CoverInterface
{
    const COVER_TABLE = "cover";
}

class Cover extends BaseModel implements CoverInterface
{
    private $software;

    public function __construct()
    {
        $this->software = new Software();
    }

    public function setCover($cover)
    {
        self::bdd()->save("INSERT INTO cover (fkSoftware, title, img, description) VALUES (?, ?, ?, ?)", $cover);
    }

    public function getCovers()
    {
        $_covers = self::bdd()->query("SELECT * FROM cover");
        $covers = [];

        foreach($_covers as $cover){
            $softId = $cover["fkSoftware"];
            $soft = $this->software->getSoftwareById($softId);
            $cover["software"] = $soft;
            array_push($covers, $cover);
        }

        return $covers;
    }

    public function deleteCover($id)
    {
        self::bdd()->delete("DELETE FROM version WHERE id = :id", ["id" => $id]);
    }
}
 
<?php

namespace Model;

use Model\BaseModel;

interface DownloadedInterface
{
    const DOWNLOADED_TABLE = "downloaded";
}

class Downloaded extends BaseModel implements DownloadedInterface
{

    public function __construct()
    {
    }

    public function setDownloaded($downloaded)
    {
        self::bdd()->save("INSERT INTO downloaded (fkSoftware) VALUES (:fkSoftware)", $downloaded);
    }

    public function deleteDownloaded($id)
    {
        self::bdd()->delete("DELETE FROM downloaded WHERE id = :id", ["id" => $id]);
    }

    public function getDownloadeds()
    {
        return self::bdd()->query("SELECT id, count(fkSoftware) AS downloaded FROM downloaded GROUP BY (fkSoftware)");
    }

}

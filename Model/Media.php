<?php

namespace Model;

use Model\BaseModel;

interface MediaInterface
{
    const MEDIA_TABLE = "media";
}

class Media extends BaseModel implements MediaInterface
{

    public function __construct()
    {
    }

    public function setMedia($media)
    {
        return self::bdd()->save("INSERT INTO media (fkSoftware, type, isCover, path) VALUES (?, ?, ?, ?)", $media);
    }

    public function getMedia($mediaId)
    {
        return self::bdd()->query("SELECT * FROM media WHERE id = $mediaId");
    }

    public function deleteMedia($id)
    {
        self::bdd()->delete("DELETE FROM media WHERE id = :id", ["id" => $id]);
    }

}

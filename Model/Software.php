<?php
namespace Model;

use Model\BaseModel;
 
interface BaseModelInterface
{
    const SOFTWARE_TABLE = "software";
    const PER_PAGE = 10;

}

class Software extends BaseModel implements BaseModelInterface 
{

    public function __construct(){
        
    }

    public function getSoftwares()
    {
       return $this->getSoftwareLimited();
    }

    public function getSoftwareById($id){
        $software = self::bdd()->query("SELECT id, title, description,  fkSupport, createdAt, updatedAt, slug, store FROM software WHERE slug = '$id' ORDER BY id DESC");
       
        if(count($software) < 1){
            return false;
        }
        
        $keySupport = $software[0]["fkSupport"];
        $keySoftware = $software[0]["id"];

        $media = self::bdd()->query("SELECT * FROM media WHERE fkSoftware = $keySoftware");
        $support = self::bdd()->query("SELECT * FROM support WHERE id = $keySupport");
        $versions = self::bdd()->query("SELECT * FROM version WHERE fkSoftware = $keySoftware ORDER BY id DESC");
        $downloaded = self::bdd()->query("SELECT count(fkSoftware) AS downloaded FROM downloaded WHERE fkSoftware = $keySoftware ORDER BY id DESC");

        $software[0]["medias"] = $media;
        $software[0]["support"] = $support;
        $software[0]["versions"] = $versions;
        $software[0]["downloaded"] = $downloaded[0]["downloaded"];

        return $software[0];
    }

    public function setSoftware($software, $fkSupport){

        self::bdd()->update("UPDATE software set title = :title, description = :description where fkSupport = '$fkSupport'", $software);
    }

    public function updateSoftware($software){
        self::bdd()->update("UPDATE software SET title = :title, description = :description, fkSupport = :fkSupport WHERE id = :id", $software);
    }

    public function deleteSoftware($id){
        self::bdd()->delete("DELETE FROM software WHERE id = :id", ["id" => $id]);
    }

    public function getSoftwareLimited($page = 1){
        $perPage = self::PER_PAGE;
        $currentPageCount = $perPage * $page;
        $previousPageCount = $currentPageCount - $perPage;
        
        $softwares = [];

        $_softwares = self::bdd()->query("SELECT id, title, description,  fkSupport, createdAt, updatedAt, slug, store FROM software ORDER BY id DESC");


        $count = $previousPageCount;
        $countState = 0;
       
        foreach($_softwares as $soft){
            if($count < $currentPageCount AND $countState >= $previousPageCount){
                $keySupport = $soft["fkSupport"];
                $keySoftware = $soft["id"];

                $media = self::bdd()->query("SELECT * FROM media WHERE fkSoftware = $keySoftware");
                $support = self::bdd()->query("SELECT * FROM support WHERE id = $keySupport");
                $version = self::bdd()->query("SELECT * FROM version WHERE fkSoftware = $keySoftware ORDER BY id DESC");
                $downloaded = self::bdd()->query("SELECT count(fkSoftware) AS downloaded FROM downloaded WHERE fkSoftware = $keySoftware");

                $soft["medias"] = $media;
                $soft["support"] = $support;
                $soft["versions"] = $version;
                $soft["downloaded"] = $downloaded[0]["downloaded"];

                array_push($softwares, $soft);
                $count++;
            }
            $countState++;
        }
        return $softwares;
    }

}


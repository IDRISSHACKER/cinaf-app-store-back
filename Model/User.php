<?php

namespace Model;

use Model\BaseModel;

class User extends BaseModel {
    
    public function login($email, $password){
        $user = self::bdd()->query("SELECT * FROM admin WHERE email = '$email'");

        if(count($user) < 1){
            return false;
        }else{
           if(password_verify($password, $user[0]["password"])){
            return $user[0];
           }else{
            return false;
           }
        }
    }

    public function getUser($token){
        return self::bdd()->query("SELECT * FROM admin WHERE token = '$token'");
    }

    public function setTokenAndRefreshToken($token, $refreshToken, $user){

        return self::bdd()->save("UPDATE admin SET token = '$token', refreshToken = '$refreshToken' WHERE id = ? ", [$user]);
    }
    
    public function logout(){
        echo "User is logged out";
    }
    
}


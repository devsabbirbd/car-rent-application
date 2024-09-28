<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTToken{

    // Create Token for login User
    public static function create($userEmail,$userID,$role){
        $key =env('JWT_KEY');
        $payload=[
            'iss'=>'car-rental-token',
            'iat'=>time(),
            'exp'=>time()+60*60*24,
            'userEmail'=>$userEmail,
            'userID'=>$userID,
            'role'=>$role
        ];
        return JWT::encode($payload,$key,'HS256');
    }

    // Verify Token for login User
    public static function verify($token){
        try {
            if($token==null){
                return 'unauthorized';
            }
            else{
                $key =env('JWT_KEY');
                $decode=JWT::decode($token,new Key($key,'HS256'));
                return $decode;
            }
        }
        catch (Exception $e){
            return 'unauthorized';
        }
    }


    


}
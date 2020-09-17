<?php

namespace App\Model;

use Core\Model;
use Firebase\JWT\JWT;

class AuthJWT extends Model
{
    private static $secret = 'jwturnero';
    private static $encrypt = ['HS256'];
    private $aud = null;

    function __construct()
    {
    }


    //public static function register($data, $audFront)
    public static function register()
    {
        $time = time();
        /*if (!empty($audFront)) {
            $token = array(
                'exp' => $time + 120,
                'aud' => self::Aud(),
                'audFront' => $audFront,
                'data' => $data
            );
        } else {
            $token = array(
                'exp' => $time + (60 * 60),
                'aud' => self::Aud(),
                'data' => $data
            );
        }*/

        $token = array(
            'exp' => $time + 120,
            'aud' => self::Aud(),
        );

        return JWT::encode($token, self::$secret);
    }

    public static function check($token)
    {
        if (empty($token)) {
            //throw new Exception("TOKEN INVALIDO - VACIO");
            return false;
        }
        // $data = JWT::decode($token,  self::$secret, self::$encrypt);

        //var_dump($data);

        $decode = JWT::decode(
            $token,
            self::$secret,
            self::$encrypt
        );

        if ($decode->aud !== self::Aud()) {
            //throw new Exception("TOKEN INVALIDO");
            return false;
        } else return true;
    }

    public static function getData($token)
    {
        return JWT::decode(
            trim($token),
            self::$secret,
            self::$encrypt
        );
        //echo $token."<br>";


        /*if (!empty($return->aud))

            return $return;
        else return "TOKEN INVALIDO";*/
    }

    private static function Aud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();


        /* FALTA PONER $aud EN UN ARCHIVO DE LOG **/

        return sha1($aud);
    }
}

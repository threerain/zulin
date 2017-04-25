<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class Session
{
    public static function save($openid){

        //对openid进行处理保留后26位，并替换掉'_'为'-'
        $openid = substr($openid,-26);

        $openid = str_replace('_', '-', $openid);

        session_id($openid);
        
        session_start();
    }
}
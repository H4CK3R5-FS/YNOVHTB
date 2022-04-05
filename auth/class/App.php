<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2021-11-24 11:08:40
 */

class App{

    static $db = null;

    static function getDatabase(){
        if(!self::$db){
            self::$db = new Database('root', '', 'YnovHtb');
        }
        return self::$db;
    }

    static function getAuth(){
        return new Auth(Session::getInstance(), ['restriction_msg' => 'Lol tu es bloqué !']);
    }

    static function getAuthRequest(){
        return new Request(Session::getInstance(), ['restriction_msg' => 'Lol tu es bloqué !']);
    }

    static function redirect($page){
        header("Location: ".$page);
        exit();
    }

    static function resetHeader(){
        header_remove();
        exit();
    }

}

<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   BOUFALA Yacine
 * @Last Modified time: 2022-05-03 18:34:11
 */

class App{

    static $db = null;

    static function getDatabase(){
        if(!self::$db){
            self::$db = new Database('root', '', 'Ynovhtb');
        }
        return self::$db;
    }

    static function getAuth(){
        return new Auth(Session::getInstance(), ['restriction_msg' => 'Lol tu es bloqué !']);
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

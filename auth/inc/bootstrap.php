<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2022-03-31 23:19:07
 */

spl_autoload_register('app_autoload');

function app_autoload($class){
    require "../class/$class.php";
}
<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   root
 * @Last Modified time: 2021-10-28 23:29:31
 */

spl_autoload_register('app_autoload');

function app_autoload($class){
    require "../class/$class.php";
}
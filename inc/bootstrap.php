<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   root
 * @Last Modified time: 2022-04-05 17:11:12
 */

spl_autoload_register('app_autoload');

function app_autoload($class){
    require "auth/class/$class.php";
}
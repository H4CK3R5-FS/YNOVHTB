<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   root
 * @Last Modified time: 2022-04-05 17:14:53
 */

spl_autoload_register('app_autoload');

function app_autoload($class){
    require "class/$class.php";
}
<?php

/**
 * @Author: root
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   root
 * @Last Modified time: 2021-10-20 15:03:52
 */

spl_autoload_register('app_autoload');

function app_autoload($class){
    require "class/$class.php";
}
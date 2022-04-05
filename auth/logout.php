<?php

/**
 * @Author: root
 * @Date:   2021-10-20 16:44:31
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2022-03-31 23:23:07
 */

    require_once 'inc/bootstrap.php';

    $auth = App::getAuth();
    $db = App::getDatabase();
    $auth->connectFromCookie($db);

    App::getAuth()->logout();
    // pop-up !
    Session::getInstance()->setFlash('success', 'Your now logged out');
    App::redirect('index.php');
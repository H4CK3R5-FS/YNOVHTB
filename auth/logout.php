<?php

/**
 * @Author: root
 * @Date:   2021-10-20 16:44:31
 * @Last Modified by:   root
 * @Last Modified time: 2021-11-10 14:41:48
 */

    require_once '../inc/bootstrap_auth.php';

    $auth = App::getAuth();
    $db = App::getDatabase();
    $auth->connectFromCookie($db);

    App::getAuth()->logout();
    // pop-up !
    Session::getInstance()->setFlash('success', 'Your now logged out');
    App::redirect('../index.php');
<?php

/**
 * @Author: root
 * @Date:   2021-10-20 16:44:31
 * @Last Modified by:   root
 * @Last Modified time: 2021-10-20 16:46:48
 */

    require_once 'inc/bootstrap.php';

    $auth = App::getAuth();
    $db = App::getDatabase();
    $auth->connectFromCookie($db);

    App::getAuth()->logout();
    // pop-up !
    // Session::getInstance()->setFlash('success', 'Vous êtes maintenant déconnecté');
    App::redirect('../index.php');
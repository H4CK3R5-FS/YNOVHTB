<?php

/**
 * @Author: yacine.B
 * @Date:   2021-11-10 16:04:14
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2021-11-10 16:14:57
 */
require_once '../inc/bootstrap_auth.php';
require_once '../inc/components/header.php';

$errors = [];
    
$validator = new Validator($_POST);
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);  

if(!(App::getAuth()->user())):
    $session = Session::getInstance();
    $session->setFlash('danger', 'Vous devez être connecter avant de continuer !');
    App::redirect('../index.php');
endif;

?>


<!-- Html ICI !!! -->


<?php require_once '../inc/components/header.php'; ?>
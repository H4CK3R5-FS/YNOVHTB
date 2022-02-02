<?php

/**
 * @Author: root
 * @Date:   2021-11-10 10:30:04
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2021-11-10 16:09:55
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

echo $auth->user()->pseudo.'</br>';
?>

<a href="../auth/logout.php">LOGOUT !</a>
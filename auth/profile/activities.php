<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-04-06 02:09:22
 */

require_once "inc/bootstrap.php";

$errors = array();

$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if(!($auth->user())){
	$session = Session::getInstance();
	$session->setFlash('danger', 'Vous devez être connecter avant de continuer !');
	App::redirect('../index.php');
}

$active_act = true;
require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';

?>

<div class="main-panel">
   <div class="content">
      <div class="page-inner">
         <!--  -->

         
         
         
         <!--  -->
      </div>
   </div>
</div>


<?php require_once 'inc/components/footer.php'; ?>
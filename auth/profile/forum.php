<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   BOUFALA Yacine
 * @Last Modified time: 2022-05-03 19:49:14
 */

    require_once "inc/bootstrap.php";

    $errors = array();
    
    $req = new Request();
    $auth = App::getAuth();
    $db = App::getDatabase();
    $auth->connectFromCookie($db);

    if(!($auth->user())){
        $session = Session::getInstance();
        $session->setFlash('danger', 'Vous devez être connecter avant de continuer !');
        App::redirect('../index.php');
    }

    $active_forum = true;
    require_once 'inc/components/header.php';
    require_once 'inc/components/nav_bar.php';
    require_once 'inc/components/side_bar.php';

?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Dolorem eligendi, quo dignissimos? Ex iste similique, odio harum, quisquam neque vel, magni repellat distinctio aperiam sunt maiores voluptates non. Ipsa, temporibus?
		</div>
	</div>
</div>
<?php require_once 'inc/components/footer.php'; ?>
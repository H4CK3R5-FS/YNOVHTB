<?php

/**
 * @Author: root
 * @Date:   2022-05-04 05:03:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 15:33:29
 */

require_once "inc/bootstrap.php";

$errors = array();

$validator = new Validator($_POST);
$validator_file = new Validator($_FILES);

$req = new Request();

$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if(!($auth->user())){
	$session = Session::getInstance();
	$session->setFlash('danger', 'Vous devez être connecter avant de continuer !');
	App::redirect('../index.php');
}


if ($_POST):
	var_dump($_POST);
	var_dump(explode('.', $_FILES['c_file']['name']));
endif;


require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';

?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">




			
			


		</div>
	</div>
</div>


<?php require_once 'inc/components/footer.php'; ?>
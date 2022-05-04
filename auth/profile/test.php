<?php

/**
 * @Author: root
 * @Date:   2022-05-04 05:03:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 05:07:28
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

?>



<form method="POST" enctype="multipart/form-data">
	<div class="col-md-12">
		<div class="form-group">
			<div class="custom-file bg-dark">
				<input type="file" class="custom-file-input" name="c_file" id="customFile" required>
				<label class="custom-file-label" for="customFile">
					<span class="text-muted">Your Challenge</span>
				</label>
			</div>
		</div>
	</div>

	<button type="submit" name="add-challenge" class="btn text-white py-2 px-4" style="background: #5867dd;">
		<span class="h3 text-white">Save changes</span>
	</button>
</form>
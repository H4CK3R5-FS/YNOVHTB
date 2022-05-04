<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 13:15:13
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





require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';


?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">

			<div class="mb-4">
				<span class="text-white h1">Edit Profil</span>
			</div>

			<div class="container">
				<form method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="row">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="challenge_name">Pseudo</label>
										<input type="text" class="form-control" name="pseudo" id="challenge_name" value="<?= $auth->user()->pseudo; ?>" placeholder="Pseudo">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="challenge_flag">E-mail</label>
										<input type="text" class="form-control" name="email" id="challenge_flag" value="<?= $auth->user()->email; ?>" placeholder="E-mail">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="challenge_flag">password</label>
										<input type="text" class="form-control" name="pass" id="challenge_flag" placeholder="Password">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="challenge_flag">confirm password</label>
										<input type="text" class="form-control" name="pass_confirm" id="challenge_flag" placeholder="Confirm Password">
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="modal-footer">
						<a href="profile.php"><button type="submit" name="add-challenge" class="btn text-white py-2 px-4" style="background: #5867dd;">
							<span class="h3 text-white">Save changes</span>
						</button> </a>
						<a href="index.php"><button type="button" class="btn btn-danger py-2 px-4" data-dismiss="modal">
							<span class="h3 text-white">Close</span>
						</button></a>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<?php require_once 'inc/components/footer.php'; ?>  
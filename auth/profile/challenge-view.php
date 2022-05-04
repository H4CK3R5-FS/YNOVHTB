<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 14:52:22
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


try {
	if(!$req->isIndexHere($db, 'challenge', 'token=?', [htmlspecialchars($_GET['token'])])):
		App::redirect('index.php');
	endif;
} catch (Exception $e) {}

$active_act = true;

require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';

?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="mb-4">
				<span class="text-white h1"><?= $req->getThis($db, 'challenge', 'token=?', [htmlspecialchars($_GET['token'])], 'c_name')->c_name; ?></span>
			</div>
			<!-- ... -->
			<div class="row">
				
				<div class="col-md-4">
					<a href="action.php?page=activities&token=<?= htmlspecialchars($_GET['token']); ?>">
						<span aria-expanded="false" class="p-3 text-white" style="font-size:120px;border: 1px solid;">
							<i class="fas fa-download"></i>
						</span>
					</a>
				</div>

			</div>
			<!-- ... -->
		</div>
	</div>
</div>

<?php require_once 'inc/components/footer.php'; ?>
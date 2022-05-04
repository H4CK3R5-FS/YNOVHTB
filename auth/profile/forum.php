<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 13:02:00
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

			<div class="mb-4">
				<span class="text-white h1">Forum</span>
			</div>

			<div class="card text-left">
				<div class="card-body">
					<h5 class="card-title">Lorem ipsum dolor sit</h5>
					<div class="row">
						<div class="col-md-10">
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. A doloribus rerum, dolor id ?</p>
						</div>
						<div class="col-md-2">
							<a href="forum-rep.php">
								<button type="button" class="btn btn-outline-success">Voir Plus</button>
							</a> 
						</div>
					</div>
				</div>
				<div class="card-footer text-muted">
					2 days ago
				</div>
			</div>

			<div class="card text-left">
				<div class="card-body">
					<h5 class="card-title">Lorem ipsum dolor sit</h5>
					<div class="row">
						<div class="col-md-10">
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. A doloribus rerum, dolor id ?</p>
						</div>
						<div class="col-md-2">
							<a href="forum-rep.php">
								<button type="button" class="btn btn-outline-success">Voir Plus</button>
							</a> 
						</div>
					</div>
				</div>
				<div class="card-footer text-muted">
					10 days ago
				</div>
			</div>

			<div class="card text-left">
				<div class="card-body">
					<h5 class="card-title">Lorem ipsum dolor sit</h5>
					<div class="row">
						<div class="col-md-10">
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. A doloribus rerum, dolor id ?</p>
						</div>
						<div class="col-md-2">
							<a href="forum-rep.php">
								<button type="button" class="btn btn-outline-success">Voir Plus</button>
							</a> 
						</div>
					</div>
				</div>
				<div class="card-footer text-muted">
					100 days ago
				</div>
			</div>

			<div class="card text-left">
				<div class="card-body">
					<h5 class="card-title">Lorem ipsum dolor sit</h5>
					<div class="row">
						<div class="col-md-10">
							<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. A doloribus rerum, dolor id ?</p>
						</div>
						<div class="col-md-2">
							<a href="forum-rep.php">
								<button type="button" class="btn btn-outline-success">Voir Plus</button>
							</a> 
						</div>
					</div>
				</div>
				<div class="card-footer text-muted">
					250 days ago
				</div>
			</div>


		</div>
	</div>
</div>

<?php require_once 'inc/components/footer.php'; ?>
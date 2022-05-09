<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 15:40:09
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

			<?php if(isset($active_forum) and $active_forum): ?>
				


				<div data-toggle="modal" data-target="#add_article">
					<span style="font-size: 25px;"><i class="fas fa-plus-circle"></i></span>
				</div>

				<!-- Modal -->
				<div class="modal fade" style="" id="add_article" tabindex="-1" role="dialog" aria-labelledby="addArticleModals" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content" style="background-color: #1a2035; opacity: 0.8;">
							<div class="modal-header">
								<h5 class="modal-title h2 text-white" id="addArticleModals">Add Challenge</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							
							<form method="POST" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="row">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="challenge_name">Article Title</label>
													<input type="text" class="form-control" name="a_name" id="challenge_name" placeholder="Name" required>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="challenge_description">Article Description</label>
													<textarea class="form-control" name="a_description" id="challenge_description" rows="3"></textarea>
												</div>
											</div>

										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" name="add-challenge" class="btn text-white py-2 px-4" style="background: #5867dd;">
										<span class="h3 text-white">Add Article</span>
									</button>
									<button type="button" class="btn btn-danger py-2 px-4" data-dismiss="modal">
										<span class="h3 text-white">Close</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>



			<?php endif; ?>

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
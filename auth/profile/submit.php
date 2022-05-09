<?php

/**
 * @Author: B. Yacine
 * @Date:   2022-05-04 03:16:43
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 16:12:37
 */


require_once "inc/bootstrap.php";

$errors = array();

$validator = new Validator($_POST);

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

	$validator->isAlpha('c_name', 'Invalid Challenge name');
	$validator->isSized('c_flag', 10, 100);
	
	if($validator->isValid()):
		$validator->isUniq('c_name', $db, 'challenge', 'Name already taken');
	endif;

	$validator->isAlpha('c_flag', 'Invalid Challenge flag');
	$validator->isSized('c_flag', 10, 200);

	$validator->isAlpha('c_category', 'Invalid Challenge flag'); # ajouter une securité la dessus !
	$validator->isSized('c_category', 1, 25);


	$validator->isSized('c_description', 0, 500);
	$validator->isSized('c_add_infos', 0, 500);

	$validator_file = new Validator($_FILES['c_file']);
	$validator_file->isErrorOk('c_file');

	if ($validator->isValid() and $validator_file->isValid()):
		$attributes = "c_name=?, c_flag=?, c_description=?, c_add_infos=?, exp=?, c_category=?, path=?, token=?, token_uploader=?, date_at=NOW()";
		$value = [
			htmlspecialchars(ucfirst(strtolower($_POST['c_name']))),
			htmlspecialchars($_POST['c_flag']),
			(htmlspecialchars($_POST['c_description']) == null)? null : htmlspecialchars($_POST['c_description']),
			(htmlspecialchars($_POST['c_add_infos']) == null)? null : htmlspecialchars($_POST['c_add_infos']) == null,
			100,
			htmlspecialchars($_POST['c_category']),
			$validator_file->moveFile('tmp_name', 'name'),
			Str::random(20),
			$auth->user()->token
		];
		$req->addIndex($db, 'challenge', $attributes, $value);
	else:
		$errors = array_merge($validator->getErrors(), $validator_file->getErrors());
	endif;
endif;

$active_submit = true;
$history = $req->getAllIndex($db, 'challenge', 'token_uploader=?', [$auth->user()->token]);
$adopted_challenges = $req->getAllIndex($db, 'challenge', 'token_uploader=? and Status=?', [$auth->user()->token, 'Confirmed']);

require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="mb-4">
				<span class="text-white h1">Submit your challenges!</span>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div data-toggle="modal" data-target="#add-challengehallenge" class="card">
								<div class="card-body">
									<div style="min-height: 300px">
										<span style="font-size: 200px;opacity: 0.4;margin-left: 43%;"><i class="fas fa-plus-circle"></i></span>
										<p class="text-white text-center h3">Add your challenge.</p>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="add-challengehallenge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content" style="background-color: #1a2035; opacity: 0.8;">
									<div class="modal-header">
										<h5 class="modal-title h2 text-white" id="exampleModalLabel">Add Challenge</h5>
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
															<label for="challenge_name">Challenge Name</label>
															<input type="text" class="form-control" name="c_name" id="challenge_name" placeholder="Name" required>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<label for="challenge_flag">Challenge Flag</label>
															<input type="text" class="form-control" name="c_flag" id="challenge_flag" placeholder="Flag" required>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<label for="challenge_category">category</label>
															<select class="form-control" name="c_category" id="challenge_category">
																<option>Craking</option>
																<option>Web Client</option>
																<option>Reverse engineering</option>
																<option>Network</option>
																<option>Forensic</option>
																<option>Programming</option>
															</select>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<label for="challenge_description">Challenge Description</label>
															<textarea class="form-control" name="c_description" id="challenge_description" rows="3"></textarea>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<label for="challenge_add-infos">additional information</label>
															<textarea class="form-control" name="c_add_infos" id="challenge_add-infos" rows="3"></textarea>
														</div>
													</div>

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

												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" name="add-challenge" class="btn text-white py-2 px-4" style="background: #5867dd;">
												<span class="h3 text-white">Save changes</span>
											</button>
											<button type="button" class="btn btn-danger py-2 px-4" data-dismiss="modal">
												<span class="h3 text-white">Close</span>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8" >
					<div class="card">
						<div class="card-header">
							<div class="card-head-row">
								<div class="card-title">
									<span class="text-white"><span class="mr-2"><i class="fas fa-history"></i></span>Submit History</span>
								</div>
							</div>
						</div>

						<div class="card-body">
							<?php if($history != null): ?>
								<?php foreach($history as $hist): ?>
									<div class="d-flex">
										<div class="flex-1 ml-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1"><?= $hist->c_name; ?>
											<?php if($hist->Status == 'Confirmed'): ?>
												<span class="text-white float-right h3">
													<i class="fas fa-check-circle"></i>
												</span>
											<?php endif; ?>
										</h6>
									</div>
								</div>

								<div class="separator-dashed"></div>
							<?php endforeach; ?>
						<?php endif; ?>

					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div class="card-head-row">
							<div class="card-title">
								<span class="text-white"><span class="mr-2"><i class="fas fa-check"></i></span>Adopted Challenge</span>
							</div>
						</div>
					</div>

					<div class="card-body">
						<?php if($adopted_challenges != null): ?>
							<?php foreach($adopted_challenges as $checked): ?>
								<div class="d-flex">
									<div class="flex-1 ml-3 pt-1">
										<h6 class="text-uppercase fw-bold mb-1"><?= $checked->c_name; ?>
										<span class="text-white float-right">
											<i class="fas fa-thumbs-down"></i>
											<?= $req->getCount($db, 'rating_challenges', 'rate_negative=? and rate_positive IS NULL', [1]); ?>
										</span>
										<span class="text-white float-right px-4">
											<i class="fas fa-thumbs-up"></i>
											<?= $req->getCount($db, 'rating_challenges', 'rate_positive=? and rate_negative IS NULL', [1]); ?>
										</span>
									</h6>
								</div>
							</div>

							<div class="separator-dashed"></div>
						<?php endforeach; ?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<?php require_once 'inc/components/footer.php'; ?>
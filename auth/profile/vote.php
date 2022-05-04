<?php

/**
 * @Author: B. Yacine
 * @Date:   2022-05-04 03:16:43
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 14:46:13
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

$active_vote = true;
$challanges = $req->getAllIndex($db, 'challenge', 'Status=? AND date_at > DATE_SUB(NOW(), INTERVAL 30 DAY) ', ['pendding'], $getValue='*', 'limit 3');

require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';

?>
<link rel="stylesheet" href="assets/css/vote-style.css">

<div class="main-panel">
	<div class="content">
		<div class="page-inner">

			<section class="dark">
				<div class="container py-4">
					<h1 class="h1 text-center" id="pageHeaderTitle">
						<?= ($challanges == null)? "<span>Sorry, There's no challange to vote for.</span>" : 'challenge of the month <br> <small class="text-danger">All votes are final</small>' ?></h1>

						<?php if($challanges != null): ?>
							<?php foreach($challanges as $challange): ?>
								<article class="postcard dark <?= Str::random_color(); ?>">
									<a class="postcard__img_link" href="#">
										<img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
									</a>
									<div class="postcard__text">
										<?php 
										$uploader = $req->getThis($db, 'users', 'token=?', [htmlspecialchars($challange->token_uploader)], $getValue="pseudo")->pseudo;
										?>
										<h1 class="postcard__title blue"><a href="#"><?= $challange->c_name;  ?></a></h1>
										<div class="postcard__subtitle small">
											<i class="fas fa-user"></i> 
											<span class="text-white"><?= $uploader; ?></span>
										</div>
										<div class="postcard__bar"></div>
										<div class="postcard__preview-txt"><?= $challange->c_description; ?></div>
										<ul class="postcard__tagbox">
											<li class="tag__item p-3">
												<a class="px-3 py-2" href="action.php?page=vote&token=<?= $challange->token; ?>&answer=yes">
													<i class="fas fa-thumbs-up"></i>
													<span class="text-white px-2">
														<?= $req->getCount($db, 'rating_challenges', 'rate_positive=? and rate_negative IS NULL and token_challenge=?', [1, $challange->token]); ?>
													</span>
												</a>
											</li>
											<li class="tag__item p-3 play red"> 
												<a class="px-3 py-2" href="action.php?page=vote&token=<?= $challange->token; ?>&answer=no">
													<i class="fas fa-thumbs-down"></i>
													<span class="text-white px-2">
														<?= $req->getCount($db, 'rating_challenges', 'rate_negative=? and rate_positive IS NULL and token_challenge=?', [1, $challange->token]); ?>
													</span>
												</a>
											</li>
										</ul>
									</div>
								</article>
							<?php endforeach; ?>
						<?php endif;?>

					</div>
				</section>

			</div>
		</div>
	</div>
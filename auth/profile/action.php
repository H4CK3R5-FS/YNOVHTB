<?php

/**
 * @Author: B. Yacine
 * @Date:   2022-05-04 03:16:43
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 15:00:47
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

if(!empty($_GET) && !empty($_GET['page'])):
	switch (htmlspecialchars($_GET['page'])) {
		case 'vote':
			try {
				if(!$req->isIndexHere($db, 'rating_challenges', 'token_user=? and token_challenge=?', [$auth->user()->token, htmlspecialchars($_GET['token'])])):

					if (htmlspecialchars($_GET['answer']) == 'yes'):

						$attributes = "rate_positive=?, token_user=?, token_challenge=?, token=?";
						$value = [1, $auth->user()->token, htmlspecialchars($_GET['token']), Str::random(20)];
						$req->addIndex($db, 'rating_challenges', $attributes, $value);

					else:

						$attributes = "rate_negative=?, token_user=?, token_challenge=?, token=?";
						$value = [1, $auth->user()->token, htmlspecialchars($_GET['token']), Str::random(20)];
						$req->addIndex($db, 'rating_challenges', $attributes, $value);

					endif;

				endif;
			} catch (Exception $e) {
				App::redirect('vote.php');				
			}
			break;
		case 'activities':
			if(!$req->isIndexHere($db, 'user_challenge', 'token_user=? and token_challenge=?', [$auth->user()->token, htmlspecialchars($_GET['token'])])):
				$req->addIndex($db, 'user_challenge', 'token_user=?, token_challenge=?, token=?, modifed_at=NOW()', 
						[$auth->user()->token, htmlspecialchars($_GET['token']), Str::random(20)]
				);
			endif;
			App::redirect($req->getThis($db, 'challenge', 'token=?', [htmlspecialchars($_GET['token'])], 'path')->path);
			break;
	}
endif;

App::redirect(htmlspecialchars($_GET['page']).'.php');
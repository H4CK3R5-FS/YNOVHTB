<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 12:03:33
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

$active_act = true;

$startedchallenges = $db->query('SELECT * FROM challenge WHERE token=(SELECT token_challenge FROM user_challenge WHERE token_user=?)', [$auth->user()->token])->fetchAll();
$allchallenges = $req->getAllIndex($db, 'challenge', 'Status=?', ['Confirmed'], $getValue='*');

require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';

?>




<?php require_once 'inc/components/footer.php'; ?>
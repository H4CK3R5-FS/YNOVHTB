<?php

/**
 * @Author: root
 * @Date:   2021-11-10 10:52:45
 * @Last Modified by:   root
 * @Last Modified time: 2022-04-06 00:11:54
 */

	require_once 'inc/bootstrap.php';
	
	$db = App::getDatabase();
	
	if(App::getAuth()->confirm($db, $_GET['id'], $_GET['token'], Session::getInstance())){
	    Session::getInstance()->setFlash('success', "Votre compte à bien été validé");
	    App::redirect('profile/');
	}else{
	    Session::getInstance()->setFlash('danger', "Ce token n'est plus valide");
	    App::redirect('index.php');
	}
	
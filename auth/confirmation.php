<?php

/**
 * @Author: root
 * @Date:   2021-11-10 10:52:45
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2022-03-31 23:19:50
 */

	require_once 'inc/bootstrap.php';
	$db = App::getDatabase();
	
	if(App::getAuth()->confirm($db, $_GET['id'], $_GET['token'], Session::getInstance())):
	    Session::getInstance()->setFlash('success', "Your account has been activated");
	    App::redirect('profile/');
	else:
	    Session::getInstance()->setFlash('danger', "This token no longer availible !");
	    App::redirect('index.php');
	endif;
	
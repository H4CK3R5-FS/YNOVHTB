<?php

/**
 * @Author: root
 * @Date:   2021-11-10 15:38:21
 * @Last Modified by:   root
 * @Last Modified time: 2021-11-10 15:46:08
 */

require_once "../inc/bootstrap_auth.php";
require_once '../inc/components/header.php';

$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if($auth->user()): App::redirect('../profil/account.php'); endif;

if(!empty($_GET) && !empty($_GET['id']) && !empty($_GET['token'])){
	$user = $auth->checkResetToken($db, $_GET['id'], $_GET['token']);
	if($user){

		if(!empty($_POST) && !empty($_POST['password'])):
			$validator->isConfirmed('password',"Vos mots de passes ne correspondent pas !");
			
			if($validator->isValid()):
				$db->query('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?', 
					[$auth->hashPassword($_POST['password']), $_GET['id']]);
				$auth->connect($user);
				Session::getInstance()->setFlash('success','Votre mot de passe à bien été modifié');
				App::redirect('../profil/account.php');
			else:
				$errors = $validator->getErrors();
			endif;
		endif;
	else:
		Session::getInstance()->setFlash('danger',"Ce token n'est pas valide");
		App::redirect('../index.php');
	endif;
else:
	App::redirect('../index.php');
endif;

?>
	<div class="container">
		<div class="forms">
			<form methode="POST">
			
				<h1>Reset Password</h1>

				<?php require '../inc/components/head.php'; ?>
                <?php if(!empty($errors)): ?>
                <div class="alert alert-danger">
                    <p>Incorrectly completed form</p>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
				
				<div class="form-group">
					<label for="password">New password</label>
					<input id="password" type="text" name="password" placeholder="Password" required>
				</div>

				<div class="form-group">
					<label for="confirm">confirm your new password</label>
					<input id="confirm" type="text" name="password_confirm" placeholder="Confirm your password" required>
				</div>
            
                <div class="form-group">
					<button type="button">Envoyé </button>
				</div>

			</form>
		</div>
	</div>

<?php require_once '../inc/components/header.php'; ?>
<?php

/**
 * @Author: root
 * @Date:   2021-11-10 14:12:27
 * @Last Modified by:   root
 * @Last Modified time: 2021-11-10 15:46:14
 */

require_once "../inc/bootstrap_auth.php";
require '../inc/components/header.php';

$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if($auth->user()): App::redirect('../profil/account.php'); endif;

if(!empty($_POST) and !empty($_POST['email'])):
	$validator->isEmail('email', 'E-mail field not valid !');
	if($validator->isValid()):
		$auth->resetPassword($db, $_POST['login_mail']));
		Session::getInstance()->setFlash('success', 'An email has been sent to you.');
	else:
		$errors = $validator->getErrors();
	endif;
endif;

?>

	<div class="container">
		<div class="forms">
			<form methode="POST">
				<h1>Forgot your password</h1>

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
					<label for="mail">E-mail*</label>
					<input id="mail" type="email" name="email" placeholder="E-Mail" required>
				</div>

				<div class="form-group">
					<button type="submit">Send </button>
				</div>

			</form>
		</div>
	</div>


<?php require_once "../inc/components/footer.php"; ?>
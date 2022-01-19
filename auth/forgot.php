<?php

/**
 * @Author: root
 * @Date:   2021-11-10 14:12:27
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2022-01-19 09:46:52
 */

require_once "../inc/bootstrap_auth.php";
require '../inc/components/header.php';

$validator = new Validator($_POST);
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if($auth->user()): App::redirect('profil/account.php'); endif;

if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['reset'])):
	$validator->isEmail('email', "Invalid E-mail field !");
	if($validator->isValid()):
		$auth->resetPassword($db, strtolower(htmlspecialchars($_POST['email'])));
		Session::getInstance()->setFlash('success', 'An E-mail had been sent to you.');
	else:
		$errors = $validator->getErrors();
	endif;
endif;

?>

	<div class="container">
		<div class="forms">
			<form method="POST">
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
					<button type="submit" value="reset">Reset </button>
				</div>

			</form>
		</div>
	</div>


<?php require_once "../inc/components/footer.php"; ?>
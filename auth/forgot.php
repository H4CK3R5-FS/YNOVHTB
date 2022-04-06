<?php

/**
 * @Author: root
 * @Date:   2021-11-10 14:12:27
 * @Last Modified by:   root
 * @Last Modified time: 2022-04-06 00:52:09
 */

require_once 'inc/bootstrap.php';
require 'inc/components/header.php';


$validator = new Validator($_POST);
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);


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

<form class="login100-form validate-form" method="POST">
	<span class="login100-form-title p-b-49">Forgot</span>

	<?php require 'inc/components/head.php'; ?>
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

	<div class="wrap-input100 validate-input m-b-23" data-validate = "Email required">
		<span class="label-input100">Email</span>
		<input class="input100" type="text" name="email" placeholder="Enter your email">
		<span class="focus-input100" data-symbol="&#xf206;"></span>
	</div>

	<div class="container-login100-form-btn">
		<div class="wrap-login100-form-btn">
			<div class="login100-form-bgbtn"></div>
			<button class="login100-form-btn" type="submit"value="reset">Reset </button>
		</div>
	</div>

</form>

<?php require_once "inc/components/footer.php"; ?>
<?php

/**
 * @Author: root
 * @Date:   2021-11-10 14:12:27
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 11:07:39
 */

require_once 'inc/bootstrap.php';
require 'inc/components/header.php';


$validator = new Validator($_POST);
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

try { if(isset($auth->user()->token)): App::redirect('profile/'); endif; } catch (Exception $e) {}

if(!empty($_POST) && !empty($_POST['email'])):

	// var_dump($_POST);

	$validator->isEmail('email', "Invalid E-mail field !");
	if($validator->isValid()):
		if($auth->resetPassword($db, strtolower(htmlspecialchars($_POST['email'])))):
			Session::getInstance()->setFlash('success', 'An E-mail had been sent to you.');
		endif;
	else:
		$errors = $validator->getErrors();
	endif;
endif;

?>

<form class="login100-form validate-form" method="POST">
	<span class="login100-form-title p-b-49">Forgot</span>

	<?php require 'inc/components/head.php'; ?>

	<div class="wrap-input100 validate-input m-b-23" data-validate = "Email required">
		<span class="label-input100">Email</span>
		<input class="input100" type="text" name="email" placeholder="Enter your email">
		<span class="focus-input100" data-symbol="&#xf206;"></span>
	</div>

	<div class="container-login100-form-btn">
		<div class="wrap-login100-form-btn">
			<div class="login100-form-bgbtn"></div>
			<button class="login100-form-btn" type="submit">Reset</button>
		</div>
		<div class="text-center p-t-8 p-b-31">
			<a href="index.php">Go to login</a>
		</div>
	</div>

</form>

<?php require_once "inc/components/footer.php"; ?>
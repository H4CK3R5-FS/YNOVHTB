<?php

/**
 * @Author: root
 * @Date:   2021-10-20 14:50:07
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 10:51:23
 */

require_once 'inc/bootstrap.php';
require_once "inc/components/header.php";

$errors = [];

$validator = new Validator($_POST);
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

try { if(isset($auth->user()->token)): App::redirect('profile/'); endif; } catch (Exception $e) {}

if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['pass'])):

	$validator->isAlpha('pseudo', "invalid pseudo field !");
	if($validator->isValid()){$validator->isUniq("pseudo", $db, "users", "Pseudo already in use !", true);}

	$validator->isEmail('email', "invalid email field !");
	if($validator->isValid()){$validator->isUniq("email", $db, "users", "Email already in use !", true);}

	$validator->isConfirmed("pass", "invalid password !");

	if($validator->isValid()):
		$auth->register($db, strtolower(htmlspecialchars($_POST['pseudo'])), 
			strtolower(htmlspecialchars($_POST['email'])), htmlspecialchars($_POST['pass']));
		Session::getInstance()->setFlash('success', 'Registration completed successfully');
		App::redirect('index.php');
	else:
		$errors = $validator->getErrors();
	endif;
endif;

?>

<form class="login100-form validate-form" method="POST">
	<span class="login100-form-title p-b-49">Register</span>

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

	<div class="wrap-input100 validate-input m-b-23" data-validate = "Pseudo required">
		<span class="label-input100">Pseudo</span>
		<input class="input100" type="text" name="pseudo" required placeholder="Enter your Pseudo">
		<span class="focus-input100" data-symbol="&#xf206;"></span>
	</div>

	<div class="wrap-input100 validate-input m-b-23" data-validate = "Mail required">
		<span class="label-input100">Mail</span>
		<input class="input100" type="email" name="email" required placeholder="Enter your Email">
		<span class="focus-input100" data-symbol="&#xf206;"></span>
	</div>

	<div class="wrap-input100 validate-input" data-validate="Password is required">
		<span class="label-input100">Password</span>
		<input class="input100" type="password" name="pass" required placeholder="Enter your password">
		<span class="focus-input100" data-symbol="&#xf190;"></span>
	</div>

	<div class="wrap-input100 validate-input" data-validate="Password's confirmation is required">
		<span class="label-input100">Confirm your password</span>
		<input class="input100" type="password" name="pass_confirm" required placeholder="Confirm your password">
		<span class="focus-input100" data-symbol="&#xf190;"></span>
	</div>

	<div class="form-group my-4">
		<input type="checkbox" id="cgu" name="cgu" value="cgu" required>
		<label for="cgu">Conditions & terms</label>
	</div>

	<div class="container-login100-form-btn">
		<div class="wrap-login100-form-btn">
			<div class="login100-form-bgbtn"></div>
			<button class="login100-form-btn" type="submit">Register</button>
		</div>
	</div>

	<div class="text-right p-t-8 p-b-31">
		<a href="../auth/">I already have an account.</a>
	</div>

</form>

<?php require_once 'inc/components/footer.php'; ?>
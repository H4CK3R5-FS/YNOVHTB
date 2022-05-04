<?php

/**
 * @Author: root
 * @Date:   2021-10-20 14:50:07
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 10:50:23
 */

require_once 'inc/bootstrap.php';
require_once "inc/components/header.php";

$validator = new Validator($_POST);
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

$errors = array();

try { if(isset($auth->user()->token)): App::redirect('profile/'); endif; } catch (Exception $e) {}
if(!empty($_POST) && !empty($_POST['pseudoMail']) && !empty($_POST['pass'])):
	$validator->isEmail('pseudoMail', "Votre E-mail n'est pas valid !");
if($validator->isValid()):
	$session = Session::getInstance();
	if($auth->login($db, strtolower($_POST['pseudoMail']), htmlspecialchars($_POST['pass']), isset($_POST['remember']))):
		App::redirect('profile/');
else:
	$session->setFlash('danger', 'Identifiant ou mot de passe incorrecte');
endif;
else: 
	$errors = $validator->getErrors();
endif;
endif;

?>

<form class="login100-form validate-form" method="POST">
	<span class="login100-form-title p-b-49">Login</span>

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
		<input class="input100" type="text" name="pseudoMail" placeholder="Enter your email">
		<span class="focus-input100" data-symbol="&#xf206;"></span>
	</div>

	<div class="wrap-input100 validate-input" data-validate="Password is required">
		<span class="label-input100">Password</span>
		<input class="input100" type="password" name="pass" placeholder="Enter your password">
		<span class="focus-input100" data-symbol="&#xf190;"></span>
	</div>

	<div class="text-right p-t-8 p-b-31">
		<a href="forgot.php">Forgot password?</a>
	</div>

	<div class="form-group">
		<input type="checkbox" id="remember" name="remember" value="remember">
		<label for="remeber">Remember Me</label>
	</div>

	<div class="container-login100-form-btn">
		<div class="wrap-login100-form-btn">
			<div class="login100-form-bgbtn"></div>
			<button class="login100-form-btn" type="submit">Login</button>
		</div>
	</div>

	<div class="text-center p-t-8 p-b-31">
		<a href="register.php">I don't have an account.</a>
	</div>

</form>

<?php require_once "inc/components/footer.php"; ?>
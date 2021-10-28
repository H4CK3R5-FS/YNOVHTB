<?php

/**
 * @Author: root
 * @Date:   2021-10-20 14:50:07
 * @Last Modified by:   root
 * @Last Modified time: 2021-10-28 23:44:16
 */

	require_once "../inc/bootstrap_auth.php";

	$errors = [];

	$validator = new Validator($_POST);
    $auth = App::getAuth();
    $db = App::getDatabase();
    $auth->connectFromCookie($db);
	
    if($auth->user()): App::redirect('index.php'); endif;

    if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['pass'])):

        $validator->isAlpha('pseudo', "invalid pseudo field !");
    	if($validator->isValid()){$validator->isUniq("pseudo", $db, "users", "Pseudo already in use !", true);}

        $validator->isEmail('email', "invalid email field !");
        if($validator->isValid()){$validator->isUniq("email", $db, "users", "Email already in use !", true);}

        $validator->isConfirmed("pass", "invalid password !");

        if($validator->isValid()):
            $auth->register($db, strtolower($_POST['pseudo']), strtolower($_POST['email']), htmlspecialchars($_POST['pass']));
            App::redirect('index.php');
        else:
         	$errors = $validator->getErrors();
        endif;
    endif;

	require_once "../inc/components/header.php";
?>
	
	<div class="container">
		<div class="forms">

			<form method="POST">

				<h1>Regsiter Y-HTB</h1>
				
				<div class="form-group">
					<label for="pseudo">Pseudo</label>
					<input id="pseudo" type="text" name="pseudo" placeholder="*Pseudo"/>
				</div>

				<div class="form-group">
					<label for="pseudo">Mail</label>
					<input id="Mail" type="text" name="mail" placeholder="*E-Mail"/>
				</div>

				<div class="form-group">
					<label for="pseudo">password</label>
					<input id="password" type="password" name="pass" placeholder="*Password"/>
				</div>

				<div class="form-group">
					<label for="pseudo">confirm your password</label>
					<input id="confirm your password" type="password" name="pass_confirm" placeholder="*Confirm your password"/>
				</div>

				<div class="form-group">
					<button type="submit">Register Now</button>
				</div>
				
				<div class="form-group">
					<a href="../auth/">I already have an account.</a>
				</div>
				
			</form>

		</div>
	</div>

<?php require_once '../inc/components/footer.php'; ?>
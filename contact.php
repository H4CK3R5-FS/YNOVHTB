<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2021-11-24 13:59:56
 */

    require_once "inc/bootstrap.php";
    require_once "inc/components/header.php";

    $errors = [];

	$validator = new Validator($_POST);
    $auth = App::getAuth();
    $req = App::getAuthRequest();
    $db = App::getDatabase();
    $auth->connectFromCookie($db);

    if($_POST && !empty($_POST['email']) && !empty($_POST['object']) and !empty($_POST['message'])):
		
		$validator->isEmail('email', 'Invalid Email !');
		$validator->isAlpha('object', 'Invalid Object');
		$validator->isSized('object', 1, 250);
		$validator->isSized('message', 1, 500);

		if($validator->isValid()):
			if(!$req->isIndexHere($db, 'contact', 'email=? and object=? and message=?', 
				[
					htmlspecialchars($_POST['email']), 
					htmlspecialchars($_POST['object']), 
					htmlspecialchars($_POST['message'])
				])):

				$req->addIndex($db, 'contact', 'email=?, object=?, message=?, dateSend=NOW()', 
				[
					htmlspecialchars($_POST['email']), 
					htmlspecialchars($_POST['object']), 
					htmlspecialchars($_POST['message'])
				]);
			endif;
			Session::getInstance()->setFlash("success", 'Your ask was sent successfully');
			App::redirect("contact.php");
		endif;
	endif;

?>

	<div class="container">
		<div class="forms">
			<form method="POST">
				<h1>Contact</h1>
				<div class="form-group">
					<label for="mail">Mail</label>
					<input id="mail" type="text" name="email" placeholder="*E-Mail"/>
				</div>

				<div class="form-group">
					<label for="object">object</label>
					<input id="object" type="text" name="object" placeholder="Object"/>
				</div>

				<div class="form-group">
					<label for="message">message </label>
                    <textarea style="resize: none;" rows="6" id="message" type="text" name="message" placeholder="Your message"></textarea>
				</div>

				<div class="form-group">
					<button type="submit">Envoyé</button>
				</div>

			</form>
		</div>
	</div>

<?php require_once "inc/components/header.php"; ?>
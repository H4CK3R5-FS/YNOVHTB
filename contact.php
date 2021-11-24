<?php
require_once "../inc/bootstrap_auth.php";
require '../inc/components/header.php';

$validator = new Validator($_POST);
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db); 

if (!empty($_POST['email']) and !empty($_POST['object'] and !empty($_POST['message'])));
$validator->isEmail('email', 'E-mail field not valid !');
$validator->isAlpha('object', 'Object field not valid !');

if($validator->isValid()):


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
					<input id="Object" type="text" name="object" placeholder="object"/>
				</div>

				<div class="form-group">
					<label for="message">message </label>
                    <textarea style="resize: none;" rows="6" id="message" type="text" name="message" placeholder="your message"></textarea>
				</div>

				<div class="form-group">
					<button type="submit">Envoyé</button>
				</div>

			</form>
		</div>
	</div>
<?php

/**
 * @Author: root
 * @Date:   2021-10-20 14:50:07
 * @Last Modified by:   root
 * @Last Modified time: 2021-10-20 15:55:36
 */

	require_once '../inc/bootstrap.php';
	require_once '../inc/header.php';
?>
	
	<div class="container">
		<div class="forms">
			<form methode="POST">
				<h1>Regsiter</h1>
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
					<input id="password" type="text" name="password" placeholder="*Password"/>
				</div>

				<div class="form-group">
					<label for="pseudo">confirm your password</label>
					<input id="confirm your password" type="text" name="password_confirm" placeholder="*Confirm your password"/>
				</div>

				<div class="form-group">
					<button type="button">Register Now</button>
				</div>
				
				<div class="form-group">
					<a href="auth/">I already have an account.</a>
				</div>

			</form>
		</div>
	</div>

<?php require_once '../inc/footer.php'; ?>
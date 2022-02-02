<?php

/**
 * @Author: root
 * @Date:   2021-10-20 14:50:07
 * @Last Modified by:   root
 * @Last Modified time: 2021-11-10 15:56:43
 */

    require_once "../inc/bootstrap_auth.php";
    require_once "../inc/components/header.php";

    $errors = array();

    $validator = new Validator($_POST);
    $auth = App::getAuth();
    $db = App::getDatabase();
    $auth->connectFromCookie($db);
    
    if($auth->user()): App::redirect('../profil/account.php'); endif;

    if(!empty($_POST) && !empty($_POST['pseudoMail']) && !empty($_POST['pass'])):

        $validator->isAlphaOrEmail('pseudoMail', "invalid pseudo or Email field !");

        if($validator->isValid()):
            
            if($auth->login(
                $db, 
                strtolower(htmlspecialchars($_POST['pseudoMail'])), 
                htmlspecialchars($_POST['pass']), 
                htmlspecialchars($validator->checked('remember', 'remember')))):

                App::redirect('../profil/account.php');
            else: 
                Session::getInstance()->setFlash('danger', 'Identifiant ou mot de passe incorrecte'); 
            endif;

         else: $errors = $validator->getErrors(); endif;

    endif;

?>

    <div class="container">
        <div class="forms">

            <form method="POST">
                <h1>Login</h1>

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
                    <label for="pseudoMail">E-mail</label>
                    <input id="pseudoMail" type="text" name="pseudoMail" placeholder="E-mail or Pseudo" >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="pass" placeholder="Password" >
                </div>

                <div class="form-group">
                    <a href="forgot.php">I forgot my password.</a>
                </div>

                <div class="form-group">
                    <label for="remeber">Se Souvenir de moi</label>
                    <input type="checkbox" id="remember" name="remember" value="remember">
                </div>

                <div class="form-group">
                    <button type="submit">Login</button>
                </div>

                <div class="form-group">
                    <a href="register.php">I don't have an account.</a>
                </div>
               
            </form>
            
        </div>
    </div>


<?php require_once "../inc/components/footer.php"; ?>
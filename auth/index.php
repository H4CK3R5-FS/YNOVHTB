<?php

/**
 * @Author: root
 * @Date:   2021-10-20 14:50:07
 * @Last Modified by:   root
 * @Last Modified time: 2021-10-28 23:51:56
 */

    require_once "../inc/bootstrap_auth.php";

    $validator = new Validator($_POST);
    $auth = App::getAuth();
    $db = App::getDatabase();
    $auth->connectFromCookie($db);
    
    $errors = array();

    if($auth->user()): App::redirect('index.php'); endif;

    if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['pass'])):

        $validator->isAlpha('pseudo', "invalid pseudo field !");

        if($validator->isValid()):

            if($auth->login($db, strtolower(htmlspecialchars($_POST['pseudo'])), htmlspecialchars($_POST['pass']))):

                App::redirect('index.php');

            else:

                $session = Session::getInstance();
                $session->setFlash('danger', 'Identifiant ou mot de passe incorrecte');

            endif;
        else:
            $errors = $validator->getErrors();
        endif;
    endif;

    require_once "../inc/components/header.php";
?>

    <div class="container">
        <div class="forms">

            <form method="POST">
                <h1>Login</h1>

                <div class="form-group">
                    <label for="mail">E-mail</label>
                    <input id="mail" type="email" name="mail" placeholder="E-mail or Pseudo" >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="pass" placeholder="Password" >
                </div>

               <div class="form-group">
                   <button type="submit">Login</button>
               </div>

               <div class="form-group">
                   <a href="inscription.php">I don't have an account.</a>
               </div>
               
            </form>
            
        </div>
    </div>


<?php require_once "../inc/components/footer.php"; ?>
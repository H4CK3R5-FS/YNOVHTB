<?php

/**
 * @Author: root
 * @Date:   2021-11-10 15:38:21
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 10:51:28
 */

require_once 'inc/bootstrap.php';
require_once 'inc/components/header.php';


$auth = App::getAuth();
$db = App::getDatabase();
$validator = new Validator($_POST);

try { if(isset($auth->user()->token)): App::redirect('profile/'); endif; } catch (Exception $e) {}

if(!empty($_GET) && !empty($_GET['id']) && !empty($_GET['token'])){
    $user = $auth->checkResetToken($db, $_GET['id'], $_GET['token']);
    if($user){
        if(!empty($_POST) && !empty($_POST['password'])){
            $validator->isConfirmed('password',"Vos mots de passes ne correspondent pas !");
            if($validator->isValid()){
                $db->query('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?', [$auth->hashPassword($_POST['password']), $_GET['id']]);
                $auth->connect($user);
                Session::getInstance()->setFlash('success','Votre mot de passe à bien été modifié');
                App::redirect('profile/');
            }else{
                $errors = $validator->getErrors();
            }
        }
    }else{
        Session::getInstance()->setFlash('danger',"Ce token n'est pas valide");
        App::redirect('index.php');
    }
}else{
    App::redirect('index.php');
}

?>

<form class="login100-form validate-form" method="POST">
    <span class="login100-form-title p-b-49">Reset</span>

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

    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <span class="label-input100">Password</span>
        <input class="input100" type="password" name="password" required placeholder="Enter your password">
        <span class="focus-input100" data-symbol="&#xf190;"></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Password's confirmation is required">
        <span class="label-input100">Confirm your password</span>
        <input class="input100" type="password" name="password_confirm" required placeholder="Confirm your password">
        <span class="focus-input100" data-symbol="&#xf190;"></span>
    </div>

    <div class="container-login100-form-btn">
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn" type="submit">Envoyé </button>
        </div>
    </div>
</form>
</div>
</div>

<?php require_once 'inc/components/header.php'; ?>
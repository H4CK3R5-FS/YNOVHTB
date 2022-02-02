<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2021-11-10 16:51:48
 */

    require_once "inc/bootstrap.php";
    require_once "inc/components/header.php";

?>

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

   <a href="auth/">Connexion</a>
   <a href="auth/register.php">Inscrption</a>


<?php require_once "inc/components/footer.php"; ?>
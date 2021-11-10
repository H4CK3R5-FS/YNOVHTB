<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   root
 * @Last Modified time: 2021-11-10 13:46:02
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
   <a href="auth/inscription.php">Inscrption</a>


<?php require_once "inc/components/footer.php"; ?>
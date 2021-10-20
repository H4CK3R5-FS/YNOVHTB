<?php

/**
 * @Author: root
 * @Date:   2021-10-20 14:50:07
 * @Last Modified by:   root
 * @Last Modified time: 2021-10-20 16:37:54
 */
    require_once "../inc/bootstrap.php";
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
                    <input type="password" name="password" placeholder="Password" >
                </div>

               <div class="form-group">
                   <button type="button">Login</button>
               </div>

               <div class="form-group">
                   <a href="inscription.php">I don't have an account.</a>
               </div>
               
            </form>
        </div>
    </div>


<?php require_once "../inc/components/footer.php"; ?>
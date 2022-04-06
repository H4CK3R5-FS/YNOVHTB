<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-04-06 02:15:32
 */

require_once "inc/bootstrap.php";

$errors = array();

$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if(!($auth->user())){
  $session = Session::getInstance();
  $session->setFlash('danger', 'Vous devez être connecter avant de continuer !');
  App::redirect('../index.php');
}

$active_lessons = true;
require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';


?>

<link rel="stylesheet" href="assets/css/cards-style.css"/>
<div class="main-panel">
   <div class="content">
      <div class="page-inner">
         <div class="mb-4">
            <span class="text-white h1">Started Lessons</span>
         </div>
         <!--  -->
         <div class="row">
         <div class="col-md-4">
               <div class="card p-3 mb-2">
                <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
               <div class="mt-5">
                  <div class="progress">
                     <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  
               </div>
            </div>
         </div>

            <div class="col-md-4">
               <div class="card p-3 mb-2">
                <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
               <div class="mt-5">
                  <div class="progress">
                     <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>

               </div>
            </div>
         </div>

         <div class="col-md-4">
               <div class="card p-3 mb-2">
                <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
               <div class="mt-5">
                  <div class="progress">
                     <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  
               </div>
            </div>
         </div>   

      </div>

      <div class="my-4">
         <span class="text-white h1">All Lessons</span>
      </div>

      <div class="row">

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-12"><hr></div>

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-12"><hr></div>  

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-4">
            <div class="card p-3 mb-2">
               <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Software Architect <br>Java - USA</h3>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-12"><hr></div>
      </div>


      <!--  -->
   </div>
</div>
</div>


<?php require_once 'inc/components/footer.php'; ?>
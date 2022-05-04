<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   BOUFALA Yacine
 * @Last Modified time: 2022-05-03 19:25:12
 */

require_once "inc/bootstrap.php";

$errors = array();

$req = new Request();
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if(!($auth->user())){
	$session = Session::getInstance();
	$session->setFlash('danger', 'Vous devez être connecter avant de continuer !');
	App::redirect('../index.php');
}

$active_act = true;
require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';

?>

<div class="main-panel">
   <div class="content">
      <div class="page-inner">
         <div class="mb-4">
            <span class="text-white h1">Started Challenges</span>
         </div>
         <!--  -->
         <div class="row">
            <div class="col-md-4">
               <div class="card p-3 mb-2">
                 <div class="d-flex justify-content-between">
                  <div class="d-flex flex-row align-items-center">
                     <h3 class="heading">Craking <br>Difficulty - Hard</h3>
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
                  <h3 class="heading">Web Client <br>Difficulty - Easy</h3>
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
               <h3 class="heading">Reverse engineering <br>Difficulty - Medium</h3>
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
   <span class="text-white h1">All Challenges</span>
</div>

<div class="row">

   <div class="col-md-4">
      <div class="card p-3 mb-2">
         <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
               <h3 class="heading">Craking <br>67 Challenges</h3>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-4">
      <div class="card p-3 mb-2">
         <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
               <h3 class="heading">Web Client <br>97 Challenges</h3>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-4">
      <div class="card p-3 mb-2">
         <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
               <h3 class="heading">Reverse engineering <br>10 Challenges</h3>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-12"><hr></div>

   <div class="col-md-4">
      <div class="card p-3 mb-2">
         <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
               <h3 class="heading">Network <br>45 Challenges</h3>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-4">
      <div class="card p-3 mb-2">
         <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
               <h3 class="heading">Forensic <br>+99 Challenges</h3>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-4">
      <div class="card p-3 mb-2">
         <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
               <h3 class="heading">Programming <br>+99 Challenges</h3>
            </div>
         </div>
      </div>
   </div>
</div>



<!--  -->
</div>
</div>
</div>


<?php require_once 'inc/components/footer.php'; ?>
<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 16:10:22
 */

require_once "inc/bootstrap.php";

$errors = array();

$validator = new Validator($_POST);

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


if($_POST):
   $validator->isAlpha('c_flag', 'Invalid flag');
   if($validator->isValid()):
      try {
         if($req->isIndexHere($db, 'challenge', 'token=? and c_flag=?', [htmlspecialchars($_POST['token']), htmlspecialchars($_POST['c_flag'])])):
            $req->deleteIndex($db, 'user_challenge', 'token_user=? and token_challenge=?', [$auth->user()->token, htmlspecialchars($_POST['token'])]);
      endif;
   } catch (Exception $e) {}
else:
   $errors = $validator->getErrors();
endif;
endif;

$startedchallenges = $db->query('SELECT * FROM challenge WHERE token in (SELECT token_challenge FROM user_challenge WHERE token_user=?)', [$auth->user()->token])->fetchAll();
$allchallenges = $req->getAllIndex($db, 'challenge', 'Status=?', ['Confirmed'], $getValue='*');

require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';

?>

<style type="text/css">
   .col-md-4:hover {
      transform: scale(0.98);
      box-shadow: 0 0 5px -2px rgba(0,0,0,0.3);
      background-size:130%;
      transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
   }
   .col-md-4 > *,
   .col-md-4:hover > *{
      text-decoration: none;
      color: #fff;
   }
</style>

<div class="main-panel">
   <div class="content">
      <div class="page-inner">
         <div class="mb-4">
            <span class="text-white h1">Started Challenges</span>
         </div>
         <!--  -->
         <div class="row">
            <?php if($startedchallenges): ?>
               <?php foreach($startedchallenges as $challange): ?>
                  <div class="col-md-4" data-toggle="modal" data-target="#checkFlag<?= $challange->id; ?>">
                     <div class="card p-3 mb-2">
                        <div class="d-flex justify-content-between">
                           <div class="d-flex flex-row align-items-center">
                              <h3 class="heading"><?= $challange->c_name; ?></h3>
                           </div>
                        </div>
                        <div class="mt-5">
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" style="" id="checkFlag<?= $challange->id; ?>" tabindex="-1" role="dialog" aria-labelledby="checkFlagModel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color: #1a2035; opacity: 0.8;">
                           <div class="modal-header">
                              <h5 class="modal-title h2 text-white" id="checkFlagModel">Check Flag</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>

                           <form method="POST">
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="challenge_name">Enter The Flag</label>
                                          <input type="text" class="form-control" name="c_flag" id="challenge_flag" placeholder="Flag" required>
                                          <input type="hidden" name="token" value="<?= $challange->token; ?>">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" name="add-challenge" class="btn text-white py-2 px-4" style="background: #5867dd;">
                                    <span class="h3 text-white">Check</span>
                                 </button>
                                 <button type="button" class="btn btn-danger py-2 px-4" data-dismiss="modal">
                                    <span class="h3 text-white">Close</span>
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               <?php endforeach; ?>
            <?php else: ?>
               <div class="col-md-12" style="text-align: center;">
                  <span class="h3 text-white">No current challenge</span>
               </div>
            <?php endif; ?>
         </div>

         <hr>

         <div class="my-4">
            <span class="text-white h1">All Challenges</span>
         </div>

         <div class="row">

            <?php if($allchallenges): ?>
               <?php foreach($allchallenges as $challange): ?>
                  <div class="col-md-4">
                     <a href="<?= 'challenge-view.php?token='.$challange->token; ?>">
                        <div class="card p-3 mb-2">
                           <div class="d-flex justify-content-between">
                              <div class="d-flex flex-row align-items-center">
                                 <h3 class="heading p-3"><?= $challange->c_name; ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endforeach; ?>
               <?php else: ?>
                  <div class="col-md-12" style="text-align: center;">
                     <span class="h3 text-white">No current challenge</span>
                  </div>
               <?php endif; ?>

            </div>

            <!--  -->
         </div>
      </div>
   </div>

   <?php require_once 'inc/components/footer.php'; ?>

<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 13:06:32
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

$active_forum = true;
require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';


?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">

            <div class="card text-left">
				<div class="card-body">
					<h5 class="card-title">Lorem ipsum dolor sit</h5>
					<div class="row">
						<div class="col-md-10">
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ut, itaque at obcaecati, dignissimos hic doloremque illo dolore exercitationem corporis sapiente. Sed nisi quas, necessitatibus laborum quisquam? Architecto, sunt, assumenda.</p>
						</div>
					</div>
				</div>
				<div class="card-footer text-muted">
					10 days ago
				</div>
			</div>

              <!-- text area -->
                <section class="show-answers">
                    <form class="form-group" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Answer : </label>
                            <textarea name="answer" class="form-control"></textarea>
                            <br>
                            <button type="submit" class="btn btn-outline-success">Publish an Answer</button>
                        </div>
                    </form>

                    <hr>

                    <div class="card">
                        <div class="card-header">
                            <a>User 1</a>
                        </div>
                        <div class="card-body">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam recusandae deleniti, dicta natus, dignissimos ex quidem quam provident, inventore explicabo velit officiis. Repudiandae fugit tempore eaque pariatur, illum quia rem!
                        </div>
                    </div>
                    
                    <br>

                    <div class="card">
                        <div class="card-header">
                            <a>User 2</a>
                        </div>
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae error ad, nihil? Eos illo libero dolore veniam obcaecati vel placeat a quas nulla. Sint doloremque enim veritatis, similique accusamus sequi.
                        </div>
                    </div>
                    <br>
                </section>
        </div>
    </div>
</div>

<?php require_once 'inc/components/footer.php'; ?>

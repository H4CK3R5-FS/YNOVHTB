<?php

/**
 * @Author: root
 * @Date:   2022-04-06 00:59:39
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 04:50:47
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

$active_dash = true;
$top_ranking = $req->getAllIndexOrderby($db, 'token_user, exp', 'user_progression', 'ORDER BY exp DESC', 'limit 5');

require_once 'inc/components/header.php';
require_once 'inc/components/nav_bar.php';
require_once 'inc/components/side_bar.php';

?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<?php if(Session::getInstance()->hasFlashes()): ?>
			<div class="mt-2 mb-4">
				<h2 class="text-white pb-2">Welcome back, <?= $auth->user()->pseudo; ?> !</h2>
				<h5 class="text-white op-7 mb-4">
					<span class="text-white">
						Yesterday I was clever, so I wanted to change the world. Today I am wise, so I am changing myself.
					</span>
				</h5>
			</div>
		<?php endif; ?>

		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-body pb-0">
								<div class="h1 fw-bold float-right text-primary">+5%</div>
								<h2 class="mb-2">17</h2>
								<p class="text-muted">Activities</p>
								<div class="pull-in sparkline-fix">
									<div id="lineChart"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-body pb-0">
								<div class="h1 fw-bold float-right text-danger">-3%</div>
								<h2 class="mb-2">27</h2>
								<p class="text-muted">Lessons</p>
								<div class="pull-in sparkline-fix">
									<div id="lineChart2"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-head-row">
									<div class="card-title">
										<span class="text-white"><span class="mr-2"><i class="fas fa-chart-line"></i></span>User Statistics</span>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="chart-container" style="min-height: 440px">
									<canvas id="statisticsChart"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary bg-primary-gradient" style="height: 160px;">
							<div class="card-body">
								<h4 class="mb-1 fw-bold">Progression</h4>
								<div style="text-align: center;margin-top: 1.8rem !important;">
									<span class="text-white h1">
										Lvl <?= $level. " ~> Lvl " .($level+1); ?>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- --------- -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">
									<span class="text-white"><span class="mr-2"><i class="fas fa-crown"></i></span>Top Ranking</span>
								</div>
							</div>	
							<div class="card-body pb-0">
								<?php if($top_ranking != null): ?>
									<?php foreach($top_ranking as $top): ?>
										<div class="d-flex">
											<div class="avatar">
												<img src="assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
											</div>
											<div class="flex-1 pt-3 ml-2">
												<h6 class="fw-bold mb-1"><?= ucfirst($req->getThis($db, 'users', 'token=?', [$top->token_user], 'pseudo')->pseudo); ?></h6>
											</div>
											<div class="d-flex ml-auto align-items-center">
												<h3 class="text-info fw-bold"><?= floor($req->getLevel($top->exp)); ?></h3>

											</div>
										</div>
										<div class="separator-dashed"></div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="card-head-row">
							<div class="card-title">
								<span class="text-white"><span class="mr-2"><i class="fas fa-history"></i></span>Your Activities</span>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="d-flex">
							<div class="avatar avatar-online">
								<span class="avatar-title rounded-circle border border-white bg-danger">R</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">craking Room <span class="text-warning pl-3">soon finished</span></h6>
								<span class="text-muted">Current Leader KingLucifer !</span>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-online">
								<span class="avatar-title rounded-circle border border-white bg-secondary">F</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">How to hack the nasa ?  <span class="text-success pl-3">open</span></h6>
								<span class="text-muted">Last message - now </span>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-away">
								<span class="avatar-title rounded-circle border border-white bg-danger">R</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">Programming Room <span class="text-muted pl-3">closed</span></h6>
								<span class="text-muted">Winner brc_du_bk !</span>
							</div>
						</div>

						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-away">
								<span class="avatar-title rounded-circle border border-white bg-secondary">F</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">How to make a reverse shell ?<span class="text-success pl-3">open</span></h6>
								<span class="text-muted">Last message - 1 hour ago</span>
							</div>
						</div>
						<div class="separator-dashed"></div>
						<div class="d-flex">
							<div class="avatar avatar-offline">
								<span class="avatar-title rounded-circle border border-white bg-warning">A</span>
							</div>
							<div class="flex-1 ml-3 pt-1">
								<h6 class="text-uppercase fw-bold mb-1">admin <span class="text-muted pl-3">closed</span></h6>
								<span class="text-muted">New challenges coming in 2 days !</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Feed Activity</div>
					</div>
					<div class="card-body">
						<ol class="activity-feed">
							<li class="feed-item feed-item-secondary">
								<time class="date" datetime="9-25">Sep 25</time>
								<span class="text">New Reward <a href="#">"Script kiddie"</a></span>
							</li>
							<li class="feed-item feed-item-success">
								<time class="date" datetime="9-24">Sep 24</time>
								<span class="text">New lesson started <a href="#">"Linux: The Basics"</a></span>
							</li>
							<li class="feed-item feed-item-info">
								<time class="date" datetime="9-23">Sep 23</time>
								<span class="text">Joined the group <a href="single-group.php">"Fsociety"</a></span>
							</li>
							<li class="feed-item feed-item-warning">
								<time class="date" datetime="9-21">Sep 21</time>
								<span class="text">Challenges completed <a href="#">"Bulldog"</a></span>
							</li>
							<li class="feed-item feed-item-danger">
								<time class="date" datetime="9-18">Sep 18</time>
								<span class="text">Account created <a href="#">"Welcom to YNOV-HTB ! "</a></span>
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once 'inc/components/footer.php'; ?>
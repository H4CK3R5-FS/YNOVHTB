<?php

/**
 * @Author: yacine.B
 * @Date:   2022-03-31 20:46:37
 * @Last Modified by:   root
 * @Last Modified time: 2022-04-06 01:53:39
 */

?>

<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="dark2">
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							<?= $auth->user()->pseudo; ?>
							<span class="user-level">Level <?= $auth->getThis($db, 'user_progression', 'token_user=?', [$auth->user()->token])->level ?> </span>
							<span class="caret"></span>
						</span>
					</a>
					<div class="clearfix"></div>

					<div class="collapse in" id="collapseExample">
						<ul class="nav">
							<li>
								<a href="profile.php">
									<span class="link-collapse">My Profile</span>
								</a>
							</li>
							<li>
								<a href="edit-profile.php">
									<span class="link-collapse">Edit Profile</span>
								</a>
							</li>
							<li>
								<a href="settings.php">
									<span class="link-collapse">Settings</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<ul class="nav nav-primary">
				<li class="nav-item <?= ($active_dash)? 'active': ''; ?>">
					<a href="./" aria-expanded="false">
						<i class="fas fa-home"></i>
						<p>Dashboard</p>
					</a>
				</li>

				<li class="nav-item <?= ($active_lessons)? 'active': ''; ?>">
					<a href="lessons.php" aria-expanded="false">
						<i class="fas fa-book"></i>
						<p>Lessons</p>
					</a>
				</li>

				<li class="nav-item <?= ($active_act)? 'active': ''; ?>">
					<a href="activities.php" aria-expanded="false">
						<i class="fas fa-clock"></i>
						<p>Activities</p>
					</a>
				</li>

				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Authentification</h4>
				</li>
				<li class="nav-item">
					<a 	href="../logout.php">
						<i class="fas fa-layer-group"></i>
						<p>Logout</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- End Sidebar -->
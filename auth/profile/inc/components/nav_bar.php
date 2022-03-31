<?php

/**
 * @Author: yacine.B
 * @Date:   2022-03-31 20:42:11
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2022-03-31 23:14:43
 */
?>

<div class="wrapper">
	<div class="main-header">
		<!-- Logo Header -->
		<div class="logo-header" data-background-color="dark">
			
			<a href="index.html" class="logo">
				<span class="text-white h2"><img src="assets/img/logo.png" alt="YnovHTB" class="navbar-brand">&nbsp;YnovHTB</span>
			</a>
			<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
					<i class="icon-menu"></i>
				</span>
			</button>
			<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
			<div class="nav-toggle">
				<button class="btn btn-toggle toggle-sidebar">
					<i class="icon-menu"></i>
				</button>
			</div>
		</div>
		<!-- End Logo Header -->

		<!-- Navbar Header -->
		<nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
			
			<div class="container-fluid">
				<div class="collapse" id="search-nav">
					<form class="navbar-left navbar-form nav-search mr-md-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<button type="submit" class="btn btn-search pr-1">
									<i class="fa fa-search search-icon"></i>
								</button>
							</div>
							<input type="text" placeholder="Search ..." class="form-control">
						</div>
					</form>
				</div>
				<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
					<li class="nav-item toggle-nav-search hidden-caret">
						<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
							<i class="fa fa-search"></i>
						</a>
					</li>
					<li class="nav-item dropdown hidden-caret">
						<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-envelope"></i>
						</a>
						<ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
							<li>
								<div class="dropdown-title d-flex justify-content-between align-items-center">Messages</div>
							</li>
							<li>
								<div class="message-notif-scroll scrollbar-outer">
									<div class="notif-center">
										<a href="#">
											<div class="notif-img"> 
												<img src="assets/img/jm_denis.jpg" alt="Img Profile">
											</div>
											<div class="notif-content">
												<span class="subject">Jimmy Denis</span>
												<span class="block">
													How are you ?
												</span>
												<span class="time">5 minutes ago</span> 
											</div>
										</a>
									</div>
								</div>
							</li>
							<li>
								<a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
							</li>
						</ul>
					</li>
					<li class="nav-item dropdown hidden-caret">
						<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-bell"></i>
							<span class="notification">1</span>
						</a>
						<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
							<li>
								<div class="dropdown-title">You have 1 new notification</div>
							</li>
							<li>
								<div class="notif-scroll scrollbar-outer">
									<div class="notif-center">
										<a href="#">
											<div class="notif-img"> 
												<img src="assets/img/profile2.jpg" alt="Img Profile">
											</div>
											<div class="notif-content">
												<span class="block">
													Reza send messages to you
												</span>
												<span class="time">12 minutes ago</span> 
											</div>
										</a>
									</div>
								</div>
							</li>
							<li>
								<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
							</li>
						</ul>
					</li>
					
					<li class="nav-item dropdown hidden-caret">
						<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
							<div class="avatar-sm">
								<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
							</div>
						</a>
						<ul class="dropdown-menu dropdown-user animated fadeIn">
							<div class="dropdown-user-scroll scrollbar-outer">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
										<div class="u-text">
											<h4>B.Yacine</h4>
											<p class="text-muted">boufala.yacine@ynov.com</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Account Setting</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Logout</a>
								</li>
							</div>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<!-- End Navbar -->
	</div>
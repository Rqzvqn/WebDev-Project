<?php

use services\UserService;

if (isset($_SESSION['userId'])) {
	$userId = $_SESSION['userId'];
}
?>

<script src="nav.js"></script>

<section id="navbar" class="navbar navbar-expand-xs navbar-expand-sm navbar-dark bg-dark fixed-top">
	<a href="home" class="text-decoration-none d-inline-block">
		<h1 class="logo ms-4 mt-2">
			<span class="text-danger"><span
				class="text-white">Game Store</span>
		</h1>
	</a>



	<nav>
		<section class="container">
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navBurger">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse ms-md-5 m-auto" id="navBurger">
				<ul class="navbar-nav m-auto">
					<li class="nav-item"><a id="homeNav" class="nav-link h6" href="home">Home</a></li>
					<li class="nav-item"><a id="mgamesNav" class="nav-link h6" href="mgames">Multiplayer Games</a></li>
					<li class="nav-item"><a id="sgamesNav" class="nav-link h6" href="sgames">Singleplayer Games</a></li>
				</ul>
				<script type="text/javascript">setActiveNav();</script>
				<ul class="navbar-nav">
					<?php
					if (!isset($userId)) {
						?>
						<li class="nav-item">
							<a class="btn btn-danger btn-sm" type="submit" href="login">Login</a>
						</li>
						<?php
					} else {
						?>
						<li class="nav-item dropdown nav-user">
							<a class="nav-link nav-user-img" href="#" id="userDropdown"
							   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-user"></i>
							</a>
							<div class="dropdown-menu px-2" aria-labelledby="userDropdown" style="right: 0; left: auto">
								<div class="nav-user-info">
									<h5 class="mb-0 text-dark nav-user-name">
										<?php
										$user_service = new UserService();
										echo $user_service->getUsernameById($userId);
										?>
									</h5>
								</div>
								<a class="dropdown-item" href="mylists"><i class="fas fa-bars me-2"></i>My Game Lists</a>
								<a class="dropdown-item" href="logout">
									<i class="fas fa-power-off me-2"></i>Logout
								</a>
							</div>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		</section>
	</nav>
</section>
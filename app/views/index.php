<?php

use models\User;
use services\UserService;

require_once __DIR__ . '/../services/userservice.php';
require_once __DIR__ . '/../models/user.php';

if (isset($_SESSION['userId'])) {
	$userId = $_SESSION['userId'];
} else if (isset($_POST['register'])) {
	if ($_POST['email'] != "" && $_POST['username'] != "" && $_POST['password'] != "" && $_POST['passConfirm'] != "") {
		$email = htmlspecialchars($_POST['email']);
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$passConfirm = htmlspecialchars($_POST['passConfirm']);

		if ($password == $passConfirm) {
			$password = md5($password);
			$user = new User();
			$user->setUsername($username);
			$user->setPassword($password);
			$user->setEmail($email);

			$user_service = new UserService();
			$user_service->insertUser($user);
		}
	} else {
		echo "<script>alert('Please fill in all the fields!')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
	      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="/img/favicon/favicon.svg"/>
	<title>Game Store | Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="home.css">
</head>

<body class="bg-white text-dark">
	<header id="hero" class="hero">
		<?php
		include __DIR__ . '/elements/navbar.php';
		?>

		<section
			class="content jumbotron jumbotron-fluid text-light d-flex justify-content-center align-items-center text-center h-100 pt-3 pb-3">
			<?php
			if (isset($_POST['register'])) {
				?>
				<h1 class="display-4">Thank you for registering to Game Store</h1>
				<p class="lead">Feel free to explore our games!
				</p>
				<a href="login" class="btn btn-danger"><i class="fas fa-chevron-right"></i> Login</a>
				<?php
			} else if (!isset($userId)) {
				?>
				<h1 class="display-4">More games, less money, for collectors enthousiasts</h1>
				<p class="lead">Create a game list and add your games to the list for an easy purchase on location!
				</p>
				<a href="#registration" class="btn btn-danger"><i class="fas fa-chevron-right"></i> Create an
					account</a>
				<?php
			} else {
				?>
				<h1 class="display-4">Welcome
					<?php
					echo $user_service->getUsernameById($userId)
					?>
				</h1>
				<p class="lead">We are very happy to present you with a convinient way to store an upcoming purchase for your games!
				</p>
				<a href="mylists" class="btn btn-danger"><i class="fas fa-chevron-right"></i> My Lists</a>
				<?php
			}
			?>
		</section>
	</header>
	<?php
	if (!isset($userId) && !isset($_POST['register'])) {
		?>
		<section id="registration" class="container col-sm-11 col-md-6 col-lg-4 col-xl-3 m-auto my-5 text-center">
			<h1>Create an account</h1>
			<form method="POST" class="mt-4">
				<section class="form-group">
					<input type="email" name="email" placeholder="Enter email" id="email" class="form-control mb-3">
				</section>
				<section class="form-group">
					<input type="text" name="username" placeholder="Enter username" id="username"
					       class="form-control mb-3">
				</section>
				<section class="form-group">
					<input type="password" name="password" placeholder="Enter password" id="password"
					       class="form-control mb-3">
				</section>
				<section class="form-group">
					<input type="password" name="passConfirm" placeholder="Confirm password" id="passConfirm"
					       class="form-control mb-3">
				</section>
				<section class="form-group">
					<button name="register" class="col-12 btn btn-danger btn-block">Register</button>
					<p class="mt-4">Already have an account? <a class="text-decoration-none text-danger"
					                                            href="login">Login</a>
					</p>
				</section>
			</form>
		</section>
		<?php
	}
	?>

	<?php
	include __DIR__ . '/elements/footer.php';
	?>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	        crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
	        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	        crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
	        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
	        crossorigin="anonymous"></script>
</body>
</html>
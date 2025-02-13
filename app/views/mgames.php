<?php


use services\MgameService;
use services\GameListService;

if (isset($_POST['addToList'])) {
	if (!isset($_SESSION['userId'])) {
		header('location: login');
	} else {

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
	<link rel="shortcut icon" href="/img/favicon/favicon.ico" />
	<title>Game Store | Multiplayer Games</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="listings.css">
</head>

<body class="bg-white text-dark">

	<script src="gamelists.js"></script>

	<header id="hero" class="hero">
		<?php
		include __DIR__ . '/elements/navbar.php';
		?>
	</header>

	<section id="page-container">
		<section id="game-container">
			<section class="container">
				<ol class="breadcrumb pt-2">
					<li class="breadcrumb-item">
						<a class="text-decoration-none text-danger" href="home">Home</a>
					</li>
					<li class="breadcrumb-item active">Multiplayer Games</li>
				</ol>
				<h2>Multiplayer Games</h2>
				<section class="row pb-5">
					<?php
					$mgame_service = new MgameService();

					foreach ($mgame_service->getAll() as $mgame) {
						require_once __DIR__ . '/scripts/getimagename.php';
						?>
						<section class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 px-2 py-3">
							<section class="card product-card h-100">
								<img src=" <?php echo '/img/mgames/' . getImageName($mgame) . '.jpg' ?>"
									alt="<?php getImageName($mgame); ?>" title="<?php $mgame->getTitle(); ?>>"
									class="card-img-top w-100">

								<section class="card-footer px-2">
									<p class="card-title">
										<?php echo $mgame->getTitle(); ?>
									</p>
									<section class="float-start">
										<p class="card-text"><small>By:
												<?php echo $mgame->getCreator(); ?><br>
												Price:
												<?php echo $mgame->getMprice(); ?> €
											</small>
										</p>
									</section>
									<?php
									if (!isset($_SESSION['userId'])) {
										?>
										<a href="login" class="btn btn-danger float-end" type="button">
											<i class="fas fa-plus-square"></i>
										</a>
										<?php
									} else {
										?>
										<div class="dropdown">
											<button class="btn btn-danger float-end" type="button" data-toggle="dropdown">
												<i class="fas fa-plus-square"></i>
											</button>
											<div class="dropdown-menu px-2" style="right: 0; left: auto">
												<p><strong>Add to List:</strong></p>
												<?php
												$gameList_service = new GameListService();
												foreach ($gameList_service->getListsByUserId($_SESSION['userId']) as $gameList) {
													?>
													<a style="cursor: pointer"
														onclick="addToList(<?php echo $mgame->getItemId(); ?>, <?php echo $gameList->getGameListId(); ?>);"
														class="dropdown-item py-0"><?php echo $gameList->getName(); ?>
													</a>
													<?php
												}
												?>
											</div>
										</div>
										<?php
									}
									?>
								</section>
							</section>
						</section>
						<?php
					}
					?>
				</section>
			</section>
		</section>
		<?php
		include __DIR__ . '/elements/footer.php';
		?>
	</section>


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
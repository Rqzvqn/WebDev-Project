<?php
$email = "";
if (isset($_POST['sendEmailLink'])) {
	$email = htmlspecialchars($_POST['emailPassReset']);
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
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Game Store | Forgot Password</title>
</head>

<body>
	<script src="user.js"></script>

    <section class="overlay"></section>
    <section class="d-flex align-items-center w-100 h-100 position-absolute">
        <section class="card bg-dark text-white text-center px-5 col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xl-3 mx-auto">
            <form method="POST">
                <h1 class="py-4">Forgot Password</h1>
	            <p class="py-2">Enter your email and you will be redirected you to the password reset page.</p>
                <input type="email" name="emailPassReset" placeholder="Enter email" id="emailPassReset"
                       class="form-control mb-3">
	            <button type="button" onclick="requestPasswordReset(emailPassReset.value)" name="sendEmailLink" class="col-12 btn btn-danger btn-block">Request</button>
	            <p class="pt-4"><small id="feedbackMessageFp"></small></p>
	            <p class="mt-4"><a class="text-decoration-none text-danger"
	                               href="login">Back to Login</a></p>
            </form>
        </section>
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
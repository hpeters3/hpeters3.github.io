<?php

	require('connect.php');
	session_start();

	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$query = "SELECT email FROM users WHERE email = :email";
	$statement = $db->prepare($query);
	$statement->bindValue(':email', $email, PDO::PARAM_STR);
	$statement->execute();
	$exists = $statement->rowCount() > 0;

	if($_POST && isset($_POST['email']) && $exists == true)
	{
		$query = "SELECT * FROM users WHERE email = :email";
		$statement = $db->prepare($query);
		$statement->bindValue(':email', $email, PDO::PARAM_STR);
		$statement->execute();
		$user = $statement->fetch();

		if(password_verify($_POST['password'], $user['password']))
		{
			$_SESSION['user_id'] = $user['id'];
			header("Location: index.php");
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Parallel Inventory</title>
	<link type="text/css" rel="stylesheet" href="parallelstyle.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
	<link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <header>
        <h1><a href="index.php">Parallel Reads</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
	</header>
	<main id="credentials-page">
		<div id="credentials">
			<div id="img-left">
				<img src="images/Part-1.png">
			</div>
			<form method="post">
				<label for="email">Email:</label>
				<input id="email" name="email">
				<label for="password">Password:</label>
				<input id="password" name="password" type="password">
				<input type="submit" value="Login">

				<?php if($_POST && $exists == false):?>
					<p class="signup">You do not have an account. Please create one.</p>
				<?php elseif($_POST && (password_verify($_POST['password'], $user['password']) == false || strcmp($_POST['email'], $user['email']) != 0)):?>
					<p class="signup">Please enter the correct email and password.</p>
				<?php endif?>
				<a class="signup" href="signup.php">Don't have an account? Sign up</a>
			</form>
			<div id="img-right">
				<img src="images/Part-2.png">
			</div>
		</div>
	</main>
	<footer>
		<a href="https://www.facebook.com/" target="_blank"><img src="Images/Facebook-removebg.png" alt="Facebook"></a>
		<a href="https://www.instagram.com/" target="_blank"><img src="Images/Instagram-removebg.png" alt="Instagram"></a>
		<a href="https://www.pinterest.com/" target="_blank"><img src="Images/Pintrest-removebg.png" alt="Pinterest"></a>
		<a href="https://x.com/" target="_blank"><img src="Images/Twitter-removebg.png" alt="Twitter"></a>
		<a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank"><img src="Images/Youtube-removebg.png" alt="YouTube"></a>
		
		<nav id="footernav">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="contact.php">Contact Us</a></li>
                <li><a href="login.php">Account</a></li>
                <li><a href="inventory.php">Inventory</a></li>
			</ul>
		</nav>
		
		<p id="border">328 Falcon Lake, Manitoba, Canada</p>
		<p>© Copyright 2025 Hayley Peters</p>
	</footer>
</body>
</html>
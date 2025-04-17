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

		if($_POST && strcmp($_POST['password'], $user['password']) == 0)
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
	<link rel="stylesheet" type="text/css" href="cms.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
	<link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <header id="head">
        <div>
            <h1><a href="index.php">Parallel Reads</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
	</header>
	<main id="contact">
		<div id="contact_info">
			<form method="post">
				<label for="email">Email:</label>
				<input id="email" name="email">
				<label for="password">Password:</label>
				<input id="password" name="password" type="password">
				<input type="submit" value="Login">

				<?php if($_POST && $exists == false):?>
					<p>You do not have an account. Please create one.</p>
				<?php elseif($_POST && (strcmp($_POST['password'], $user['password']) != 0 || strcmp($_POST['email'], $user['email']) != 0)):?>
					<p>Please enter the correct username and password.</p>
				<?php endif?>

				<a href="signup.php">Sign Up</a>
			</form>
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
		<p>© Copyright 2024 Hayley Peters</p>
		
	</footer>
</body>
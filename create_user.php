<?php

	require('connect.php');
	session_start();

	if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE id =:id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch();
    }

	$id = true;

	if($_POST && strcmp($_POST['password'], $_POST['repassword']) == 0)
	{
		if($_POST && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']))
		{
			$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	
			$query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
			$statement = $db -> prepare($query);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':password', $password);
			$statement->bindValue(':email', $email);
			$statement->execute();
			
			header("Location: inventory.php");
			exit;
		}
		else if($_POST && (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])))
		{
			$id = false;
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<html>
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
	<header>
            <h1><a href="index.php">Parallel Reads</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <?php if(isset($_SESSION['user_id'])):?>
                    <li><a href="profile.php"><?=$user['username']?></a></li>
                <?php else:?>
                    <li><a href="login.php">Log In</a></li>
                <?php endif?>
                <li><a href="inventory.php">Inventory</a></li>
                
            </ul>
        </nav>
	</header>
	<main id="contact">
		<div id="contact_info">
			<?php if ($id): ?>
				<form method="post">
					<label for="username">Username:</label>
					<input id="username" name="username">
					<label for="email">Email:</label>
					<input id="email" name="email">
					<label for="password">Password:</label>
					<input id="password" name="password" type="password">
					<label for="repassword">Re-enter password:</label>
					<input id="repassword" name="repassword" type="password">
					<input id="buttons" type="submit" value="Sign Up">
	
					<?php if($_POST && strcmp($_POST['password'], $_POST['repassword']) != 0):?>
						<p>Your passwords do not match. Try again.</p>
					<?php endif?>
				</form>
			<?php else:
				echo "You missed something, make sure you fill in all the fields.";
			endif ?>
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
				<?php if(isset($_SESSION['user_id'])):?>
                    <li><a href="profile.php">Account</a></li>
                <?php else:?>
                    <li><a href="login.php">Account</a></li>
                <?php endif?>
                <li><a href="inventory.php">Inventory</a></li>
			</ul>
		</nav>
		
		<p id="border">328 Falcon Lake, Manitoba, Canada</p>
		<p>© Copyright 2025 Hayley Peters</p>
		
	</footer>
</body>
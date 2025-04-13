<?php

	require('connect.php');
	require('authenticate.php');
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

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT id FROM users WHERE id =:id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();
	$exists = $statement->rowCount() > 0;
	$display = true;

	if(isset($_POST['delete']))
	{
		$id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
		$query = "DELETE FROM users WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		header("Location: users.php");
		exit;
	}
	else if($_POST && (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])))
	{
		$display = false;
	}
	else if($_POST && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
	{
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$password = $_POST['password']; //will hash and salt later
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

		$query = "UPDATE users SET email = :email, username = :username, password = :password WHERE id = :id";
		$statement = $db -> prepare($query);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $password);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		header("Location: users.php");
		exit;
	}
	else if(isset($_GET['id']) && $exists == true)
	{
		$query = "SELECT * FROM users WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		$post = $statement->fetch();
	}
	else
	{
		$id = false;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update User | Parallel Reads</title>
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
			<?php if($id && $display):?>
				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?= $post['id'] ?>">
					<fieldset>
						<legend>Update User</legend>
						<p><label for="email">Email</label>
						<input id="email" name="email" value="<?=$post['email']?>"></p>

						<p><label for="username">Username</label>
						<input id="username" name="username" value="<?=$post['username']?>"></p>

						<p><label for="password">Password</label>
						<input id="password" name="password" value="<?=$post['password']?>"></p>
					</fieldset>

					<p><input id="buttons" type="submit" value="Update"></p>
				</form>

				<form method="post" id="buttons">
					<button name="delete" value="<?=$post['id']?>">Delete</button>
				</form>
			<?php elseif($display == false):
				echo "Make sure you have something in all the fields.";
			else:
				header("Location: users.php");
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
				<li><a href="products.html">Products</a></li>
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
		<p>© Copyright 2024 Hayley Peters</p>
	</footer>
</body>
</html>
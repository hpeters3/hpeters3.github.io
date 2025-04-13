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

        if(isset($_POST['delete']))
		{
			$id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
			$query = "DELETE FROM users WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id, PDO::PARAM_INT);
			$statement->execute();
			session_destroy();
	
			header("Location: index.php");
			exit;
		}

        if(isset($_POST['log_out']))
		{
			session_destroy();
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
	<title><?=$user['username']?>'s Account | Parallel Reads</title>
	<link type="text/css" rel="stylesheet" href="parallelstyle.css">
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
            </ul>
        </nav>
	</header>

    <main>
    	<?php if(isset($_SESSION['user_id'])): ?>
    		<form method="post">
    			<input type="hidden" name="log_out" value="log_out">
    			<input id="buttons" type="submit" value="Log Out">
    		</form>
    		<form method="post">
    			<input type="hidden" name="delete" value="<?=$user['id']?>">
				<input id="buttons" type="submit" value="Delete your account?">
			</form>
		<?php else: ?>
			<p>Oh, you think you're so clever, don't you?</p>
			<p>Did you really think an error like that would slip by me?</p>
			<p>Oh, you're so mistaken.</p>
			<p>Do you want to know what I think?</p>
			<button><a href="whydidyouclickme.php">Click here.</a></button>
		<?php endif?>
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
				<li><a href="php.html">Products</a></li>
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
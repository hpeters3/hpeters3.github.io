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
        $post = $statement->fetch();

        echo print_r($_POST);

        if(isset($_POST['log_out']))
		{
			session_destroy();
			header("Location: index.html");
			exit;
		}
    }
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link type="text/css" rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
	<link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
    <header id="head">
        <div>
            <h1><a href="index.html">Parallel Reads</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <?php if(isset($_SESSION['user_id'])):?>
                    <li><a href="profile.php"><?=$post['username']?></a></li>
                <?php else:?>
                    <li><a href="login.php">Account</a></li>
                <?php endif?>
            </ul>
        </nav>
	</header>

    <main>
    	<form method="post">
    		<input type="hidden" name="log_out" value="log_out">
    		<input id="buttons" type="submit" value="Log Out">
    	</form>
    </main>
    
    <footer>
		<a href="https://www.facebook.com/" target="_blank"><img src="Images/Facebook-removebg.png" alt="Facebook"></a>
		<a href="https://www.instagram.com/" target="_blank"><img src="Images/Instagram-removebg.png" alt="Instagram"></a>
		<a href="https://www.pinterest.com/" target="_blank"><img src="Images/Pintrest-removebg.png" alt="Pinterest"></a>
		<a href="https://x.com/" target="_blank"><img src="Images/Twitter-removebg.png" alt="Twitter"></a>
		<a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank"><img src="Images/Youtube-removebg.png" alt="YouTube"></a>
		
		<nav id="footernav">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="php.html">Products</a></li>
				<li><a href="contact.html">Contact Us</a></li>
                <li><a href="login.php">Account</a></li>
                <li><a href="inventory.php">Inventory</a></li>
			</ul>
		</nav>
		
		<p id="border">328 Falcon Lake, Manitoba, Canada</p>
		<p>© Copyright 2024 Hayley Peters</p>
		
	</footer>
</body>
</html>
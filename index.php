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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Parallel Reads</title>
	<link type="text/css" rel="stylesheet" href="parallelstyle.css">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
	<link rel="manifest" href="favicon_io/site.webmanifest">
</head>
<body>
	<header id="home">
		<img src="Images/Home-Page.JPG" alt="A large intro photo.">
		<h1>Parallel Reads</h1>
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
		<h2>Expose your shelf to something new</h2>
	</header>

	<main>
		<section id="welcome">
			<div>
				<h3>Who are we?</h3>
				<p>Parallel Reads is a locally owned book store founded by Javon Ives. We aim to sell unique books that give you a new perspective on the world around you. While these are fictional, real world applications can be found within our books. So don't just look at the face value of the books &mdash; try to see the unseen.</p>
			</div>
		</section>
	
		<section id="padding" class="sales">
			<h4 class="italic">Our 2025 sales</h4>
			<div>
				<a href="contact.php">
					<img src="uploads/Victory-in-the-Shadows.jpg" alt="A teal hardcover book with a gold symbol in the center with an 'A'.">
					<h4>Victory in the Shadows</h4>
					<p>By Denzell Winters</p>
					<p><span class="strike">$43.05</span>&nbsp; &mdash; now $38.75!</p>
				</a>
			</div>
			<div>
				<a href="contact.php">
					<img src="uploads/Magic-In-The-Air.jpg" alt="A red hardcover book with a gold symbol in the center with an 'A'.">
					<h4>Magic In The Air</h4>
					<p>By Denzell Winters</p>
					<p><span class="strike">$88.61</span>&nbsp; &mdash; now $79.75!</p>
				</a>
			</div>
			<div>
				<a href="contact.php">
					<img src="uploads/Breakpoint.jpg" alt="A purple hardcover book with a gold symbol in the center with an 'A'.">
					<h4>Breakpoint</h4>
					<p>By Denzell Winters</p>
					<p><span class="strike">$98.05</span>&nbsp; &mdash; now $88.25!</p>
				</a>
			</div>
		</section>
	
		<section class="sales">
			<h4 class="italic" id="small">Bestsellers</h4>
			<div>
				<a href="contact.php">
					<img src="uploads/The-Mad-Lovers.jpg" alt="A red hardcover book with intriducte patterns on the front, with the title 'The 	Bad Lovers' overtop of a slice of orange, all done in silver.">
					<h4>The Mad Lovers</h4>
					<p>By Chimand Alizo</p>
					<p>$75.25</p>
				</a>
			</div>
			<div>
				<a href="contact.php">
					<img src="uploads/Waves-of-Chaos.jpg" alt="A red hardcover book a silver circle containing a silver wave of water.">
					<h4>Waves of Chaos</h4>
					<p>By Lucian Rivera</p>
					<p>$55.00</p>
				</a>
			</div>
			<div>
				<a href="contact.php">
					<img src="uploads/A-Dangerous-Wish.jpg" alt="A black hardcover book with a intricate green frame around the words 'A WISH GRANTED IS A VERY SEDUCTIVE THING' and an outline of an apple below it with green substance covering half of it and dripping down.">
					<h4>A Dangerous Wish</h4>
					<p>By Jade Miller</p>
					<p>$90.75</p>
				</a>
			</div>
			<h4 class="italic" id="large">Bestsellers</h4>
		</section>
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
</html>
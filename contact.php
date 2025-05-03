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

    $query = "SELECT * FROM book_inventory ORDER BY id DESC";
    $statement = $db->prepare($query);
    $statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contact | Parallel Reads</title>
	<link type="text/css" rel="stylesheet" href="parallelstyle.css">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
	<link rel="manifest" href="favicon_io/site.webmanifest">
	<script src="javascript.js"></script>
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
			</ul>
		</nav>
	</header>

	<main id="contact">
		<div id="contact_info">
			<h2>Contact Us</h2>
			<p>parallelreads@gmail.com</p>
			<p>Manager phone number: 204-835-4393</p>
			<p>For general inquiries: 929-556-2746</p>
			<p>Because of the nature of our books, there is a limit of one copy per customer.</p>
			<p>Book orders will be processed within a day of form submission. We will email you with more information at that point, such as your total.</p>
		</div>
		
		<form name="form" action="index.php">
			<h3>Your Information:</h3>
			<input type="text" id="name" placeholder="Your Name">
			<p class="error" id="name_error">* Please enter your name.</p>
	
			<?php if(isset($_SESSION['user_id'])):?>
                <input id="email" type="text" value="<?=$user['email']?>">
            <?php else:?>
                <input id="email" type="text" placeholder="Your Email">
            <?php endif?>

			<p class="error" id="email_error">* Please enter your email.</p>
			<p class="error" id="emailformat_error">* Please enter a valid email address.</p>
	
			<input id="phonenumber" type="number" placeholder="Your Phone Number">
			<p class="error" id="phonenumber_error">* Please enter your phone number.</p>
			<p class="error" id="numberformat_error">* Please enter a valid phone number.</p>

			<h3>Which book(s) are you looking to purchase?</h3>
			<div id="checkbox-container">
				<?php while($row = $statement->fetch()):?>
                	<div>
                    	<input type="checkbox">
						<label><?=$row['title']?></label>
                	</div>
            	<?php endwhile?>
			</div>

			<textarea name="message" placeholder = "Your Message"></textarea>
			<p class="error" id="message_error">* Please enter a message.</p>
			
			<div id="buttons">
				<button type="submit" id="submit">Submit</button>
				<button type="reset" id="reset">Reset</button>
			</div>
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
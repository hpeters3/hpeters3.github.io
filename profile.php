<?php
	require('connect.php');
	session_start();
	$loopy = 0;

	if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE id =:id";
        $user_statement = $db->prepare($query);
        $user_statement->bindValue(':id', $id, PDO::PARAM_INT);
        $user_statement->execute();
        $user = $user_statement->fetch();

        if(isset($_POST['delete-comment']))
		{
			$id = filter_input(INPUT_POST, 'delete-comment', FILTER_SANITIZE_NUMBER_INT);
			$query = "DELETE FROM comments WHERE id = :id";
			$statement = $db->prepare($query);
			$statement->bindValue(':id', $id, PDO::PARAM_INT);
			$statement->execute();
	
			header("Location: profile.php");
			exit;
		}

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

		$user_id = $_SESSION['user_id'];
		$query = "SELECT comments.*, book_inventory.title FROM comments JOIN book_inventory ON comments.book_id = book_inventory.id WHERE comments.user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		$statement->execute();
		$comment_exists = $statement->rowCount() > 0;
	
		if($comment_exists == true)
		{
			$query = "SELECT comments.*, book_inventory.title FROM comments JOIN book_inventory ON comments.book_id = book_inventory.id WHERE comments.user_id = :user_id ORDER BY id DESC";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$statement->execute();
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

	<main id="profile-info">
		<section>
			<div id="img-left">
				<img src="images/Part-1.png">
			</div>
		</section>
		
		<section id="reduce">
			<?php if(isset($_SESSION['user_id'])): ?>
				<div>
					<h2><?=$user['username']?></h2>
					<p id="email-info">Your email:<br><?=$user['email']?></p>
				</div>
				<div>
					<?php if ($comment_exists == true):?>
						<h3>Your most recent comments:</h3>
					<?php endif;
					while(($comments = $statement->fetch()) && $loopy < 5): ?>
						<div class="center-comments">
    	    				<h4><?=$comments['title']?></h4>
    	    				<p class="profile-comments"><?=$comments['comment']?></p>
	
							<div class="profile-buttons">
    							<form method="post" class="counter-form">
									<button type="submit" name="delete-comment" class="button-display" value="<?=$comments['id']?>">Delete</button>
								</form>
							</div>
						</div>
						<?php $loopy++;
    	    		endwhile?>
				</div>
				<div class="profile-buttons">
    				<form method="post" class="filter">
    					<input type="hidden" name="log_out" value="log_out">
    					<input type="submit" value="Log Out">
    				</form>
    				<form method="post" class="filter">
    					<input type="hidden" name="delete" value="<?=$user['id']?>">
						<input type="submit" value="Delete your account?">
					</form>
				</div>
			<?php else: ?>
				<div class="mystery">
					<p>Oh, you think you're so clever, don't you?</p>
					<p>Did you really think an error like that</p>
					<p>would slip by me?</p>
					<p>You're very mistaken.</p>
					<p style="color:#f0ebe4;">Pretend this is centered, I didn't have the time.</p>
					<button><a href="whydidyouclickme.php">Click here</a></button>
				</div>
			<?php endif?>
		</section>

		<section>
			<div id="img-right">
				<img src="images/Part-2.png">
			</div>
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
		<p>© Copyright 2025 Hayley Peters</p>
		
	</footer>
</body>
</html>
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

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT id FROM book_inventory WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();
	$exists = $statement->rowCount() > 0;

	if(isset($_GET['id']) && $exists == true)
	{
		$query = "SELECT * FROM book_inventory WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		$post = $statement->fetch();
	}
	else
	{
		$id = false;
	}

	if(isset($_POST['delete']))
	{
		$id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
		$query = "DELETE FROM comments WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		header("Location: display.php?id=" . $post['id']);
		exit;
	}

	if($_POST && !empty($_POST['comment']))
	{
		$user_id = $_SESSION['user_id'];
		$book_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$query = "INSERT INTO comments (user_id, book_id, comment) VALUES (:user_id, :book_id, :comment)";
		$statement = $db -> prepare($query);
		$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		$statement->bindValue(':book_id', $book_id, PDO::PARAM_INT);
		$statement->bindValue(':comment', $comment);
		$statement->execute();

		header("Location: display.php?id=" . $post['id']);
		exit;
	}

	$book_id = filter_input(INPUT_GET, 'book_id', FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id =  users.id WHERE comments.book_id = :book_id";
	$statement = $db->prepare($query);
	$statement->bindValue(':book_id', $post['id'], PDO::PARAM_INT);
	$statement->execute();
	$comment_exists = $statement->rowCount() > 0;

	if($comment_exists == true)
	{
		$query = "SELECT comments.*, users.username FROM comments LEFT OUTER JOIN users ON comments.user_id = users.id WHERE comments.book_id = :book_id ORDER BY id DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':book_id', $post['id'], PDO::PARAM_INT);
		$statement->execute();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$post['title']?> | Parallel Reads</title>
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
            </ul>
        </nav>
	</header>

	<main>
		<section id="products">
			<?php if($id):?>
				<div>
					<h2><?=$post['title']?></h2>
					<?php if($post['image']):?>
                       	<img src="<?=$post['image']?>" alt="<?=$post['image_alt']?>">
                    <?php endif?>
        			<p><?=$post['author'] ?></p>
        			<p><?=$post['description'] ?></p>
        			<p><?=$post['genre'] ?></p>
        			<p><?=$post['stock'] ?></p>
        			<p><?=$post['price'] ?></p>
        		</div>
        	<?php else:
        		header("Location: products.php");
        	endif?>
    	</section>

    	<?php if(isset($_SESSION['user_id'])):?>
    		<section>
    			<form method="post">
    				<textarea name="comment" placeholder="Enter your review here."></textarea>
    				<input type="submit" value="Submit">
    			</form>
    		</section>
    	<?php else:?>
    		<section>
    			<form method="post">
    				<textarea name="comment" placeholder="Enter your review here."></textarea>
    				<a href="login.php">Log in to join the conversation.</a>
    			</form>
    		</section>
    	<?php endif;

    	while($comments = $statement->fetch()):
    		if($comments['public'] == 0):?>
				<div>
					<?php if(empty($comments['username'])):?>
						<p>Deleted User</p>
					<?php else:?>
        				<p><?=$comments['username'] ?></p>
        			<?php endif?>
        			<p><?=$comments['comment'] ?></p>
	
        			<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comments['user_id']):?>
    					<form method="post" id="buttons">
							<button type="submit" name="delete" value="<?=$comments['id']?>">Delete</button>
						</form>
					<?php endif?>
        		</div>
        	<?php endif;
        endwhile?>
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
		<p>© Copyright 2024 Hayley Peters</p>
		
	</footer>
</body>
</html>
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

    if($_POST && isset($_POST['sort_title']))
    {
    	$query = "SELECT * FROM book_inventory ORDER BY title ASC";
		$statement = $db->prepare($query);
		$statement->execute();
    }
    else if($_POST && isset($_POST['sort_author']))
    {
    	$query = "SELECT * FROM book_inventory ORDER BY author ASC";
		$statement = $db->prepare($query);
		$statement->execute();
	}
    else if($_POST && isset($_POST['sort_price']))
    {
    	$query = "SELECT * FROM book_inventory ORDER BY price ASC";
		$statement = $db->prepare($query);
		$statement->execute();
    }
    else if($_POST && isset($_POST['sort_original']))
    {
    	$query = "SELECT * FROM book_inventory ORDER BY id DESC";
		$statement = $db->prepare($query);
		$statement->execute();
    }
    else
    {
    	$query = "SELECT * FROM book_inventory ORDER BY id DESC";
		$statement = $db->prepare($query);
		$statement->execute();
    }

    if(isset($_POST['delete']))
	{
		$id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
		$query = "DELETE FROM comments WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		header("Location: inventory.php");
		exit;
	}

	if(isset($_POST['hide']))
	{
		$id = filter_input(INPUT_POST, 'hide', FILTER_SANITIZE_NUMBER_INT);
		$public = 1;
		$query = "UPDATE comments SET public = :public WHERE id = :id";
		$statement = $db -> prepare($query);
		$statement->bindValue(':public', $public);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		header("Location: inventory.php");
		exit;
	}

	if(isset($_POST['unhide']))
	{
		$id = filter_input(INPUT_POST, 'unhide', FILTER_SANITIZE_NUMBER_INT);
		$public = 0;
		$query = "UPDATE comments SET public = :public WHERE id = :id";
		$statement = $db -> prepare($query);
		$statement->bindValue(':public', $public);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		header("Location: inventory.php");
		exit;
	}

	$query = "SELECT * FROM users ORDER BY id DESC";
	$user_statement = $db->prepare($query);
	$user_statement->execute();

    $query = "SELECT comments.*, users.username, book_inventory.title FROM comments LEFT OUTER JOIN users ON comments.user_id = users.id JOIN book_inventory ON comments.book_id = book_inventory.id ORDER BY comments.id DESC";
	$comment_statement = $db->prepare($query);
	$comment_statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inventory | Parallel Reads</title>
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
                <li><a href="inventory.php">Inventory</a></li>
            </ul>
        </nav>
	</header>
	<main id="inventory">
		<nav>
			<ul class="nav">
				<li class="appeal"><a href="#book-section">Books</a></li>
				<li class="appeal"><a href="#users-section">Users</a></li>
				<li class="appeal"><a href="#comment-section">Comments</a></li>
			</ul>
		</nav>

		<section id="book-section">
			<h2>Books</h2>

			<p><a href="post.php">Create Inventory</a></p>

			<div class="filter_container">
				<form method="post" class="filter">
    				<input type="hidden" name="sort_title" value="sort_title">
    				<input type="submit" value="Sort Books By Title">
    			</form>
		
    			<form method="post" class="filter">
    					<input type="hidden" name="sort_author" value="sort_author">
    					<input type="submit" value="Sort Books By Author">
    			</form>
		
    			<form method="post" class="filter">
    					<input type="hidden" name="sort_price" value="sort_price">
    					<input type="submit" value="Sort Books By Price">
    			</form>
		
    			<form method="post" class="filter">
    					<input type="hidden" name="sort_original" value="sort_original">
    					<input type="submit" value="Clear Filter">
    			</form>
    		</div>
		
    		<?php if($_POST && isset($_POST['sort_title'])):?>
    			<p>Organizing By Title</p>
    		<?php elseif($_POST && isset($_POST['sort_author'])):?>
    			<p>Organizing By Author</p>
    		<?php elseif($_POST && isset($_POST['sort_price'])):?>
    			<p>Organizing By Price</p>
    		<?php endif?>
	
			<?php while($row = $statement->fetch()):?>
				<div class="book">
        	    	<h3><?=$row['title']?></h3>
        	    	<a href = "edit.php?id=<?=$row['id']?>">Edit</a>
        	    	<div>
        	    		<?php if($row['image']):?>
        	                <img src="<?=$row['image']?>" alt="<?=$row['image_alt']?>">
        	            <?php else:?>
        	               	<p>This book has no image.</p>
        	            <?php endif?>
        	    		<p>Image alternate: <?= $row['image_alt'] ?></p>
        	        	<p>Author: <?= $row['author'] ?></p>
        	        	<p>Description: <?= $row['description'] ?></p>
        	        	<p>Genre: <?= $row['genre'] ?></p>
        	        	<p>Stock: <?= $row['stock'] ?></p>
        	        	<p>Price: $<?= $row['price'] ?></p>
        	    	</div>
        	    </div>
        	<?php endwhile?>
        </section>

        <nav>
			<ul class="nav">
				<li class="appeal"><a href="#book-section">Books</a></li>
				<li class="appeal"><a href="#users-section">Users</a></li>
				<li class="appeal"><a href="#comment-section">Comments</a></li>
			</ul>
		</nav>

        <section id="users-section">
        	<h2>Users</h2>

        	<p><a href="create_user.php">Create Users</a></p>

        	<?php while($row = $user_statement->fetch()):?>
				<div class="book">
        	    	<a href = "update_users.php?id=<?=$row['id']?>">Edit</a>
        	    	<div>
        	    		<p>Username: <?=$row['username']?></p>
        	    		<p>Email: <?= $row['email'] ?></p>
        	    	</div>
        	    </div>
        	<?php endwhile?>
        </section>

        <nav>
			<ul class="nav">
				<li class="appeal"><a href="#book-section">Books</a></li>
				<li class="appeal"><a href="#users-section">Users</a></li>
				<li class="appeal"><a href="#comment-section">Comments</a></li>
			</ul>
		</nav>

        <section id="comment-section">
			<h2>Comments</h2>

        	<?php while($comments = $comment_statement->fetch()):?>
				<div>
        	    	<?php if(empty($comments['username'])):?>
						<p>Deleted User</p>
					<?php else:?>
        				<p>Username: <?=$comments['username'] ?></p>
        			<?php endif?>

        	    	<p>Book: <?= $comments['title'] ?></p>
        	        <p>Comment: <?= $comments['comment'] ?></p>

        	        <?php if($comments['public'] == 0):?>
        	        	<p>Hidden: false</p>
        	        	<form method="post" class="filters counter-form">
							<button type="submit" class="button-display" name="hide" value="<?=$comments['id']?>">Hide Comment</button>
						</form>
        	        <?php else:?>
        	        	<p>Hidden: true</p>
        	        	<form method="post" class="filters counter-form">
							<button type="submit" class="button-display" name="unhide" value="<?=$comments['id']?>">Reveal Comment</button>
						</form>
        	        <?php endif?>
        	    </div>
        	    <form method="post" class="filters counter-form">
					<button type="submit" class="button-display" name="delete" value="<?=$comments['id']?>">Delete</button>
				</form>
				
        	<?php endwhile?>
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
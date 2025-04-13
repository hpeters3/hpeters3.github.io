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
		$title = $statement->fetch();
    }
    else if($_POST && isset($_POST['sort_author']))
    {
    	$query = "SELECT * FROM book_inventory ORDER BY author ASC";
		$statement = $db->prepare($query);
		$statement->execute();
		$title = $statement->fetch();
    }
    else if($_POST && isset($_POST['sort_genre']))
    {
    	$query = "SELECT * FROM book_inventory ORDER BY genre ASC";
		$statement = $db->prepare($query);
		$statement->execute();
		$title = $statement->fetch();
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

    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE id =:id";
        $user_statement = $db->prepare($query);
        $user_statement->bindValue(':id', $id, PDO::PARAM_INT);
        $user_statement->execute();
        $user = $user_statement->fetch();
    }

	$query = "SELECT * FROM users ORDER BY id DESC";
	$user_statement = $db->prepare($query);
	$user_statement->execute();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inventory | Parallel Reads</title>
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
	<main>
		<section>
			<h2>Books</h2>

			<li><a href="post.php">Create Inventory</a></li>

			<div class="filter_buttons">
				<form method="post" class="filters">
    				<input type="hidden" name="sort_title" value="sort_title">
    				<input type="submit" value="Sort Books By Title">
    			</form>
		
    			<form method="post" class="filters">
    					<input type="hidden" name="sort_author" value="sort_author">
    					<input type="submit" value="Sort Books By Author">
    			</form>
		
    			<form method="post" class="filters">
    					<input type="hidden" name="sort_genre" value="sort_genre">
    					<input type="submit" value="Sort Books By Genre">
    			</form>
		
    			<form method="post" class="filters">
    					<input type="hidden" name="sort_original" value="sort_original">
    					<input type="submit" value="Clear Filter">
    			</form>
    		</div>
		
    		<?php if($_POST && isset($_POST['sort_title'])):?>
    			<p>Organizing By Title</p>
    		<?php elseif($_POST && isset($_POST['sort_author'])):?>
    			<p>Organizing By Author</p>
    		<?php elseif($_POST && isset($_POST['sort_genre'])):?>
    			<p>Organizing By Genre</p>
    		<?php endif?>
	
			<?php while($row = $statement->fetch()):?>
				<div class="book">
        	    	<p><?=$row['title']?></p>
        	    	<a href = "edit.php?id=<?=$row['id']?>">Edit</a>
        	    	<div>
        	    		<?php if($row['image']):?>
        	                <img src="<?=$row['image']?>">
        	            <?php else:?>
        	               	<p>This book has no image.</p>
        	            <?php endif?>
        	    		<p><?= $row['image_alt'] ?></p>
        	        	<p>By <?= $row['author'] ?></p>
        	        	<p><?= $row['description'] ?></p>
        	        	<p><?= $row['genre'] ?></p>
        	        	<p><?= $row['stock'] ?></p>
        	        	<p><?= $row['price'] ?></p>
        	    	</div>
        	    </div>
        	<?php endwhile?>
        </section>

        <section>
        	<h2>Users</h2>

        	<li><a href="create_user.php">Create Users</a></li>

        	<?php while($row = $user_statement->fetch()):?>
				<div class="book">
        	    	<a href = "update_users.php?id=<?=$row['id']?>">Edit</a>
        	    	<div>
        	    		<p>Username: <?=$row['username']?></p>
        	    		<p>Email: <?= $row['email'] ?></p>
        	        	<p>Password: <?= $row['password'] ?></p>
        	    	</div>
        	    </div>
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
		<p>© Copyright 2024 Hayley Peters</p>
		
	</footer>
</body>
</html>
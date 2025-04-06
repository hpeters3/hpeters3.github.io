<?php

	require('connect.php');
	require('authenticate.php');

	$query = "SELECT * FROM book_inventory ORDER BY id DESC";
	$statement = $db->prepare($query);
	$statement->execute();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Parallel Inventory</title>
	<link type="text/css" rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="cms.css">
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
                <li><a href="login.php">Account</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                
            </ul>
        </nav>
	</header>
	<main>
		<ul>
			<li><a href="post.php">Update Inventory</a></li>
			<li><a href="users.php">Users</a></li>
		</ul>

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
				<li><a href="products.php">Products</a></li>
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
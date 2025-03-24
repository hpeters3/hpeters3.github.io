<?php

	require('connect.php');

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	$id = true;

	if($_POST && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['description']) && !empty($_POST['genre']) && !empty($_POST['stock']) && !empty($_POST['price']))
	{
		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT);
		$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$query = "INSERT INTO book_inventory (title, author, description, genre, stock, price) VALUES (:title, :author, :description, :genre, :stock, :price)";
		$statement = $db -> prepare($query);
		$statement->bindValue(':title', $title);
		$statement->bindValue(':author', $author);
		$statement->bindValue(':description', $description);
		$statement->bindValue(':genre', $genre);
		$statement->bindValue(':stock', $stock);
		$statement->bindValue(':price', $price);
		echo $price;
		$statement->execute();

		header("Location: inventory.php");
		exit;
	}
	else if($_POST && (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['description']) || empty($_POST['genre']) || empty($_POST['stock']) || empty($_POST['price'])))
	{
		$id = false;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Parallel Inventory</title>
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
                <li><a href="products.html">Products</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="inventory.php">Inventory</a></li>
            </ul>
        </nav>
	</header>
	<main id="contact">
		<ul>
			<li><a href="inventory.php">Current Inventory</a></li>
			<li><a href="post.php">Update Inventory</a></li>
		</ul>

		<div id="contact_info">
			<?php if ($id): ?>
				<form method="post" action="post.php">
					<fieldset>
						<legend>New Book</legend>
						<p><label for="title">Title</label>
						<input id="title" name="title"></p>

						<p><label for="author">Author</label>
						<input id="author" name="author"></p>

						<p><label for="description">Description</label>
						<input id="description" name="description"></p>

						<p><label for="genre">Genre</label>
						<input id="genre" name="genre"></p>

						<p><label for="stock">Stock</label>
						<input id="stock" name="stock"></p>

						<p><label for="price">Price</label>
						<input id="price" name="price"></p>
					</fieldset>

					<div id="buttons">
						<p><input type="submit" value="Submit"></p>
						<p><input type="reset" value="Reset"></p>
					</div>
				</form>
			<?php else:
				echo "You missed something, make sure you fill in all the fields.";
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
				<li><a href="index.html">Home</a></li>
				<li><a href="products.html">Products</a></li>
				<li><a href="contact.html">Contact Us</a></li>
                <li><a href="inventory.php">Inventory</a></li>
			</ul>
		</nav>
		
		<p id="border">328 Falcon Lake, Manitoba, Canada</p>
		<p>© Copyright 2024 Hayley Peters</p>
	</footer>
</body>
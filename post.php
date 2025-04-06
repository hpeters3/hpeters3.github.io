<?php

	require('connect.php');
	require('authenticate.php');

	require '\XAMPP\htdocs\Web_Dev_2\Module 6\Project\hpeters3.github.io\php-image-resize-master\lib\ImageResize.php';
	require '\XAMPP\htdocs\Web_Dev_2\Module 6\Project\hpeters3.github.io\php-image-resize-master\lib\ImageResizeException.php';

	$id = true;

	if($_POST && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['description']) && !empty($_POST['genre']) && !empty($_POST['stock']) && !empty($_POST['price']) && !empty($_POST['image_alt']))
	{
		$upload = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
		$image = '';
	
		if($upload)
		{
			function file_path($filename)
			{
				$current_folder = dirname(__FILE__);
				$broken_path = [$current_folder, 'uploads_original', basename($filename)];
				return join(DIRECTORY_SEPARATOR, $broken_path);
			}

			function file_image($temp_path, $new_path)
			{
				$allowed_type = ['image/jpg', 'image/jpeg', 'image/png', 'images/JPG', 'images/JPEG'];
				$allowed_extension = ['jpg', 'png', 'JPG'];
				$extension = pathinfo($new_path, PATHINFO_EXTENSION);
				$type = mime_content_type($temp_path);
				$extension_valid = in_array($extension, $allowed_extension);
				$type_valid = in_array($type, $allowed_type);
				return $extension_valid && $type_valid;
			}

			$filename = $_FILES['image']['name'];
			$temp_path = $_FILES['image']['tmp_name'];
			$new_path = file_path($filename);
	
			if(file_image($temp_path, $new_path))
			{
				move_uploaded_file($temp_path, $new_path);
				$image = 'uploads_original/' . basename($new_path);
				$resized_path = 'uploads/' . $_POST['title'] . '.jpg';

				$resized = new \Gumlet\ImageResize($new_path);
				$resized->resize(250, 375, true);
				$resized->save($resized_path);
				$image = $resized_path;
			}
		}

		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT);
		$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$image_alt = filter_input(INPUT_POST, 'image_alt', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$query = "INSERT INTO book_inventory (title, author, description, genre, stock, price, image_alt, image) VALUES (:title, :author, :description, :genre, :stock, :price, :image_alt, :image)";
		$statement = $db -> prepare($query);
		$statement->bindValue(':title', $title);
		$statement->bindValue(':author', $author);
		$statement->bindValue(':description', $description);
		$statement->bindValue(':genre', $genre);
		$statement->bindValue(':stock', $stock);
		$statement->bindValue(':price', $price);
		$statement->bindValue(':image_alt', $image_alt);
		$statement->bindValue(':image', $image);
		$statement->execute();

		header("Location: inventory.php");
		exit;
	}
	else if($_POST && (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['description']) || empty($_POST['genre']) || empty($_POST['stock']) || empty($_POST['price']) || empty($_POST['image_alt'])))
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
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="login.php">Account</a></li>
                <li><a href="inventory.php">Inventory</a></li>
            </ul>
        </nav>
	</header>
	<main id="contact">
		<div id="contact_info">
			<?php if ($id): ?>
				<form method="post" action="post.php" enctype="multipart/form-data">
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

						<p><label for="image">Image - jpgs & pngs only</label>
						<input type="file" id="image" name="image"></p>

						<p><label for="image_alt">Image Alt</label>
						<input id="image_alt" name="image_alt"></p>
					</fieldset>

					<div id="buttons">
						<p><input type="submit" value="Submit"></p>
					</div>
				</form>
			<?php elseif ($error):?>
        		<p>Error number: <?= $_FILES['image']['error'];?></p>
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
				<li><a href="login.php">Account</a></li>
                <li><a href="inventory.php">Inventory</a></li>
			</ul>
		</nav>
		
		<p id="border">328 Falcon Lake, Manitoba, Canada</p>
		<p>© Copyright 2024 Hayley Peters</p>
	</footer>
</body>
<?php

	require('connect.php');
	require('authenticate.php');
	require '\XAMPP\htdocs\Web_Dev_2\Module 6\Project\hpeters3.github.io\php-image-resize-master\lib\ImageResize.php';
	require '\XAMPP\htdocs\Web_Dev_2\Module 6\Project\hpeters3.github.io\php-image-resize-master\lib\ImageResizeException.php';

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT id FROM book_inventory WHERE id =:id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();
	$exists = $statement->rowCount() > 0;
	$display = true;

	if(isset($_POST['delete']))
	{
		if(isset($_POST['delete_image']))
		{
			$local_image = $_POST['delete_image'];
			unlink($local_image);
		}

		$id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
		$query = "DELETE FROM book_inventory WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		header("Location: inventory.php");
		exit;
	}
	else if (isset($_POST['delete_image']))
	{
		$local_image = $_POST['delete_image'];
		unlink($local_image);

		$image = $_POST['delete_image'];
		$query = "UPDATE book_inventory SET image = NULL WHERE image = :image";
		$statement = $db->prepare($query);
		$statement->bindValue(':image', $image, PDO::PARAM_LOB);
		$statement->execute();

		header("Location: inventory.php");
		exit;
	}
	else if($_POST && (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['description']) || empty($_POST['genre']) || empty($_POST['stock']) || empty($_POST['price']) || empty($_POST['image_alt'])))
	{
		$display = false;
	}
	else if($_POST && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['genre']) && isset($_POST['stock']) && isset($_POST['price']) && isset($_POST['id']) && isset($_POST['image_alt']))
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
		elseif(!$uploads)
		{
			$image = $_POST['current_image'];
		}

		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT);
		$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$image_alt = filter_input(INPUT_POST, 'image_alt', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$query = "UPDATE book_inventory SET title = :title, author = :author, description = :description, genre = :genre, stock = :stock, price = :price, image_alt = :image_alt, image = :image WHERE id = :id";
		$statement = $db -> prepare($query);
		$statement->bindValue(':title', $title);
		$statement->bindValue(':author', $author);
		$statement->bindValue(':description', $description);
		$statement->bindValue(':genre', $genre);
		$statement->bindValue(':stock', $stock);
		$statement->bindValue(':price', $price);
		$statement->bindvalue(':image_alt', $image_alt);
		$statement->bindValue(':image', $image);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		header("Location: inventory.php");
		exit;
	}
	else if(isset($_GET['id']) && $exists == true)
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
	<main id="contact">
		<div id="contact_info">
			<?php if($id && $display):?>
				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?= $post['id'] ?>">
					<fieldset>
						<legend>Update Book</legend>
						<p><label for="title">Title</label>
						<input id="title" name="title" value="<?=$post['title']?>"></p>

						<p><label for="author">Author</label>
						<input id="author" name="author" value="<?=$post['author']?>"></p>

						<p><label for="description">Description</label>
						<input id="description" name="description" value="<?=$post['description']?>"></p>

						<p><label for="genre">Genre</label>
						<input id="genre" name="genre" value="<?=$post['genre']?>"></p>

						<p><label for="stock">Stock</label>
						<input id="stock" name="stock" value="<?=$post['stock']?>"></p>

						<p><label for="price">Price</label>
						<input id="price" name="price" value="<?=$post['price']?>"></p>
					</fieldset>

					<fieldset>
						<p><label for="image">Image</label>
						<img src="<?=$post['image']?>">
						<input type="file" id="image" name="image">

						<?php if($post['image']):?>
							<button id="buttons" name="delete_image" value="<?=$post['image']?>">Delete Image</button></p>
						<?php endif?>

						<input type="hidden" name="current_image" value="<?=$post['image']?>">

						<p><label for="image_alt">Image Alt</label>
						<input id="image_alt" name="image_alt" value="<?=$post['image_alt']?>"></p>
					</fieldset>
					<p><input id="buttons" type="submit" value="Update"></p>
				</form>

				<form method="post" id="buttons">
					<input type="hidden" name="delete_image" value="<?=$post['image']?>">
					<button name="delete" value="<?=$post['id']?>">Delete</button>
				</form>
			<?php elseif($display == false):
				echo "Make sure you have something in all the fields.";
			elseif ($error):?>
        		<p>Error number: <?= $_FILES['image']['error'];?></p>
			<?php else:
				header("Location: inventory.php");
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
</html>
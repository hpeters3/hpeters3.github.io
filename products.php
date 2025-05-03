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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Our Selection | Parallel Reads</title>
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

    <main>
        <h2 id="selection">Our selection of special edition books:</h2>

        <div class="filter_container">
            <?php if(isset($_SESSION['user_id'])):?>
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
            <?php endif?>

            <?php if($_POST && isset($_POST['sort_title'])):?>
                <h3>Organizing By Title</h3>
            <?php elseif($_POST && isset($_POST['sort_author'])):?>
                <h3>Organizing By Author</h3>
            <?php elseif($_POST && isset($_POST['sort_price'])):?>
                <h3>Organizing By Price</h3>
            <?php endif?>
        </div>

        <section id="products">
            <?php while($row = $statement->fetch()):?>
                <div>
                    <a href="display.php?id=<?=$row['id']?>">
                        <?php if($row['image']):?>
                            <img src="<?=$row['image']?>" alt="<?=$row['image_alt']?>">
                        <?php endif?>
                        <h4><?=$row['title']?></h4>
                        <p>By <?=$row['author']?></p>
                        <p>Price: $<?=$row['price']?></p>
                    </a>
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
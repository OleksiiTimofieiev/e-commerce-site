<!DOCTYPE html>

<?php
	session_start();

	include("functions/functions.php");
?>

<html>
	<head>
		<title>My Online Shop</title>
		<link rel="stylesheet" href="styles/style.css" media="all" />
	</head>

<body>
	<!-- Main containe strats here -->
	<div class="main_wrapper"> 
		<!-- header start here -->
		<div class="header_wrapper">
			<a href="index.php"><img id="logo" src="images/logo.gif" /></a>
			<img id="banner" src="images/ad_banner.gif" alt="What the fuck is happening here ?" />
		</div>
		<!-- navigation bar starts here -->
		<div class="menubar">
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="all_products.php">All products</a></li>
				<li><a href="customer/my_account.php">My account</a></li>
				<li><a href="#">Sign up</a></li>
				<li><a href="cart.php">Shopping cart</a></li>
				<li><a href="#">Contact Us</a></li>
				<!-- <li><a href="admin_area/insert_product.php">Prod New</a></li>	 -->
			</ul>
			<div id="form">
				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a product">
					<input type="submit" name="search" value="Search">
				</form>
			</div>
		</div>


		<!-- content starts here -->
		<div class="content_wrapper">
			<div id="sidebar">
				<div id="sidebar_title">Categories</div>

				<ul id="cats">
					<?php getCats(); ?>
				</ul>

				<div id="sidebar_title">Brands</div>

				<ul id="cats">
					<?php getBrands(); ?>
				</ul>
			</div>

			<div id="content_area">
				<?php cart(); ?>

				<div id="shopping_cart">
					<span style="float: right; font-size: 18px; padding: 5px; line-height: 45px;">
						<?php
						if (isset($_SESSION['customer_email']))
						{
							echo "<b>Welcome </b>" . $_SESSION['customer_email'] . "<b style = 'color: yellow;'>Your</b>";
						}
						else
						{
							echo "<b>Welcome guest. </b>";
						}

						?>
						<b style="color: yellow;">Shopping Cart</b>
						Total items: <?php total_items(); ?> Total price: <?php total_price(); ?>
						<a href="cart.php" style="color: yellow;">Go to Cart</a>
					</span>
				</div>


				
				<div id = "products_box">
				<?php
					if(!isset($_SESSION['customer_email']))
					{
						include("customer_login.php");
					}
					else
					{
						include("payment.php");	
					}
				?>
				</div>
			</div>
		</div>

	</div>



</body>
</html>
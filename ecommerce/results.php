<!DOCTYPE html>

<?php
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
			<img id="banner" src="ad_banner.gif" alt="What the fuck is happening here ?" />
		</div>
		<!-- navigation bar starts here -->
		<div class="menubar">
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="all_products.php">All products</a></li>
				<li><a href="customer/my_account.php">My account</a></li>
				<li><a href="#">Sign up</a></li>
				<li><a href="#">Shopping cart</a></li>
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
				<div id="shopping_cart">
					<span style="float: right; font-size: 18px; padding: 5px; line-height: 45px;">

						Welcome to the evil hindustyle site. 
						<b style="color: yellow;">Shopping Cart</b>
						Total items: Total price:
						<a href="cart.php" style="color: yellow;">Go to Cart</a>


					</span>
				</div>
				
				<div id = "products_box">
					<?php

					if (isset($_GET['search']))
					{
						$search_query = $_GET['user_query'];

						$get_pro = "select * from products where product_keywords like '%$search_query%'"; //randomly six latest products;

						$run_pro = mysqli_query($con, $get_pro);

						while ($row_pro = mysqli_fetch_array($run_pro))
						{
							$pro_id = $row_pro['product_id'];
							$pro_cat = $row_pro['product_cat'];
							$pro_brand = $row_pro['product_brand'];
							$pro_title = $row_pro['product_title'];
							$pro_price = $row_pro['product_price'];
							$pro_image = $row_pro['product_image'];

							echo "
							<div id='single_product'>
								<h3>$pro_title</h3>
								<img src='admin_area/product_images/$pro_image' width='180' height='180' />
								<p><b> $ $pro_price </b></p>
								<a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
								<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
							</div>
							";
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<div id="footer">
		<h2 style="text-align: center; padding-top: 30px;">&copy; 2018 by otimofie</h2>
	</div>

</body>
</html>
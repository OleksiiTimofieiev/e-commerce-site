<!DOCTYPE html>

<?php
	session_start();
	include("functions/functions.php");
	include("includes/db.php");
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
				<?php cart(); ?>

				<div id="shopping_cart">
					<span style="float: right; font-size: 18px; padding: 5px; line-height: 45px;">
						Welcome to the evil hindustyle site. 
						<b style="color: yellow;">Shopping Cart</b>
						Total items: <?php total_items(); ?> Total price: <?php total_price(); ?>
						<a href="cart.php" style="color: yellow;">Go to Cart</a>
					</span>
				</div>
					<form action="customer_register.php" method="post" enctype="multipart/form-data">
						<table align="center" width="750">
							<tr align="center">
								<td colspan="6"><h2>Create an Account</h2></td>
							</tr>
							<tr>
								<td align="right">Customer Name:</td>
								<td><input type="text" name="c_name"></td>
							</tr>

							<tr>
								<td align="right">Customer Email:</td>
								<td><input type="text" name="c_email"></td>
							</tr>

							<tr>
								<td align="right">Customer Password:</td>
								<td><input type="password" name="c_pass"></td>
							</tr>

							<tr>
								<td align="right">Customer Image:</td>
								<td><input type="file" name="c_image"></td>
							</tr>

							<tr>
								<td align="right">Customer Country:</td>
								<td>
									<select name="c_country">
										<option>Select a country</option>
										<option>Afghanistan</option>
										<option>India</option>
										<option>Japan</option>
										<option>Pakistan</option>
										<option>Israel</option>
										<option>Nepal</option>
										<option>United Arab Emirates</option>
										<option>USA</option>
										<option>UK</option>
									</select>
								</td>
							</tr>

							<tr>
								<td align="right">Customer City:</td>
								<td><input type="text" name="c_city"></td>
							</tr>

							<tr>
								<td align="right">Customer Contact:</td>
								<td><input type="text" name="c_contact"></td>
							</tr>

							<tr>
								<td align="right">Customer Address:</td>
								<td><input type="text" name="c_address"></td>
							</tr>

							<tr align="center">
								<td colspan="6"><input type="submit" name="register" value="Create Account"></td>
							</tr>

						</table>
					</form>		
				</div>
			</div>
		</div>

	<div id="footer">
		<h2 style="text-align: center; padding-top: 30px;">&copy; 2018 by otimofie</h2>
	</div>
	</div>

</body>
</html>

<?php
	if (isset($_POST['register']))
	{
		$ip = getIp();

		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];

		move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

		$insert_c = "insert into customers (customer_ip, customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";

		$run_c = mysqli_query($con, $insert_c);

		$sel_cart = "select * from cart where ip_add='$ip'";

		$run_cart = mysqli_query($con, $sel_cart);

		$check_cart = mysqli_num_rows($run_cart);

		if ($check_cart == 0)
		{
			$_SESSION['customer_email'] = $c_email;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('customer_account.php', '_self')</script>";
		}
		else
		{
			$_SESSION['customer_email'] = $c_email;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('checkout.php', '_self')</script>";	
		}
	}
?>
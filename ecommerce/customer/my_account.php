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
			<a href="../index.php"><img id="logo" src="images/logo.gif" /></a>
			<img id="banner" src="images/ad_banner.gif" alt="What the fuck is happening here ?" />
		</div>
		<!-- navigation bar starts here -->
		<div class="menubar">
			<ul id="menu">
				<li><a href="../index.php">Home</a></li>
				<li><a href="../all_products.php">All products</a></li>
				<li><a href="my_account.php">My account</a></li>
				<!-- <li><a href="../checkout.php">Sign up</a></li> -->
				<li><a href="../cart.php">Shopping cart</a></li>
				<li><a href="#">Contact Us</a></li>
				<!-- <li><a href="admin_area/insert_product.php">Prod New</a></li>	 -->
			</ul>
			<div id="form">
				<form method="get" action="../results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a product">
					<input type="submit" name="search" value="Search">
				</form>
			</div>
		</div>


		<!-- content starts here -->
		<div class="content_wrapper">
			<div id="sidebar">
				<div id="sidebar_title">My account</div>

				<ul id="cats">
					<?php
						$user = $_SESSION['customer_email'];

						$get_img = "select * from customers where customer_email='$user'";

						$run_img = mysqli_query($con, $get_img);

						$row_img = mysqli_fetch_array($run_img);

						$c_image = $row_img['customer_image'];

						$c_name = $row_img['customer_name'];

						echo "<p style='text-align:center; border='2px solid white'><img src='customer_images/$c_image' width='150' height ='150'/></p>";
					?>
					<!-- <li><a href="my_account.php?my_orders">My orders</li> -->
					<!-- <li><a href="my_account.php?edit_account">Edit account</li> -->
					<!-- <li><a href="my_account.php?change_pass">Change password</li> -->
					<li><a href="my_account.php?delete_account">Delete acccount</li>

				</ul>
			</div>

				

			<div id="content_area">
				
				<div id = "products_box">
<!-- 					<?php
						if (!isset($_GET['my_orders'])) 
						{
							if (!isset($_GET['edit_account'])) 
							{
								if (!isset($_GET['change_pass'])) 
								{
									if (!isset($_GET['delete_account'])) 
									{
										echo "<h2 style='padding: 20px;'>Welcome <?php echo '$c_name' ?></h2><br>";
										// echo "<b>You can see your orders by clicking this <a href='my_account.php?my_orders'>link</a></b>";
									}
								}
							}
						}
					?> -->
					<?php
						if(isset($_GET['edit_account']))
						{
							include("edit_account.php");
						}
					?>

				</div>

				<div id="shopping_cart">
					<span style="float: right; font-size: 15px; padding: 5px; line-height: 45px;">
			<!-- 			<?php
						if (isset($_SESSION['customer_email']))
						{
							echo "<b>Welcome  </b>" . $_SESSION['customer_email'];
						}
						

						?> -->
						
						<?php
							if (!isset($_SESSION['customer_email']))
							{
								echo "<a href='../checkout.php' style='color: orange;'>Login</a>";
							}
							else
							{
								echo "<a href='logout.php' style='color: orange;'>Logout</a>";;
							}
						?>
						<?php 
						if (isset($_GET['delete_account']))
						{
							include("delete_account.php");
						}
						?>
					</span>
				</div>
			</div>
		</div>
	</div>

	</div>



</body>
</html>
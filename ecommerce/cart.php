<!DOCTYPE html>

<?php
	// session_start();
	include("functions/functions.php");

?>

<html style="background-color: skyblue;">
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
				<!-- <li><a href="checkout.php">Sign up</a></li> -->
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
						<a href="index.php" style="color: yellow;">Back to shop</a>
						<?php
						if (!isset($_SESSION['customer_email']))
						{
							echo "<a href='checkout.php' style='color: orange;'>Login</a>";
						}
						else
						{
							echo "<a href='logout.php' style='color: orange;'>Logout</a>";
						}
						?>
					</span>
				</div>


				
				<div id = "products_box">
					<br>
					<form action="" method="post" enctype="multipart/form-data">
						<table align="center" width="700" bgcolor="skyblue">
							<tr align="center">
								<th>Remove</th>
								<th>Products</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Subtotal</th>
							</tr>

				<?php

					$total = 0;

					global $con;

					$ip = getIp();

					$sel_price = "SELECT c.p_id, c.qty, p.product_title, p.product_price, c.qty * p.product_price as subtotal
								FROM cart c
								LEFT JOIN products p ON c.p_id = p.product_id
								WHERE c.ip_add = '::1'";

					$run_price = mysqli_query($con, $sel_price);
					
					
					while ($row = mysqli_fetch_array($run_price))
					{
						
						$qty = $row['qty'];
						$product_title = $row['product_title'];
						$product_price = $row['product_price'];
						$subtotal = $row['subtotal'];
						if ($_POST[$row['p_id']])
						{
							$sql = "delete from cart where p_id = ".$_POST[$row['p_id']];
							echo  $sql;;
							mysqli_query($con, $sql);
							echo "<script>window.open('cart.php', '_self')</script>";
							continue ;
						}
						

						echo "<tr align='center'><td><form action='cart.php' method='post'><button type='submit' name='".$row['p_id']."' value='".$row['p_id']."'>X</button></form></td>";
						echo "<td>".$product_title."</td>";
						echo "<td>".$qty."</td>";
						echo "<td>".$product_price."</td>";
						echo "<td>".$subtotal."</td></tr>";
					}
				?>
								
								
							
							<!-- <tr align=""> -->
								<!-- <td colspan="4"><b>Sub total: </b></td> -->
								<!-- <td><?php /*echo "$" . $total;*/?></td> -->
							<!-- </tr> -->
							<tr float="right">
								<!-- <td colspan="2"><input type="submit" name="update_cart" value="Update_cart"></td> -->
								<td><input type="submit" name="continue" value="continue_shopping"></td>
								<td><button><a href="checkout.php" style="text-decoration: none; color: black;">Checkout</a></button></td>
							</tr>
						</table>

					</form>
					<?php
					function updatecart()
					{
						global $con;

						$ip = getIp();

						if(isset($_POST['update_cart']))
						{
							foreach ($_POST['remove'] as $remove_id) 
							{
								$delete_product = "delete from cart where p_id='$remove_id' AND  ip_add='$ip'";

								$run_delete = mysqli_query($con, $delete_product);

								if ($run_delete)
								{
									echo "<script>window.open('cart.php', '_self')</script>";
								}
							}
						}
						if(isset($_POST['continue']))
						{
							echo "<script>window.open('index.php', '_self')</script>";

						}
					}
						echo @$up_cart = updatecart();
					?>

				</div>
			</div>
		</div>





</body>
</html>
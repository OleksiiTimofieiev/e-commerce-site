<!DOCTYPE html>
<?php
	include("includes/db.php"); //establish a connection;
?>
<html>
<head>
	<title>Inserting product</title>
</head>
<body bgcolor="skyblue">
	<form action="insert_product.php" method="post" enctype="multipart/form-data">
		<table align="center" width="795" border="2" bgcolor="orange">
			<tr align="center">
				<td colspan="7"><h2>Insert New Post Here :)</h2></td>
			</tr>

			<tr>
				<td align="right"><b>Product title:</b></td>
				<td><input type="text" name="product_title" size="60" /></td>
			</tr>

			<tr>
				<td align="right"><b>Product category:</b></td>
				<td>
					<select name="product_cat">
					<option>Select category</option>
					<?php
					$get_cats = "select * from categories";
					$run_cats = mysqli_query($con, $get_cats);
					while ($row_cats = mysqli_fetch_array($run_cats)) //read line by line;
					{
						$cat_id = $row_cats['cat_id'];
						$cat_title = $row_cats['cat_title'];
						echo "<option value='$cat_id'>$cat_title</option>";
					}
					?>
					</select>
				</td>
			</tr>

			<tr>
				<td align="right"><b>Product brand:</b></td>
				<td>
					<select name="product_brand">
					<option>Select category</option>
					<?php
					$get_brands = "select * from brands";

					$run_brands = mysqli_query($con, $get_brands);

					while ($row_brands = mysqli_fetch_array($run_brands)) //read line by line;
					{
						$brand_id = $row_brands['brand_id'];
						$brand_title = $row_brands['brand_title'];
						echo "<option value='$brand_id'>$brand_title</option>";
					}
					?>
					</select>
				</td>
			</tr>

			<tr>
				<td align="right"><b>Product image:</b></td>
				<td><input type="file" name="product_image"/></td>
			</tr>

			<tr>
				<td align="right"><b>Product price:</b></td>
				<td><input type="text" name="product_price"/></td>
			</tr>

			<tr>
				<td align="right"><b>Product description:</b></td>
				<td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
			</tr>

			<tr>
				<td align="right"><b>Product keywords:</b></td>
				<td><input type="text" name="product_keywords" size="50" /></td>
			</tr>

			<tr align="center">
				<td colspan="7"><input type="submit" name="insert_post" value="Insert NOW" /></td>
			</tr>


		</table>
	</form>
			<hr>
			<a style="text-align:center;" href="../index.php"><b>Home sweet alabama</b></a>
</body>
</html>

<?php
	if (isset($_POST['insert_post'])) // isset-> if active, POST = predifined variable;
	{
		//getting the text data from the fields
		$product_title = $_POST['product_title'];
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords= $_POST['product_keywords'];

		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];


		// upload an image; //set the same rights to the corresponding folders;
		move_uploaded_file($product_image_tmp, "product_images/$product_image");

		// upload to database;
		$insert_product = "insert into products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords) values ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";

		$insert_pro = mysqli_query($con, $insert_product);

		if ($insert_pro)
		{
			echo "<script>alert('Product is inserted')</script>";
			echo "<script>window.open('index.php?insert_product', '_self')</script>";
		}
	}

?>
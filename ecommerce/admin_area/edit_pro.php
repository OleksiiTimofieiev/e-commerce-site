<!DOCTYPE html>
<?php
	include("includes/db.php"); //establish a connection;
	if(isset($_GET['edit_pro']))
	{
		$get_id = $_GET['edit_pro'];

		$get_product = "select * from products where product_id='$get_id'";

		$run_pro = mysqli_query($con, $get_product);

		$row_pro = mysqli_fetch_array($run_pro);

		$pro_id = $row_pro['product_id'];
		$pro_title = $row_pro['product_title'];
		$pro_image = $row_pro['product_image'];
		$pro_price = $row_pro['product_price'];
		$pro_desc = $row_pro['product_desc'];
		$pro_keywords = $row_pro['product_keywords'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];

		$get_cat = "select * from categories where cat_id='$pro_cat'";

		$run_cat = mysqli_query($con, $get_cat);

		$row_cat = mysqli_fetch_array($run_cat);

		$category_title = $row_cat['cat_title'];

		$get_brand = "select * from brands where brand_id='$pro_brand'";

		$run_brand = mysqli_query($con, $get_brand);

		$row_brand = mysqli_fetch_array($run_brand);

		$brand_title = $row_brand['brand_title'];
	}
?>
<html>
<head>
	<title>Update Product</title>
</head>
<body bgcolor="skyblue">
	<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="795" border="2" bgcolor="orange">
			<tr align="center">
				<td colspan="7"><h2>Edit & Update Product</h2></td>
			</tr>

			<tr>
				<td align="right"><b>Product title:</b></td>
				<td><input type="text" name="product_title" size="60" value="<?php echo $pro_title; ?>" /></td>
			</tr>

			<tr>
				<td align="right"><b>Product category:</b></td>
				<td>
					<select name="product_cat">
					<option>"<?php echo $category_title; ?>"</option>
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
					<option>"<?php echo $brand_title; ?>"</option>
					<?php
					$get_brands = "select * from brands";

					$run_brands = mysqli_query($con, $get_brands);

					while ($row_brands = mysqli_fetch_array($run_brands)) //read line by line the array;
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
				<td><input type="file" name="product_image"/><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60"></td>
			</tr>

			<tr>
				<td align="right"><b>Product price:</b></td>
				<td><input type="text" name="product_price" value="<?php echo $pro_price; ?>" /></td>
			</tr>

			<tr>
				<td align="right"><b>Product description:</b></td>
				<td><textarea name="product_desc" cols="20" rows="10"><?php echo $pro_desc; ?></textarea></td>
			</tr>

			<tr>
				<td align="right"><b>Product keywords:</b></td>
				<td><input type="text" name="product_keywords" size="50" value="<?php echo $pro_keywords; ?>" /></td>
			</tr>

			<tr align="center">
				<td colspan="7"><input type="submit" name="update_product" value="Update Product" /></td>
			</tr>


		</table>
	</form>
			<hr>
			<a style="text-align:center;" href="../index.php"><b>Home sweet alabama</b></a>
</body>
</html>

<?php
	if (isset($_POST['update_product'])) // isset-> if active, POST = predifined variable;
	{
		//getting the text data from the fields

		$update_id = $pro_id;
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
		$update_product = "update products set product_cat='$product_cat', product_brand='$product_brand', product_title='$product_title', product_price='$product_price', product_desc='$product_desc', product_image='$product_image', product_keywords='$product_keywords' where product_id='$update_id'";

		$run_product = mysqli_query($con, $update_product);

		if ($run_pro)
		{
			echo "<script>alert('Product has been updated')</script>";
			echo "<script>window.open('index.php?view_products', '_self')</script>";
		}
	}

?>
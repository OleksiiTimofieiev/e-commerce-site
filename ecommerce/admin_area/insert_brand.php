<form action ="" method="post" style="padding: 40px">
	<b>Insert New Brand:</b>
	<input type="text" name="new_brand" >
	<input type="submit" name="add_brand" value="Add brand" required>
</form>

<?php
	include("includes/db.php");

	if(isset($_POST['add_brand']))
	{
		$new_brand = $_POST['new_brand'];

		$insert_brand = "insert into brands (brand_title) values ('$new_brand')";

		$run_brand = mysqli_query($con, $insert_brand);

		if($run_brand)
		{
			echo "<script>alert('New brand has been inserted.')</script>";
			echo "<script>window.open('index.php?view_brands')</script>";
		}
	}

?>
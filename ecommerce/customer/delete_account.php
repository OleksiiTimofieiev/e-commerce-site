<br>

<h2 style="text-align: center; color: orange;">Do you really want to delete your account ??? </h2>

<form action="" method="post">
	<br><br>
	<input type="submit" name="yes" value="yes, i want"  style="float: left;">
	<input type="submit" name="no" value="no, i was joking" style="float: right;">
</form>

<?php
	include("includes/db.php");

	$user = $_SESSION['customer_email'];

	if (isset($_POST['yes']))
	{
		$delete_customer = "delete from customers where customer_email='$user'";

		$run_customer = mysqli_query($con, $delete_customer);

		echo "<script>alert('Your account has been deleted!')</script>";
		echo "<script>window.open('../index.php', '_self')</script>";
	}
	if (isset($_POST['no']))
	{

		echo "<script>alert('oh! do not joke again!')</script>";
		echo "<script>window.open('my_account.php', '_self')</script>";
	}




?>
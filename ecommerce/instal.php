<!DOCTYPE html>
<html>
<head>
	<title>Instal</title>
	<style>
		input[type=text], input[type=password] {
			width: 300px;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		input[type=text]{
			background-color: #bbd5db;
		}

		input[type=submit] {
			width: 300px;
			background-color: #4b7d8d;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type=submit]:hover {
			background-color: #1f4752;
		}

		form {
			margin: 0 auto;
			width: 300px;
			text-align: center;
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
		}
</style>
</head>
<body>
	<form method="get" action="instal.php">
		<h3>Input installation data</h3>
		<input type="text" placeholder="localhost" readonly=""><br>
		<input type="text" placeholder="root" readonly=""><br>
		<input type="text" placeholder="ecommerce" readonly=""><br>
		<input type="password" name="password" placeholder="Enter password" required=""><br>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>


<?php

	if ($_GET['submit'] == "Submit")
	{
		$password = $_GET['password'];
		$con = mysqli_connect("localhost", "root", "123456");
		if (!$con || $password !== "123456")
		{
			echo "<br><b>ERROR: Wrong connection data</b><br>";
			exit ();
		}

		$sql = "CREATE DATABASE IF NOT EXISTS ecommerce";
		if (mysqli_query($con, $sql)) {

			echo "<br><b>Database 'ecommerce' was successfully created</b><br>";
		}
		else {
			echo "<br><b>Error creating database</b><br>";
			exit ();
		}

		
		$con = mysqli_connect("localhost", "root", "123456", "ecommerce");
		mysqli_set_charset($con, 'utf8');
		if (!$con)
		{
			exit('Connect Error (' . mysqli_connect_errno() . ') '
				   . mysqli_connect_error());
		}
		mysqli_set_charset($con, 'utf-8');
		mysqli_select_db($con, $file['db']);

		$sql = file_get_contents('ecommerce.sql');
		if (mysqli_multi_query($con, $sql)) {
			echo "<br><b>Tables was successfully created</b><br>";
		}
		else {
			echo "<br><b>Error creating tables</b><br>";
			exit ();
		}
		


		




		// SHOW TABLES FROM 
		// $sql = "SHOW TABLES FROM ".$db;
		// while ($row = mysql_fetch_row(mysqli_query($con, $sql))) {
		// 	echo $row['Tables_in_mysql'];
		// }

		// $sql = "CREATE TABLE IF NOT EXISTS `cart` (`p_id` int(10) NOT NULL, `ip_add` varchar(255) NOT NULL, `qty` int(10) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		// if (mysqli_query($con, $sql)) {
		// 	echo "<b>SUCCESS: ".$sql."</b><br>";
		// }
		// else {
		// 	echo "<b>ERROR: ".$sql."</b><br>";
		// }

		// $sql = "INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES (8, '::1', 888888);";
		// if (mysqli_query($con, $sql)) {
		// 	echo "SUCCESS: ".$sql."<br>";
		// }
		// else {
		// 	echo "<b>ERROR: ".$sql."</b><br>";
		// }


		// $sql = "INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES (8, '::fdfdf1', 8888fff88);";
		// if (mysqli_query($con, $sql)) {
		// 	echo "SUCCESS: ".$sql."<br>";
		// }
		// else {
		// 	echo "<b>ERROR: ".$sql."</b><br>";
		// }
	}

?>




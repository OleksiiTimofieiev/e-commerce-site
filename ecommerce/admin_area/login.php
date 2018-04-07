<?php

	session_start();

?>
<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" href="styles/login_style.css">
<title>Login Form</title>
</head>

<body>

<div class="login">
	<h2 style="color: white; text-align: center;"><?php echo @$_GET['not_admin']; ?></h2>
	<h2 style="color: white; text-align: center;"><?php echo @$_GET['logged_out']; ?></h2>

	<h1>Admin Login</h1>
    <form method="post" action="login.php">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Login</button>
    </form>
</div>
</body>
</html>

<?php

	include("includes/db.php");

	if (isset($_POST['login']))
	{
		$email = $_POST['email']; //avoid injection;
		$pass = $_POST['password']; //avoid injection;

		$sel_user = "select * from admins where user_email='$email' AND user_pass='$pass'";

		$run_user= mysqli_query($con, $sel_user);

		$check_user = mysqli_num_rows($run_user);

		if ($check_user == 1) //user is not in the table;
		{
			$_SESSION['user_email'] = $email;
			echo "<script>window.open('index.php?logged_in=You have successfully logged in!','_self')</script>";

		}
		else
		{
			echo "<script>alert('Password or email is wrong. Try again.')</script>";
		}

	}
?>
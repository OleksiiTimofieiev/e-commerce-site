<table width="795" align="center" bgcolor="pink">
	<tr align="center">
		<td colspan="6"><h2>View All Orders Here</h2></td>
	</tr>

	<tr align="center" bgcolor="skyblue">
		<th>User</th>
		<th>Order ID</th>
		<th>Product Title</th>
	</tr>

	<?php
		include("includes/db.php");

		$get_cart = "select * from test";

		$run_cart = mysqli_query($con, $get_cart);

		$i = 0;

		while ($row_cart = mysqli_fetch_array($run_cart))
		{
			$ip = $row_cart['ip'];
			$dt = $row_cart['dt'];
			$name = $row_cart['name'];

			$i++;		
	?>

	<tr align="center">
		<td><?php echo $ip?></td>
		<td><?php echo $dt?></td>
		<td><?php echo $name?></td>

	</tr>
	<?php } ?>











</table>
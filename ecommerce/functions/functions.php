<?php

// establish a connection;
$con = mysqli_connect("localhost","root","123456","ecommerce");

function getIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}


function cart()
{
	// echo "start";

	// echo $_GET['add_cart'];
	$number = $_POST['number']; //

	// echo $number;

	if (isset($_GET['add_cart']))
	{
		// echo "test1";

		global $con;

		$ip = getIp();

		$pro_id = $_GET['add_cart'];

		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";

		$run_check = mysqli_query($con, $check_pro);

		// echo "test2";

		if (mysqli_num_rows($run_check) > 0)
		{
			// echo "test3";
			echo "";
		}
		else
		{
			// echo "test4";

			$insert_pro = "insert into cart (p_id, ip_add, qty) values ('$pro_id','$ip', $number)";

			// echo $insert_pro;
			$run_pro = mysqli_query($con, $insert_pro);

			echo "<script>window.open('index.php', '_self')</script>";
			// echo "test5";
		}
	}
	// echo "test6";
}

function total_items()
{
	if(isset($_GET))
	{
		global $con;

		$ip = getIp();

		$get_items = "select sum(qty) sum from cart where ip_add = '$ip'";
	}
	else
	{
		global $con;

		$ip = getIp();

		$get_items = "select sum(qty) sum from cart where ip_add = '$ip'";
	}

	$run_items = mysqli_query($con, $get_items);
	$row = mysqli_fetch_array($run_items);
	$count_items = $row['sum'];
	echo $count_items;
}

function total_price()
{
	$total = 0;

	global $con;

	$ip = getIp();

	$sel_price = "SELECT SUM(c.qty * p.product_price) sum
					FROM cart c
					LEFT JOIN products p ON c.p_id = p.product_id 
					WHERE c.ip_add = '$ip'";

	$run_price = mysqli_query($con, $sel_price);
	$row = mysqli_fetch_array($run_price);
	$total = $row['sum'];
	echo "$" . $total;

}

function getCats()
{
	global $con;

	$get_cats = "select * from categories";

	$run_cats = mysqli_query($con, $get_cats);

	while ($row_cats = mysqli_fetch_array($run_cats)) //read line by line;
	{
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}


function getBrands()
{
	global $con;
	
	$get_brands = "select * from brands";

	$run_brands = mysqli_query($con, $get_brands);

	while ($row_brands = mysqli_fetch_array($run_brands)) //read line by line;
	{
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];

		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}

function getPro()
{
	if (!isset($_GET['cat']))
	{
		if (!isset($_GET['brand']))
		{
			global $con;

			$get_pro = "select * from products order by RAND() LIMIT 0,6"; //randomly six latest products;

			$run_pro = mysqli_query($con, $get_pro);

			while ($row_pro = mysqli_fetch_array($run_pro))
			{
				$pro_id = $row_pro['product_id'];
				$pro_cat = $row_pro['product_cat'];
				$pro_brand = $row_pro['product_brand'];
				$pro_title = $row_pro['product_title'];
				$pro_price = $row_pro['product_price'];
				$pro_image = $row_pro['product_image'];

				echo "
				<form method='post' action='index.php?add_cart=$pro_id'>
				<div id='single_product'>
					<h3>$pro_title</h3>
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					<p><b>Price: $ $pro_price </b></p>
					<a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
					<input type='number' name='number' step='1' min='1' value='1' style='width: 30px; height: 10px;'>
					<a><button style='float:right'>Add to cart</button></a>
				</div>
				</form>
				";
			}
		}
	}
}

function getCatPro()
{
	if (isset($_GET['cat']))
	{
		$cat_id = $_GET['cat'];

		global $con;

		$get_cat_pro = "select * from products where product_cat='$cat_id'"; //randomly six latest products;

		$run_cat_pro = mysqli_query($con, $get_cat_pro);

		$count_cats = mysqli_num_rows($run_cat_pro);

		if ($count_cats == 0)
		{
			echo "<h2 style='padding:20px;'>There are no products in this category.</h2>";
			exit();
		}
		else
		{
			while ($row_cat_pro = mysqli_fetch_array($run_cat_pro))
			{
				$pro_id = $row_cat_pro['product_id'];
				$pro_cat = $row_cat_pro['product_cat'];
				$pro_brand = $row_cat_pro['product_brand'];
				$pro_title = $row_cat_pro['product_title'];
				$pro_price = $row_cat_pro['product_price'];
				$pro_image = $row_cat_pro['product_image'];

				echo "
				<div id='single_product'>
					<h3>$pro_title</h3>
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					<p><b> $ $pro_price </b></p>
					<a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
				</div>
				";
			}
		}
	}
}


function getBrandPro()
{
	if (isset($_GET['brand']))
	{
		$brand_id = $_GET['brand'];

		global $con;

		$get_brand_pro = "select * from products where product_brand='$brand_id'"; //randomly six latest products;

		$run_brand_pro = mysqli_query($con, $get_brand_pro);

		$count_brands = mysqli_num_rows($run_brand_pro);

		if ($count_brands == 0)
		{
			echo "<h2 style='padding:20px;'>There are no products in this brandegory.</h2>";
			exit();
		}
		else
		{
			while ($row_brand_pro = mysqli_fetch_array($run_brand_pro))
			{
				$pro_id = $row_brand_pro['product_id'];
				$pro_cat = $row_brand_pro['product_brand'];
				$pro_brand = $row_brand_pro['product_brand'];
				$pro_title = $row_brand_pro['product_title'];
				$pro_price = $row_brand_pro['product_price'];
				$pro_image = $row_brand_pro['product_image'];

				echo "
				<div id='single_product'>
					<h3>$pro_title</h3>
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					<p><b> $ $pro_price </b></p>
					<a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
				</div>
				";
			}
		}
	}
}


?>
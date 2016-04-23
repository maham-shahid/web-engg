<?php

		//  ****  This php file is used for adding products to db ; only 1 can be added at a time. ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

	session_start();  //start session for this page
	if(isset($_SESSION["admin"]))  //if admin is logged in, proceed
	{
		if(time()>$_SESSION["time"]+30)  //checking if session time has expired -> redirect to logout
			header("Location:logout.php");
		else
			$_SESSION["time"]=time();  //otherwise update the session time

		// if POST varibles set, take values.
		if(isset($_POST["prod_name"]))
		{
			$name=$_POST["prod_name"];
		}
		else
		{
			$name=NULL;
		}

		if(isset($_POST["quant"]))
		{
			$quantity=$_POST["quant"];
		}
		else
		{
			$quantity=NULL;
		}

		if(isset($_POST["price"]))
		{
			$price=$_POST["price"];
		}
		else
		{
			$price=NULL;
		}

		if(isset($_POST["cat"]))
		{
			$category=$_POST["cat"];
		}
		else
		{
			$category=NULL;
		}

		if(isset($_POST["img"]))
		{
			$image=$_POST["img"];
		}
		else
		{
			$image=NULL;
		}

		//connect to db
		$db=mysqli_connect("localhost","root","","products");
		if(!$db)
			echo "Error encountered!";
		else
		{
			// prepare query
			$query=mysqli_prepare($db,"INSERT into product_info (Prod_Name,Category,Price,Quantity,Image) VALUES (?,?,?,?,?)");
			// bind parameters			
			$query->bind_param('ssiis',$name,$category,$price,$quantity,$image);
			// run query
			$result=$query->execute();
			if($result)
			{
				echo "<!--Product inserted! -->";
			}
			else
			{
				echo "<!--Error inserting product-->";
			}
			$query->close();
		}
	}
	else
	{
		header("Location: login.html");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Products </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<style type="text/css">
	input
	{
		margin-bottom: 3%;
	}
	span
	{
		font-weight: bold;
		color:#2C3E50;
	}
</style>

<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-2"></div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<h2 class="text-center"> Add Product to Inventory </h2>
				<hr><br/>
				<!-- simple form to input product details; sends data to itself; POST request  -->
				<form action="addProduct.php" method="post">
					<span>Product Name:</span><input type="text" class="form-control" name="prod_name" placeholder="Adobe After Effects" required>
					<span>Quantity:</span><input type="number" class="form-control" name="quant" placeholder="12" required>
					<span>Price in $:</span><input type="number" class="form-control" name="price" placeholder="350" required>
					<span>Category:</span><input type="text" class="form-control" name="cat" placeholder="Motion Graphics">
					<span>Image Link:</span><input type="text" class="form-control" name="img" placeholder="http://bit.ly/11voqpK">
					<input type="submit" class="btn btn-success" value="Add to Database">
					<a href="adminPanel.php" class="btn btn-primary">Go Back </a>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2"></div>
		</div>
	</div>
</body>

</html>
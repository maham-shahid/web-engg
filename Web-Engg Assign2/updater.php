<?php

		//  ****  This php file is for updating product details in the db ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

	session_start(); //start session for this page
	if(isset($_SESSION["admin"]))  //if admin is logged in, proceed
	{
		// checking if POST variables are set
		if(isset($_POST["id"]) && isset($_POST["prod_name"]) && isset($_POST["quant"]) && isset($_POST["price"]) && isset($_POST["cat"]) && isset($_POST["img"]))
		{
			// get values sent by the form
			$id=$_POST["id"];
			$name=$_POST["prod_name"];
			$quantity=$_POST["quant"];
			$price=$_POST["price"];
			$category=$_POST["cat"];
			$img=$_POST["img"];
			// connect to db
			$db=mysqli_connect("localhost","root","","products");
			if($db)
			{
				// prepare update query
				$query=mysqli_prepare($db,"UPDATE product_info SET prod_name=?,category=?,price=?,quantity=?,image=? WHERE prod_id=?");
				// bind parameters with query
				$query->bind_param('ssiisi',$name,$category,$price,$quantity,$img,$id);
				$result=$query->execute();
				if($result)
					header("Location:updateProduct.php");
				else
				{
					echo "update failed";
					header("Location:updateProduct.php");
				}
			}
			else
				echo "Error connecting to DB";
		}
		else
		{
			// if POST variables not set, all these variables will be null and product details won't be updated
			$id=NULL;
			$name=NULL;
			$quantity=NULL;
			$price=NULL;
			$category=NULL;
			$img=NULL;
		}
	}
	else
		header("Location: login.html")
?>
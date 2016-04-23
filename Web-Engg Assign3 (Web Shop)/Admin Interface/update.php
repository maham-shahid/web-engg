<?php

		//  ****  This php file is used to return all the information about the product whose id is sent to this script. ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

	session_start(); //start session for this page
	if(isset($_SESSION["admin"]))  //if admin is logged in, proceed
	{
		// checking if POST variable is set
		if(isset($_POST["data"]))
		{
			$idSent=$_POST["data"];
			// connect to db
			$db=mysqli_connect("localhost","root","","products");
			if($db)
			{
				// echo "Db connection successful";
				// retrieve all details from db where product id is the one sent to this page
				$query=mysqli_prepare($db,"SELECT * FROM product_info WHERE prod_id=?");
				$query->bind_param('i',$idSent);
				$result=$query->execute();
				// binding results with corresponding variables
				$query->bind_result($id,$name,$category,$price,$quantity,$image_url);
				// storing all results retrieved in json form in $details to send back to updateProduct.php
				while($query->fetch())
				{
					$details["id"]=$id;
					$details["name"]=$name;
					$details["cat"]=$category;
					$details["price"]=$price;
					$details["quant"]=$quantity;
					$details["img"]=$image_url;
					// this echo statment causes data to be sent back to the ajax request
					echo json_encode($details);
				}
			}
			else
				echo "Db connection error";
		}
		else
			echo "not set";
	}
	else
		header("Location: login.html");
?>
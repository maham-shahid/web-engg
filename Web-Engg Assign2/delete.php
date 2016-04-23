<?php

		//  ****  This php file is used for deleting the product from database whose id is sent in POST request ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

session_start();  //start session for this page
if(isset($_SESSION["admin"]))  //if admin is logged in, proceed
{
	//checking if POST variable is set
	if(isset($_POST["data"]))
	{
		$id=$_POST["data"];

		//connecting to db
		$db=mysqli_connect("localhost","root","","products");
		if($db)
		{
			// prepare query to delete
			// echo "Db connection successful";
			$query=mysqli_prepare($db,"DELETE FROM product_info WHERE prod_id IN (?)");
			// bind id with the query
			$query->bind_param('i',$id);
			$result=$query->execute();
			if($result){}
				//echo $_POST["data"];
				// echo "Deleted successfully";
			else
				echo "Error in deletion of product";
			$query->close();
		}
		else
			echo "Error Connecting to DB";
	}
	else
		echo "POST not set";
}
else
	header("Location: login.html");
?>
<?php

		//  ****  This is the homepage of Admin Interface where admin can see products, add-delete-update products ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

session_start(); //start session for this page
if(isset($_SESSION["admin"]))  //if admin is logged in, proceed
{
	if(time()>$_SESSION["time"]+30) //checking if session time has expired -> redirect to logout
		header("Location:logout.php");
	else  //otherwise update the session time
		$_SESSION["time"]=time();
	$db=mysqli_connect("localhost","root","","products"); //establish connection with database
	if($db)
	{
		// If successful
		// prepare query to get all info from db
		$query=mysqli_prepare($db,"SELECT * FROM product_info");
		$result=$query->execute();		//execute and get results, bind each column value returned to a corresponding variable
		$query->bind_result($id,$name,$category,$price,$quantity,$image_url);
		
		$string='';
		//store all data retrieved from running query into variable string [presentation of this in table form]
		while($query->fetch())
		{
			$string.="<tr>";
			$string.="<td>$id</td>";
			$string.="<td>$name</td>";
			$string.="<td>$category</td>";
			$string.="<td>$price</td>";
			$string.="<td>$quantity</td>";
			$string.="<td>$image_url</td>";
			$string.="</tr>";
		}
	}
	else
		echo "Db connection error";
}
else //otherwise redirect to login page - no access granted
	header("Location: login.html");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	</head>
	<style>
		span
		{
			padding-right: 3%;
			padding-left: 3%;
		}
		div.panel-default
		{
			/*margin-top: 28%;*/
		}
	</style>
	<body>
		<div class="container">
			<div class="row">
				<h2 class="text-center">Product Inventory</h2>
				<hr><br/><br/>
				<!--Area for displaying the table-->
				<div class="col-md-8 col-sm-8 col-lg-8">
					<div class="table-responsive">
						<!-- set up a basic table and add columns, rows and data through php -->
						<table class="table table-bordered table-striped table-hover">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Category</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Image URL</th>
							</tr>
							<?php echo $string ?>
						</table>
					</div>
				</div>
				<!-- **** table display area ended **** -->

				<!-- area to display options available to admin -->
				<div class="col-lg-4 col-md-4 col-sm-4 pull-left">
					<div class="panel panel-default">
  						<div class="panel-heading">Actions</div>
  						<div class="panel-body" align="center">
  						  <a href="addProduct.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-plus"></span>Add Products</a>
  						  <br/>
  						  <a href="updateProduct.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-pencil"></span>Update Products</a>
  						  <br/>
  						  <a href="deleteProduct.php" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-remove"></span>Delete Products</a>
  						  <br/>
  						  <a href="logout.php" class="btn btn- btn-danger">Logout</a>
  						</div>
					</div>
				</div>
				<!-- **** end of options **** -->
			</div>
		</div>
	</body>
</html>
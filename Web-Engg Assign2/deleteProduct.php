<?php
	
		//  ****  This php file is used for deleting products from db ; only 1 can be deleted at a time. ****
		//  ****  This page will let admin select a product to delete and send its id to delete.php to actually delete from the database ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

session_start(); //start session for this page
if(isset($_SESSION["admin"]))  //if admin is logged in, proceed
{
	if(time()>$_SESSION["time"]+30)  //checking if session time has expired -> redirect to logout
		header("Location:logout.php");
	else
		$_SESSION["time"]=time();  //otherwise update the session time

	// connect to database
	$db=mysqli_connect("localhost","root","","products");
	if($db)
	{
		// echo "Db connection successful";
		// select all products
		$query=mysqli_prepare($db,"SELECT * FROM product_info");
		$result=$query->execute();
		$query->bind_result($id,$name,$category,$price,$quantity,$image_url);
		
		// embed all data retrieved into a table and store this in $string
		$string='';
		while($query->fetch())
		{
			$string.="<tr>";
			$string.="<td class='id'>$id</td>";
			$string.="<td>$name</td>";
			$string.="<td>$category</td>";
			$string.="<td>$price</td>";
			$string.="<td>$quantity</td>";
			$string.="<td>$image_url</td>";
			$string.="<td><input type='checkbox' name='check'></td>";
			$string.="</tr>";
		}
	}
	else
		echo "Db connection error";
}
else
	header("Location: login.html");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Delete Products</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	</head>
	<style>
		span
		{
			padding-right: 5%;
			padding-left: 5%;
			margin-right: 2%;
		}
	</style>
	<body>
		<div class="container">
			<div class="row">
				<h2 class="text-center">Delete Products from Inventory</h2>
				<hr><br/><br/>
				<div class="col-md-2 col-sm-2 col-lg-2"></div>
				<div class="col-md-8 col-sm-8 col-lg-8">
				<!-- set up the table headings and add all the data using php - data retrieved from db -->
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Category</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Image URL</th>
								<th>Delete</th>
							</tr>
							<?php echo $string ?>
						</table>
						<!-- control buttons -->
						<div align="center">
							<button id="del" class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>Delete</button>
							<a href="adminPanel.php" class="btn btn-primary">Go Back </a>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-2 col-lg-2"></div>
			</div>
		</div>
	</body>
	<script>
		// on click of button, function is called
		$("#del").click(function(){
			var id;
			// getting id from the table for product which has to be deleted
			$("input:checked").each(function(){
				// select checkboxes that are checked and find their parent of parent (gives us <tr>) and then find the child which has class="id" (class id used in td for displaying id) and get its innerhtml
				id=$(this).parent().parent().children(".id").html();
			});
			// ajax call to server;data that is being sent is the ID of the product to be deleted
			$.ajax({
    			type:'post', //post request
    			url:'delete.php', //url to redirect to
    			data: {data:id}, //data to be sent
    			success: function(data){ //on successful execution, data is the echo statment returned from the server
       			 	$("input:checked").parent().parent().remove();	//remove the row from table
    			}
			});
		});
	</script>
</html>
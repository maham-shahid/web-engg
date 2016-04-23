<?php

		//  ****  This php file is used for selecting products to update. ****
		//  ****  Only 1 product can be updated at a time. It sends ajax request to update.php and form data to updater.php --- See implementation for reason ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

session_start();  //start session for this page
if(isset($_SESSION["admin"]))  //if admin is logged in, proceed
{
	if(time()>$_SESSION["time"]+30)  //checking if session time has expired -> redirect to logout
		header("Location:logout.php");
	else
		$_SESSION["time"]=time();  //otherwise update the session time
	// if(isset($_POST["id"]))
	// {
	// 	$id=$_POST["id"];
	// }
	// databe connection
	$db=mysqli_connect("localhost","root","","products");
	if($db)
	{
		// echo "Db connection successful";
		$query=mysqli_prepare($db,"SELECT * FROM product_info");
		$result=$query->execute();
		$query->bind_result($id,$name,$category,$price,$quantity,$image_url);
		
		$string='';
		// embed all data retrieved into a table and store this in $string
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
		<title>Update Products </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	</head>
	<style type="text/css">
		input
		{
			margin-bottom: 3%;
		}
		h4
		{
			font-weight: bold;
			color:#2574A9;
		}
	</style>

	<body>
		<div class="container">
			<div class="row">
				<h2 class="text-center"> Update Products in Inventory </h2>
				<hr><br/> 
				<div class="col-lg-7 col-md-7 col-sm-7">
					<!-- area to display all products in db and select one for its details to be displayed in form -->
					<h4>Products</h4> <br/>
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
								<th>Edit</th>
							</tr>
							<?php echo $string ?>
						</table>
						<button id="del" class="btn btn-success"><span class="glyphicon glyphicon-pencil" style="margin-right:5%;"></span>Select to Change</button>
					</div>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1"></div>
				<div class="col-lg-4 col-md-4 col-sm-4">
					<h4>Update Details</h4> <br/>
					<!-- update form - sends its values to updater.php as POST request to update in db -->
					<form action="updater.php" method="post">
						<span>Product Name:</span><input type="text" id="name" class="form-control" name="prod_name" placeholder="Adobe After Effects" required>
						<span>Quantity:</span><input type="number" id="quantity" class="form-control" name="quant" placeholder="12" required>
						<span>Price in $:</span><input type="number" id="price" class="form-control" name="price" placeholder="350" required>
						<span>Category:</span><input type="text" id="category" class="form-control" name="cat" placeholder="Motion Graphics" required>
						<span>Image Link:</span><input type="text" id="img" class="form-control" name="img" placeholder="http://bit.ly/11voqpK" required>
						<input type="number" class="form-control" name="id" id="id" style="display:none;">
						<input type="submit" class="btn btn-success" value="Make Changes">
						<a href="adminPanel.php" class="btn btn-primary">Go Back </a>
					</form>
				</div>
		</div>
		</div>

	</body>

	<script>
		$("#del").click(function(){
			var id;
			// get id of the product whose checkbox was checked
			id=$("input:checked").parent().parent().children(".id").html();
			// send POST request to update.php to retrieve all details of the product whose id is selected
			$.ajax({
    			type:'post',
    			url:'update.php',
    			data: {data:id},
    			success: function(data){
    				// server returns all the data in json form, parse this reply and store in variable x
       			 	var x=JSON.parse(data);
       			 	// setting values of form to then be updated and sent for updating in db
       			 	$("input#id").val(x.id); //x.id means the id returned from server -- this input field is hidden because id cannot be changed but needs to be sent for updating
       			 	$("input#name").val(x.name); // setting name returned from server in form
       			 	$("input#quantity").val(x.quant);  //settig quantity of product in form
       			 	$("input#price").val(x.price);  //setting price of product in form
       			 	$("input#category").val(x.cat);  //setting category of product in form
       			 	$("input#img").val(x.img);   //setting image url of product in form
    			}
			});
		});
	</script>

</html>
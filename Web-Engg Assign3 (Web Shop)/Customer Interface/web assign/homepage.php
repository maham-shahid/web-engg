<?php
//require 'editing.php';
@ob_start();

//Checking Credentials. Change the DataBase Credentials According to your Data Base.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*$sql = "SELECT * FROM product_info";
echo $sql;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "id: " . $row["Prod_Name"]. " - Name: " . $row["Category"]. " " . $row["Price"]. "<br>";
	}
}
else {
	echo "0 results";
}*/
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Shophive</title>
	<!-- CDN LINKS -->
	<!-- Latest compiled and minified JavaScript -->
	<script src = "blah.js"></script>
	<script src = "jquery-1.11.0.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">	
	<script>
		$(window).load(function(){
		
							var apply = $("div.panel-body a[id ^= mybtn]");
							console.log(apply.length);
							var bla = apply.on("click",AddToCart);
							//for (var i =0 ; i<apply.length
						})
	</script>
<style>
	.nav-custom {
    background-color:#485C5A;
    color:#BFCFCC;
    border-radius:0;
	}
	.nav-headings {
    background-color:#BFCFCC;
    color:#485C5A;
    border-radius:0;
	}
	.header
	{
	background: #660036;
	color:#C0C0C0;
	}
	#content{
		color: red;
	}
</style>
</head>

<body>
<!-- header -->

<div class="page-header header" style="margin:0px; padding: 0px">
	<span class="glyphicon glyphicon-shopping-cart" style='font-size: 45px ; padding : 15px;' >WebShop</span>
	<form class="navbar-form navbar-right" role="search" style=" padding-top:20px; padding-right:50px">
    	<div class="form-group">
        	<input id = "s_txt" type="text" class="form-control" placeholder="Search">
        </div>
        <button class="btn btn-default"  onclick = "search()">Search</button>
    </form>	
</div>



<!-- my navigation bar -->
<nav class="navbar navbar-default" role="navigation" style="margin:0px; padding:0px">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    	<a class="navbar-brand" href="#">HOME</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">PRIVACY POLICY</a></li>
        <li><a href="#">CONTACT US</a></li>
	  </ul>
	  <ul class="nav navbar-nav" style ="float:right;">
        <li><a class="btn btn-primary" href="checkout.php" style ="color:white;">CHECK OUT</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>

<!-- END OF NAVBAR -->

<div class="row" style="margin:0px; padding: 0px">
	<div class="col-md-2"style="margin:0px; padding: 0px">
	<ul class="nav nav-custom nav-stacked">
	
		<li>
			<a href="#" class="nav-headings">REFINE BY CATEGORY<span class="glyphicon glyphicon-align-justify pull-right"></span></a>
		</li>
		<li>
			<a href="#" class="nav-custom">
				<input type="checkbox" name="categories" value="Photo Editor" /> Photo Editor</input></br>
				<input type="checkbox" name="categories" value="Development" /> Development</input></br>
			</a>
		</li>
		<li>
			<a href="#" class="nav-headings">REFINE BY PRICE<span class="glyphicon glyphicon-align-justify pull-right"></span></a>
		</li>
		<li>
			<a href="#" class="nav-custom">
				<input style = "width: 80px" type="number" name="price_min" Placeholder = "Minimum Price" /> - <input style = "width: 80px" type="number" name="price_max" Placeholder = "Maximum Price" />
			</a>
		</li>
		<li>
			<!--<a href="#" class="nav-headings">REFINE BY PRICE<span class="glyphicon glyphicon-align-justify pull-right"></span></a>-->
			<button onclick = "check()">Filter</button>
		</li>
		
	</ul>
	</div>

<!--RANDOM PRODUCTS DESPLAYED-->
<div id = "content" class="col-md-offset-2"><?php if(isset($_COOKIE["empty"])){
		if($_COOKIE["empty"] == "empty"){
			echo "Put Some Products in the Cart Before Checking Out!";
		}
	}
?></div>

	</br>
	<div class="col-md-10">
<?php
$count=0;
$sql = "SELECT * FROM product_info";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
?>	
	<div class="col-md-3">
		<div class="panel panel-default" id = "remove">
			<div class="panel-heading"><?php echo $row["Prod_Name"];?>
			</div>
			<div class="panel-body">
				<a href="#" class="thumbnail">
				<img src="<?php echo $row["Image"];?>"></a>
				<a href="#">Price: $<?php echo $row["Price"];?></a></br>
				<a href="#">Quantity: <?php echo $row["Quantity"];?></a></br>
				<a class="btn btn-default" href="#" id = "<?php echo "mybtn".$count;
				?>" style="width:100%" >Add To Cart</a>
			</div>
		</div>
	</div>
<?php		
	}
}
else{
	echo "0 results";
}
$count++;
?>

</div>
</div>
<div id = "content"></div>
<div class="panel-footer footer-inverse">Home | Terms | Privacy | Policy | Contact<p style="text-align:right">Copyright © 2014. All rights reserved</p></div>
</body>
</html>

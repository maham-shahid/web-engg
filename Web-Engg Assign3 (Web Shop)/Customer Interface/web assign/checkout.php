<?php
//require 'editing.php';
@ob_start();
session_start();

if(!isset($_COOKIE["name"])) {
		echo "<br> <br> <h1>Cookie Expired.. You are being redirected.. <br> <br> <h1>";
		setcookie("empty","empty",time()+20);
		header('Location: '.'homepage.php');
	}
//Checking Credentials. Change the DataBase Credentials According to your Data Base.
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	$array = $_COOKIE["name"];
	$pieces = explode(",",$_COOKIE["name"]);
	$trimed = rtrim($pieces[0]);
	$arr = "'".$pieces[0]."'";
		
	foreach( $pieces as $s){
		
		$arr = $arr. ",'".rtrim($s)."'";
	}		
	$_SESSION["array1"] = $arr;
	$_SESSION["array2"] = $array;
	
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
////////////////////////////////////////	

	table, caption, tbody, tfoot, thead, tr, th, td {
		margin:0;
		padding:0;
		border:0;
		outline:0;
		font-size:100%;
		vertical-align:baseline;
		background:transparent;
	}
	
	body {
		margin:0;
		padding:0;
		font:12px/15px "Helvetica Neue",Arial, Helvetica, sans-serif;
		color: #555;
		background:#f5f5f5 url(bg.jpg);
	}
	
	a {color:#666;}
	
	#content {width:65%; max-width:690px; margin:6% auto 0;}
	
	/*
	Pretty Table Styling
	CSS Tricks also has a nice writeup: http://css-tricks.com/feature-table-design/
	*/
	
	table {
		overflow:hidden;
		border:1px solid #d3d3d3;
		background:#fefefe;
		width:70%;
		margin:5% auto 0;
		-moz-border-radius:5px; /* FF1+ */
		-webkit-border-radius:5px; /* Saf3-4 */
		border-radius:5px;
		-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
		-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	}
	
	th, td {padding:18px 28px 18px; text-align:center; }
	
	th {padding-top:22px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
	
	td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
	
	tr.odd-row td {background:#f6f6f6;}
	
	td.first, th.first {text-align:left}
	
	td.last {border-right:none;}
	
	/*
	Background gradients are completely unnecessary but a neat effect.
	*/
	
	td {
		background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
	}
	
	tr.odd-row td {
		background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
	}
	
	th {
		background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
		background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
	}
	
	/*
	I know this is annoying, but we need additional styling so webkit will recognize rounded corners on background elements.
	Nice write up of this issue: http://www.onenaught.com/posts/266/css-inner-elements-breaking-border-radius
	
	And, since we've applied the background colors to td/th element because of IE, Gecko browsers also need it.
	*/
	
	tr:first-child th.first {
		-moz-border-radius-topleft:5px;
		-webkit-border-top-left-radius:5px; /* Saf3-4 */
	}
	
	tr:first-child th.last {
		-moz-border-radius-topright:5px;
		-webkit-border-top-right-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.first {
		-moz-border-radius-bottomleft:5px;
		-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.last {
		-moz-border-radius-bottomright:5px;
		-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
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
        <li><a href="#">ABOUT</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>

<!-- END OF NAVBAR -->

<div class="row" style="margin:0px; padding: 0px">
<!--	<div class="col-md-2"style="margin:0px; padding: 0px">
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
			<a href="#" class="nav-headings">REFINE BY PRICE<span class="glyphicon glyphicon-align-justify pull-right"></span></a>
			<button onclick = "check()">Filter</button>
		</li>
		
	</ul>
	</div>-->

<!--RANDOM PRODUCTS DESPLAYED-->


	</br>
	<div class="col-md-12">
<?php
$i=0;
$sql = "SELECT * FROM product_info WHERE Prod_Name IN (".$arr.")";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	// output data of each row
?>	<div class = "blah">
	<table cellspacing="0">
    <tr><th>Item</th><th>Price</th><th>Quantity</th></tr>
	<?php while($row = $result->fetch_assoc()) {
	?>
    <tr><td><?php echo $row["Prod_Name"]?></td><td><?php echo $row["Price"]?></td><td><?php echo substr_count($array,$row["Prod_Name"])?></td></tr>
    

<?php
	}
}
else {
	echo "0 results";
}

?>
	</table>
	<div class="col-md-12 ">
	<form action="bridge.php" method="post">
		<input class="col-md-2 col-md-offset-5" style = "height : 40px" class="btn btn-default" type="submit" name="submit" id="submit" value="CHECK OUT" onclick="">
	</form>
	</div>
</div>


</div>
</div>
<div id = "content"></div>
<div class="panel-footer footer-inverse">Home | Terms | Privacy | Policy | Contact<p style="text-align:right">Copyright © 2014. All rights reserved</p></div>
</body>
</html>


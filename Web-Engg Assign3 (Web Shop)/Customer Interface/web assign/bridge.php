<?php
session_start();
$arr = $_SESSION["array1"];
$array = $_SESSION["array2"];

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
if(isset($_POST["submit"]))
{
	$sql1 = "SELECT * FROM product_info WHERE Prod_Name IN (".$arr.")";
	//echo $sql1;
	$result = mysqli_query($conn, $sql1);
	if (mysqli_num_rows($result) > 0) {
		while($row = $result->fetch_assoc()) {
			$no_of_prod = (int)$row['Quantity'] - substr_count($array,$row["Prod_Name"]);
			
			
			$sql2 = "UPDATE product_info SET Quantity='".$no_of_prod."' WHERE Prod_Name='".$row['Prod_Name']."'";
			//echo $sql2; 
			mysqli_query($conn, $sql2);
		}
	}
}
if(isset($_COOKIE['name'])){
	unset($_COOKIE['name']);
	setcookie('name', '', time() - 3600); // empty value and old timestamp
}
if(isset($_COOKIE['empty'])){
	unset($_COOKIE['empty']);
	setcookie('empty', '', time() - 3600); // empty value and old timestamp
}
unset($_SESSION["array1"]);
unset($_SESSION["array2"]);

header('Location: '.'homepage.php');
?>
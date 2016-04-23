<?php

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

if(isset($_POST["name"])){
//echo $_POST["name"];
	if(!(isset($_COOKIE["name"]))){
		$cookie_exp = time()+60; 
		setcookie("name",$_POST["name"],$cookie_exp);
		$cook = $_POST["name"];
		echo $cook;
	}	
	else{
		$cook = $_POST["name"]."," .$_COOKIE["name"];
		$cookie_exp = time()+60;
		setcookie("name",$cook,$cookie_exp);
		echo $cook;
	}
	/*if(isset($_COOKIE["name"])){
		
		$cookie = $_COOKIE['name'];
		
		//$cookie = stripslashes($cookie);
		$savedCardArray[] = json_decode($cookie);
		print_r( $savedCardArray);
		$savedCardArray[]=$_POST["name"];
		$json = json_encode($savedCardArray);
		
		//$cookie_exp = time()+ 60; 
		setcookie("name", $json);
		
		//echo $json;
	}
	else{
		$cardArray[] = $_POST["name"];
		echo "shaheer";
		$json = json_encode($cardArray);
		//$cookie_exp = time()+ 60; 
		setcookie("name", $json);
		
		//echo $json;
	}*/
	
}


if(isset($_POST["s_str"])){
	$sstr = $_POST["s_str"];
	$sql = "SELECT * FROM product_info WHERE Prod_Name LIKE '%".$sstr."%'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			$myarray[] = $row;
		}
		echo json_encode($myarray);
	}
	else {
		echo "0 results";
	}
	
}


if(isset($_POST["category"])){
	$data = json_decode($_POST['category']);
	$cat_string = "'".$data[0]."'";
	for($i =1;$i<count($data);$i++){
		$cat_string = $cat_string.",'".$data[$i]."'";
	}
	$mval = $_POST["m_val"];
	$xval = $_POST["x_val"];
	
	if($data[0] != 'unset'){
		if($_POST["m_val"] != 'unset' && $_POST["x_val"] != 'unset'){
				$sql = "SELECT * FROM product_info WHERE Category IN(".$cat_string.") AND Price between '".$mval."' and '".$xval."'";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				// output data of each row
					while($row = $result->fetch_assoc()) {
						$myarray[] = $row;
					}
					echo json_encode($myarray);
				}
				else {
					echo "0 results";
				}
		}
		else if($_POST["m_val"] != 'unset' && $_POST["x_val"] == 'unset'){
			$sql = "SELECT * FROM product_info WHERE Category IN(".$cat_string.") AND Price > '".$mval."'";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					$myarray[] = $row;
				}
				echo json_encode($myarray);
			}
			else {
				echo "0 results";
			}
		}
		else if($_POST["x_val"] != 'unset' && $_POST["m_val"] == 'unset'){
			$sql = "SELECT * FROM product_info WHERE Category IN(".$cat_string.") AND Price < '".$xval."'";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					$myarray[] = $row;
				}
				echo json_encode($myarray);
			}
			else {
				echo "0 results";
			}
		}
		else{
			$sql = "SELECT * FROM product_info WHERE Category IN(".$cat_string.")";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					$myarray[] = $row;
				}
				echo json_encode($myarray);
			}
			else {
				echo "0 results";
			}
		}
	}
	else{
		if($_POST["m_val"] != 'unset'){
			if($_POST["x_val"] != 'unset'){
				$sql = "SELECT * FROM product_info WHERE Price between '".$mval."' and '".$xval."'";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				// output data of each row
					while($row = $result->fetch_assoc()) {
						$myarray[] = $row;
					}
					echo json_encode($myarray);
				}
				else {
					echo "0 results";
				}
			}
			else{
				$sql = "SELECT * FROM product_info WHERE Price > '".$mval."'";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				// output data of each row
					while($row = $result->fetch_assoc()) {
						$myarray[] = $row;
					}
					echo json_encode($myarray);
				}
				else {
					echo "0 results";
				}
			}
		}
		if($_POST["x_val"] != 'unset'){
			if($_POST["m_val"] == 'unset'){
				$sql = "SELECT * FROM product_info WHERE Price < '".$xval."'";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				// output data of each row
					while($row = $result->fetch_assoc()) {
						$myarray[] = $row;
					}
					echo json_encode($myarray);
				}
				else {
					echo "0 results";
				}
			}
		}
	}
}
?>
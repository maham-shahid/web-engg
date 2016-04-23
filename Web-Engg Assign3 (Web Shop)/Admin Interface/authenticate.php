<?php
		//  ****  This php file is used for authenticating the admin. ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

	//username and password are hard-coded. 
	define ("USER","admin");
	define ("PWD","admin_log");

	//if POST variables are not set, $user and $pwd won't contain any values.
	if(isset($_POST["user"]))
	{
		$user=$_POST["user"];
	}
	else
	{
		$user=NULL;
	}
	if(isset($_POST["pwd"]))
	{
		$pwd=$_POST["pwd"];
	}
	else
	{
		$pwd=NULL;
	}

	//if username and password match with hard-coded values, allow access...
	if($user==USER && $pwd== PWD)
	{
		echo "Success!";
		session_start();  //starting session for admin
		$_SESSION["admin"]=USER;   //setting SESSION variable to be used for granting access to other pages
		$_SESSION["time"]=time();  //time settings to keep check of 30-second limit for session timeout
		header("Location: adminPanel.php"); // redirect to admin homepage
		exit;
	}
	else //if credentials don't match, don't grant access and redirect to login page.
	{
    	echo "Failure";
    	header("Location: login.html");
    	exit;
	}

?>
<?php

		//  ****  This php file is for destroying the session on logout ****
		//  ****  This script is called when admin chooses to logout or when session expires (due to inactivity) ****
		//  ****  Session expiration is checked using php ****
		//  ****  Coded By: Maham Shahid ****
		//  ****  Team SmashUp | Maham | Maleeha | Shaheer ****

	session_start(); //start session for this page
	if(isset($_SESSION["admin"]))  //if admin is logged in, proceed
	{
		session_unset(); //unset the SESSION variables
		session_destroy(); //destroy the session
		header("location:login.html");  //and then redirect to login page.
	}
?>
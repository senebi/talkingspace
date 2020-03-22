<?php
	include("core/init.php");
	
	if(isset($_POST["do_login"])){
		//Get vars
		$username=$_POST["username"];
		$password=md5($_POST["password"]);
		
		//Create User object
		$user=new User;
		
		if($user->login($username, $password)){
			redirect("index.php", "You have been logged in.", "success");
		}
		else{
			redirect("index.php", "Incorrect username or password.", "error");
		}
	}
	else{
		redirect("index.php");
	}
?>
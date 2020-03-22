<?php
	/*
	 * Redirect to page
	 */
	function redirect($page=false, $message=null, $message_type=null){
		if(is_string($page))
			$location=$page;
		else
			$location=$_SERVER["SCRIPT_NAME"];
			
		//Check for message
		if($message!=null){
			//Set message
			$_SESSION["message"]=$message;
		}
		//Check for type
		if($message_type!=null){
			//Set message type
			$_SESSION["message_type"]=$message_type;
		}
		
		//Redirect
		header("location: ".$location);
		exit;
	}
	
	/*
	 * Display message
	 */
	function displayMessage(){
		if(!empty($_SESSION["message"])){
			//Assign message var
			$message=$_SESSION["message"];
			
			if(!empty($_SESSION["message_type"])){
				//Assign type var
				$message_type=$_SESSION["message_type"];
				//Create output
				echo "<div class='";
				if($message_type=="error")
					echo "alert alert-danger";
				else
					echo "alert alert-success";
				echo "'>".$message."</div>";
				
				//Unset message type
				unset($_SESSION["message_type"]);
			}
			//Unset message
			unset($_SESSION["message"]);
		}
	}
	
	/*
	 * Check if user is logged in
	 */
	function isLoggedIn(){
		if(isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"])
			return true;
		else return false;
	}
	
	/*
	 * Get logged in user info
	 */
	function getUser(){
		$userArray=array();
		$userArray["user_id"]=$_SESSION["user_id"];
		$userArray["username"]=$_SESSION["username"];
		$userArray["name"]=$_SESSION["name"];
		return $userArray;
	}
?>
<?php
	require_once("core/init.php");
	
	//Create Topic object
	$topic=new Topic;
	
	//Create User object
	$user=new User;
	
	//Create Validator object
	$validate=new Validator;
	
	if(isset($_POST["register"])){
		//Create data array
		$data=array();
		$data["name"]=$_POST["name"];
		$data["email"]=$_POST["email"];
		$data["username"]=$_POST["username"];
		$data["password"]=md5($_POST["password"]);
		$data["password2"]=md5($_POST["password2"]);
		$data["about"]=$_POST["about"];
		$data["last_activity"]=date("Y-m-d H:i:s");
		
		//Required fields
		$field_array=array("name", "email", "username", "password", "password2");
		
		if($validate->isRequired($field_array)){
			if($validate->isValidEmail($data["email"])){
				if($validate->passwordMatch($data["password"], $data["password2"])){
					//Upload avatar image
					if($user->uploadAvatar())
						$data["avatar"]=$_FILES["avatar"]["name"];
					else
						$data["avatar"]="noimage.png";
						
					//Register user
					if($user->register($data))
						redirect("index.php", "You are registered and can now log in.", "success");
					else
						redirect("index.php", "Something went wrong with registration.", "error");
				}
				else
					redirect("register.php", "Your passwords did not match.", "error");
			}
			else
				redirect("register.php", "Please use a valid e-mail address.", "error");
		}
		else
			redirect("register.php", "Please fill in all required fields.", "error");
	}
	
	//Get template & assign vars
	$template=new Template("templates/register.php");
	
	//Assign vars
	
	//Display template
	echo $template;
?>
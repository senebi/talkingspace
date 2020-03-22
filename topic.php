<?php
	require_once("core/init.php");
	
	//Create a Topic object
	$topic=new Topic;
	
	//Get ID from URL
	$topic_id=$_GET["id"];
	
	//Process reply
	if(isset($_POST["do_reply"])){
		//Create data array
		$data=array();
		$data["topic_id"]=$topic_id;
		$data["body"]=$_POST["body"];
		$data["user_id"]=getUser()["user_id"];
		
		//Create Validator object
		$validate=new Validator;
		
		//Required fields
		$field_array=array("body");
		
		if($validate->isRequired($field_array)){
			//Save reply
			if($topic->reply($data))
				redirect("topic.php?id=".$topic_id, "Your reply has been posted.", "success");
			else redirect("topic.php?id=".$topic_id, "Something went wrong with your reply.", "error");
		}
		else redirect("topic.php?id=".$topic_id, "Please fill the reply form.", "error");
	}
	
	//Get template & assign vars
	$template=new Template("templates/topic_.php");

	//Assign vars
	$template->topic=$topic->getTopic($topic_id);
	$template->replies=$topic->getReplies($topic_id);
	$template->title=$template->topic->title;
	
	//Display template
	echo $template;
?>
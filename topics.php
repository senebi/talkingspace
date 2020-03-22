<?php
	require_once("core/init.php");
	
	//Create topic object
	$topic=new Topic;
	
	//Get category from URL
	$category=isset($_GET["category"]) ? $_GET["category"] : null;
	
	//Get user from URL
	$user_id=isset($_GET["user"]) ? $_GET["user"] : null;
	
	//Get template & assign vars
	$template=new Template("templates/topics.php");
	
	//Assign template variables
	if(isset($category)){
		$template->topics=$topic->getByCategory($category);
		$template->title="Posts in \"".$topic->getCategory($category)->name."\"";
	}
	
	//Check for user filter
	if(isset($user_id)){
		$template->topics=$topic->getByUser($user_id);
		//$template->title="Posts by \"".$user->getUser($user_id)->username."\"";
	}
	
	//If no filter is set
	if(!isset($category) && !isset($user_id)){
		$template->topics=$topic->getAllTopics();
	}
	
	$template->totalTopics=$topic->getTotalTopics();
	$template->totalCategories=$topic->getTotalCategories();
	
	//Display template
	echo $template;
?>
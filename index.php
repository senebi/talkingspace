<?php
	require_once("core/init.php");
	
	//Create Topic object
	$topic=new Topic;
	
	//Create User object
	$user=new User;
	
	//Get template & assign vars
	$template=new Template("templates/frontpage.php");
	
	//Assign vars
	$template->topics=$topic->getAllTopics();
	$template->totalTopics=$topic->getTotalTopics();
	$template->totalCategories=$topic->getTotalCategories();
	$template->totalUsers=$user->getTotalUsers();
	
	//Display template
	echo $template;
?>
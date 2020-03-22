<?php

/*
 * Get # of replies per topic
 */
function replyCount($topic_id){
	$db=new Database;
	$db->query("select * from replies where topic_id=:topic_id");
	$db->bind(":topic_id", $topic_id);
	//Assign rows
	$rows=$db->resultset();
	//Get count
	return $db->rowCount();
}

/*
 * Get # of topics per category
 */
function topicCount($cat_id){
	$db=new Database;
	$db->query("select * from topics where category_id=:cat_id");
	$db->bind(":cat_id", $cat_id);
	
	//Assign rows
	$rows=$db->resultset();
	//Get count
	return $db->rowCount();
}

/*
 * Get categories
 */
function getCategories(){
	$db=new Database;
	$db->query("select * from categories");
	
	//Assign result set
	$results=$db->resultset();
	
	return $results;
}

/*
 * User posts
 */
function userPostCount($user_id){
	$db=new Database;
	$db->query("select * from topics where user_id=:user_id");
	$db->bind(":user_id", $user_id);
	//Assign rows
	$rows=$db->resultset();
	//Get count
	$topic_count=$db->rowCount();
	
	$db->query("select * from replies where user_id=:user_id");
	$db->bind(":user_id", $user_id);
	//Assign rows
	$rows=$db->resultset();
	//Get count
	$reply_count=$db->rowCount();
	return $topic_count+$reply_count;
}
?>
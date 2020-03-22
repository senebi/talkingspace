<?php
class User{
	//Init DB variable
	private $db;
	
	/*
	 * Constructor
	 */
	public function __construct(){
		$this->db=new Database;
	}
	
	/*
	 * Upload user avatar
	 */
	public function uploadAvatar(){
		$allowedExts=array("gif", "jpeg", "jpg", "png", "bmp", "tif");
		$temp=explode(".", $_FILES["avatar"]["name"]);
		$extension=end($temp);
		//Specify max file size in Mb
		$max_file_size=2;
		
		if(($_FILES["avatar"]["type"]=="image/gif"
			|| $_FILES["avatar"]["type"]=="image/jpeg"
			|| $_FILES["avatar"]["type"]=="image/jpg"
			|| $_FILES["avatar"]["type"]=="image/pjpeg"
			|| $_FILES["avatar"]["type"]=="image/x-png"
			|| $_FILES["avatar"]["type"]=="image/png")
		    && $_FILES["avatar"]["size"]<($max_file_size*1024*1024)
			&& in_array($extension, $allowedExts)){
			
			if($_FILES["avatar"]["error"]>0)
				redirect("register.php", $_FILES["avatar"]["error"], "error");
			else{
				if(file_exists("images/avatars/".$_FILES["avatar"]["name"]))
					redirect("register.php", "File already exists.", "error");
				else{
					move_uploaded_file($_FILES["avatar"]["tmp_name"],
						"images/avatars/".$_FILES["avatar"]["name"]);
					return true;
				}
			}
		}
		else{
			redirect("register.php", "Invalid file type or file size exceeded the maximum (".$max_file_size." Mb)!", "error");
		}
	}
	
	/*
	 * Register user
	 */
	public function register($data){
		//Insert query
		$this->db->query("insert into users (name, email, avatar, username, password, about, last_activity)
						 values (:name, :email, :avatar, :username, :password, :about, :last_activity)");
		//Bind values
		$this->db->bind(":name", $data["name"]);
		$this->db->bind(":email", $data["email"]);
		$this->db->bind(":avatar", $data["avatar"]);
		$this->db->bind(":username", $data["username"]);
		$this->db->bind(":password", $data["password"]);
		$this->db->bind(":about", $data["about"]);
		$this->db->bind(":last_activity", $data["last_activity"]);
		
		//Execute
		if($this->db->execute())
			return true;
		else return false;
		
	}
	
	/*
	 * Login
	 */
	public function login($user, $pass){
		$this->db->query("select * from users where username=:user and password=:pass");
		
		//Bind values
		$this->db->bind(":user", $user);
		$this->db->bind(":pass", $pass);
		
		$result=$this->db->single();
		
		//Check rows
		if($this->db->rowCount()>0){
			$this->setUserData($result);
			return true;
		}
		else return false;
	}
	
	/*
	 * Set user data
	 */
	public function setUserData($data){
		$_SESSION["is_logged_in"]=true;
		$_SESSION["user_id"]=$data->id;
		$_SESSION["username"]=$data->username;
		$_SESSION["name"]=$data->name;
	}
	
	/*
	 * User logout
	 */
	public function logout(){
		unset($_SESSION["is_logged_in"]);
		unset($_SESSION["user_id"]);
		unset($_SESSION["username"]);
		unset($_SESSION["name"]);
		return true;
	}
	
	/*
	 * Get total # of users
	 */
	public function getTotalUsers(){
		$this->db->query("select * from users");
		$rows=$this->db->resultset();
		return $this->db->rowCount();
	}
}
?>
<?php
include 'models/db_config.php';
$name="";
$err_name="";
$uname="";
$err_uname="";
$pass="";
$err_pass="";
$email="";
$err_email="";
$err_db="";
$hasError=false;

if(isset($_POST["sign_up"])){
	
	
	if(empty($_POST["name"])){
		$hasError= true;
		$err_name="name required";
	}
	else{
		$name=$_POST["name"];
	}
	
	if(empty($_POST["uname"])){
		$hasError= true;
		$err_uname="username required";
	}
	else{
		$uname=$_POST["uname"];
	}
	
	if(empty($_POST["pass"])){
		$hasError= true;
		$err_pass="password required";
	}
	else{
		$pass=$_POST["pass"];
	}
	
	
	if(empty($_POST["email"])){
		$hasError= true;
		$err_email="email required";
	}
	else{
		$email=$_POST["email"];
	}
	if(!$hasError){
		$rs = insertUser($name,$uname,$_POST["pass"],$_POST["email"]);
		if ($rs === true)
		{
			header("Location: login.php");
		}
		$err_db=$rs;
		
	}
	
}else if (isset($_POST["btn_login"])){
	if(empty($_POST["uname"])){
		$hasError= true;
		$err_uname="username required";
	}
	else{
		$uname=$_POST["uname"];
	}
	
	if(empty($_POST["pass"])){
		$hasError= true;
		$err_pass="password required";
	}
	else{
		$pass=$_POST["pass"];
	}
	if(!$hasError){
		if(authenticateUser($uname,$pass)){
			header("Location: dashboard.php");
		}
		$err_db="username password invalid";
	}
	
}
function insertUser($name,$uname,$pass,$email){
	$query = "insert into users values (NULL,'$name','$uname','$pass','$email')";
	return execute($query);
}
function authenticateUser($uname,$pass){
	$query="select * from users where username='$uname'and password='$pass'";
	$rs=get($query);
	if(count($rs)>0){
		return true;
	}
	return false;
	
}

?>
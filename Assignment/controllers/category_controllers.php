<?php
include 'models/db_config.php';
$name="";
$err_name="";
$err_db="";
if(isset($_POST["add_category"])){
	
	if(empty($_POST["name"])){
		$hasError= true;
		$err_name="name required";
	}
	else{
		$name=$_POST["name"];
	}
	if(!$hasError){
	$rs= insertCategory($_POST["name"]);
	if($rs=== true){
		header("Location: Allcategories.php");
	}
	$err_db = $rs;
	
}
}
function insertCategory($name){
	$query = "insert into categories values (NULL,'$name')";
	return execute($query);
}
?>
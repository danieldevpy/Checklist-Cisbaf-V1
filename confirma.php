<?php

session_start();

$_SESSION["acess"] = "0";
$acess = false;
$usa = false;
$usb = false;


$id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);

if(!empty($_POST["id"]) && !empty($_POST["password"]) && $_POST["id"] != null && $_POST["password"] != null){

	if(strtoupper($id) == "USA" && $password == "1234")
	{
		$_SESSION["acess"] = "usa";
		$acess = true;
		$usa = true;

	}else if(strtoupper($id) == "USB" && $password == "1234"){

		$_SESSION["acess"] = "usb";
		$acess = true;
		$usb = true;
	}

	if($acess && $_SESSION["acess"] == "usa" && $usa){
		header("Location:usa");
	}else if($acess && $_SESSION["acess"] == "usb" && $usb){
		header("Location:usb");
	}else{
		header("Location:index.html");
	}

}else{
	header("Location:index.html");
}

?>
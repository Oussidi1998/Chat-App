<?php
	session_start();
	$bd = mysqli_connect('localhost','root','$lkhwadri$','likefb');
	if (isset($_GET['idR'] ,$_GET['idS'] ,$_GET['sms'] )) {
		$datee = date("Y-m-d H:i:s");
		mysqli_query($bd,"INSERT INTO messages VALUES('','{$_GET['idS']}','{$_GET['idR']}','{$_GET['sms']}','$datee') ");
	}
	else
		header('location:index');


 ?>
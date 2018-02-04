<?php
	session_start();
	$bd = mysqli_connect('localhost','root','$lkhwadri$','likefb');

	if (isset($_GET['invit'] ,$_GET['accept'])) {
		$datee = date("Y-m-d H:i:s");
		mysqli_query($bd,"INSERT INTO friends VALUES('','{$_GET['invit']}','{$_GET['accept']}','$datee') ");
	}
	else
		header('location:index');


 ?>
<?php

	session_start();
	setcookie('username','',time()-3600);
	setcookie('password','',time()-3600);
	setcookie('avatar','',time()-3600);
	setcookie('id','',time()-3600);
	unset($_SESSION['user']);
	unset($_SESSION['id']);
	unset($_SESSION['avatar']);
	header('location: index')

 ?>
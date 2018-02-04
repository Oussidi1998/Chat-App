<?php
	session_start();
    $bd = mysqli_connect('localhost','root','$lkhwadri$','likefb');
    $msg="";

    if (isset($_POST['verify'])) {
    	$id=$_POST['id'];
    	$key=$_POST['code'];
    	// check exist
    	$exist=mysqli_query($bd,"SELECT * FROM membres WHERE id_membre=$id AND confirmkey=$key ");
    	$exist=mysqli_num_rows($exist);
		mysqli_query($bd,"UPDATE membres SET confirmer=1 WHERE id_membre=$id AND confirmkey=$key ");
    	if ($exist===intval(1)) {
    		$msg="<div class='alert alert-success'>your account has been activated</div>";
    	}else
    		$msg="<div class='alert alert-danger'>your confirmation key is invalid try again</div>";

    }else
    	header("location: index");

include('ressource/header.php');
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<?=$msg ?>
		</div>
	</div>
</div>
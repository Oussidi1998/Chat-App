<?php
	session_start();
    $bd = mysqli_connect('localhost','root','$lkhwadri$','likefb');

	$idR = $_GET['id'];
	if(isset($_COOKIE['id']))
		$idS=$_COOKIE['id'] ;
	else
		$idS=$_SESSION['id'];
	$sms = mysqli_query($bd,"SELECT * FROM messages WHERE (id_sender=$idS and id_reciever=$idR) or (id_sender=$idR and id_reciever=$idS)");
	if (mysqli_num_rows($sms) === 0 ) {
		echo "<div class='text-center' style='margin-top: 40px;'>Send first message to you friend</div>";
	}
	while ($data = mysqli_fetch_array($sms)) {
		echo "<div class='row'>";

			// for date
			$tab= explode(' ',$data['datee']);
			$tab=array_reverse($tab);
			$date=implode(' ',$tab);

		if ($_SESSION['id'] == $data['id_sender']) {
			echo "<div class='col-md-6 text-left'>
			<div class='sender'>{$data['content']}</div>
			<p>Sent $date</p>
			</div>";
		}else
			echo "<div class='col-md-6 col-md-offset-6 text-right'>
			<div class='reciever'>{$data['content']}</div>
			<p>Sent $date</p>
			</div>";

		echo"</div>";
	}
 ?>
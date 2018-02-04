
<?php

	session_start();
	$bd = mysqli_connect('localhost','root','$lkhwadri$','likefb');

	isset($_COOKIE['id']) ? $id=$_COOKIE['id'] : $id=$_SESSION['id'];
	$users = mysqli_query($bd,"SELECT username,avatar,id_membre,id_invit,id_accept from membres,friends WHERE (id_invit=$id and id_accept=id_membre) or (id_invit=id_membre and id_accept=$id) ");
	while ($data = mysqli_fetch_array($users)) {
		echo "<div class='friend' >
				<a href='index?id={$data['id_membre']}'><p><img src='avatars/{$data['avatar']}' width='30'> {$data['username']}</p></a>
			</div>";

	}
 ?>
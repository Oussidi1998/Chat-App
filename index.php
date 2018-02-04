<?php
	session_start();
	$bd = mysqli_connect('localhost','root','$lkhwadri$','likefb');

	if (!isset($_SESSION['user']) and !isset($_COOKIE['username']))
		header('location: register');

	// the id of the active user
	isset($_COOKIE['id']) ? $id=$_COOKIE['id'] : $id=$_SESSION['id'];

	// check if the user is confirmed or no
	$confirm=mysqli_query($bd,"SELECT id_membre,confirmer,confirmkey FROM membres WHERE id_membre =$id ");
	$confirm=mysqli_fetch_array($confirm);
 ?>
<head>
	<style type="text/css">
		 body{
			/* overflow: hidden; */
		}
		.section{
			height: 425px;
			overflow: scroll;
			overflow-x: hidden;
			padding-bottom: 40px;
		}
		.section:nth-child(2){
			height: 450px;
		}
	</style>
</head>
<?php include("ressource/header.php");?>
<script type="text/javascript">
	setInterval('loadfr()',500)
	function loadfr() {
		$('#myfriends').load("friends.php");
		$('#load').load("sms.php?id=<?=$_GET['id']?>");
	};
	<?php if (isset($_GET['id'])): ?>
		$(function(){
			$("#formChat").submit(function() {
				var message = $('#send').val();
				$.ajax({
					url: 'put_message.php',
					type: 'GET',
					data:'idR='+<?=$_GET['id'] ?>+'&idS='+<?=$_SESSION['id'] ?>+'&sms='+message,
				})
				$('#send').val('');
				$('#load').load("sms.php?id=<?=$_GET['id']?>");
				return false;
			});
		});
	<?php endif ?>

</script>
	<div class="container-fluid" >
		<div class="row">
		<?php if ($confirm['confirmer']): ?>
			<aside class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">My Friends</h3>
					</div>
					<div class="search" style="margin-top:2px">
						<form class="ui form" method="post">
							<input type="text" name="user" placeholder="Search for Friends">
						</form>
					</div>
					<div class="section panel-body" id='myfriends'>
						<?php

							$users = mysqli_query($bd,"SELECT username,avatar,id_membre,id_invit,id_accept from membres,friends WHERE (id_invit=$id and id_accept=id_membre) or (id_invit=id_membre and id_accept=$id) ");
							while ($data = mysqli_fetch_array($users)) {
								echo "<div class='friend' >
										<a href='index?id={$data['id_membre']}'><p><img src='avatars/{$data['avatar']}' width='30'> {$data['username']}</p></a>
									</div>";

							}
						 ?>
					</div>
				</div>
			</aside>
			<main class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Messenger</h3>
					</div>
					<div class="panel-body section">
						<?php if (!isset($_GET['id'])): ?>
							<div class="text-center" style="margin-top: 40px;">Select One of your friends to chat with</div>
						<?php else: ?>
							<div id="load">
								<?php
									$idR = $_GET['id'];
									isset($_COOKIE['id']) ? $idS=$_COOKIE['id'] : $idS=$_SESSION['id'];
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
							</div>
						<?php endif ?>
					</div>
					<?php if (isset($_GET['id'])): ?>
						<div class="send form ui">
							<form  method="post" id="formChat">
								<input type="text" name="sms" placeholder="your message here" id="send">
							</form>
						</div>
					<?php endif ?>
				</div>
			</main>
			<aside class="col-md-3">
				<div class="panel panel-primary"> <div class="panel-heading"> <h3 class="panel-title">Look for Friends</h3> </div>
				<div class="search" style="margin-top:2px">
					<form class="ui form" method="post">
						<input type="text" name="friend" placeholder="Friend Name">
					</form>
				</div>
					<div class="section panel-body">
						<?php
							isset($_COOKIE['id']) ? $id=$_COOKIE['id'] : $id=$_SESSION['id'];
							$users = mysqli_query($bd,"SELECT  username,avatar,id_membre from membres WHERE id_membre!=$id");
							while ($data = mysqli_fetch_array($users)) {
								$i++;
								echo "<div class='col-md-12' class='friendRemove'>
									<img src='avatars/{$data['avatar']}' width='30'> {$data['username']}
									<form method='post' class='formulaire form-inline' style='float:right' id='$i'>
									<button type='submit' class='add btn btn-primary' ><i class='fa fa-user-plus' ></i> add friend</button>
									<input type='hidden' value='$id' class='invit'>
									<input type='hidden' value='{$data['id_membre']}' class='accept'>
									</form>
									</div>";

							}
						 ?>
					</div>
				</div>
			</aside>
		<?php else: ?>
			<div class="col-md-6 col-md-offset-3">
				<div class="alert alert-danger" role="alert">
					<strong>Oh snap!</strong> You must confirm your account by using the code that we have sent to your
				</div>
					<form  action="confirmation.php" method="post" class="ui form">
						<input type="number" name="code" id="code" placeholder="confirmation code here"><br><br>
						<input type="hidden" name="id" value="<?=$confirm['id_membre']?>">
						<input type="submit" name="verify" value="Verification Code" class="ui button primary form-control">
					</form>
				</div>
			</div>
		<?php endif ?>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
		$('.add').click(function(){
				var invit = $(this).next('.invit').val();
				var accept = $(this).next('.invit').next('.accept').val();
				$.ajax({
					url: 'add_friend.php',
					type: 'GET',
					data:'invit='+invit+'&accept='+accept,
				})
				$(this).parent().parent().remove();

				return false;
			});
		});
	</script>
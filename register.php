<?php
	session_start();
	if (isset($_SESSION['user']) || isset($_COOKIE['username']))
		header('location: index');

 ?>
<?php include("ressource/header.php");?>
	<div class="container">
		<div class="row">
			<main class="col-md-8 col-md-offset-2" >
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Sign up </h3>
					</div>
					<div class="panel-body">
						<form method="post" class="ui form" enctype="multipart/form-data">
							<div class="field">
							    <label>Your Picture</label>
							    <div class="field">
							      <input type="file" name="avatar">
							    </div>
							</div>
							<div class="field">
							  <label>Full name</label>
							  <div class="two fields">
							    <div class="field">
							      <input type="text" name="nom" placeholder="First name">
							    </div>
							    <div class="field">
							      <input type="text" name="prenom" placeholder="Last name">
							    </div>
							  </div>
							</div>
							<div class="field">
							  <label>Address and location</label>
							  <div class="fields">
							    <div class="twelve wide field">
							      <input type="text" name="adresse" placeholder="Address">
							    </div>
							    <div class="four wide field">
							      <input type="number" name="zipcode" placeholder="Code postal">
							    </div>
							  </div>
							  <div class="fields">
							    <div class="eight wide field">
							      <input type="text" name="ville" placeholder="City">
							    </div>
							    <div class="eight wide field">
							      <input type="text" name="pays" placeholder="Country">
							    </div>
							  </div>
							</div>
							<div class="field">
							  <label>Information of connection</label>
							  <div class="fields">
							    <div class="sixteen wide field">
							      <input type="text" name="username" placeholder="username">
							    </div>
							  </div>
							  <div class="fields">
							    <div class="sixteen wide field">
							      <input type="email" name="email" placeholder="email">
							    </div>
							  </div>
							  <div class="fields">
							    <div class="eight wide field">
							      <input type="password" name="pass" placeholder="password">
							    </div>
							    <div class="eight wide field">
							      <input type="password" name="passs" placeholder="confirmer password">
							    </div>
							  </div>
							  <input type="submit" name="inscri" value="Sign me up" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</main>
		</div>
	</div>

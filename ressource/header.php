<?php
session_start();
    $bd = mysqli_connect('localhost','root','$lkhwadri$','likefb');
    $mockup=0;

    // for connect
    if (isset($_POST['connect'])) {
      $pass = md5($_POST['pass']);
      $req = mysqli_query($bd,"SELECT * FROM membres WHERE (username='{$_POST['user']}' or email='{$_POST['user']}') and password='$pass' ");
      $result=mysqli_fetch_assoc($req);
      if (mysqli_num_rows($req) == 1) {
        $_SESSION['user'] = $result['username'];
        $_SESSION['id']=$result['id_membre'];
        $_SESSION['avatar']=$result['avatar'];

        if (isset($_POST['remember'])) {
          setcookie('username',$result['username'],time()+365*24*3600);
          setcookie('password',$result['password'],time()+365*24*3600);
          setcookie('id',$result['id_membre'],time()+365*24*3600);
          setcookie('avatar',$result['avatar'],time()+365*24*3600);
        }
      }
    }


    // for sign up
    if (isset($_POST['inscri'])) {
         $confirmkey=rand(1111111111,9999999999);
         $nom = $_POST['nom'];
         $prenom = $_POST['prenom'];
         $email = $_POST['email'];
         $username = $_POST['username'];
         $pass = md5($_POST['pass']);
         $zipcode = $_POST['zipcode'];
         $adresse = $_POST['adresse'];
         $ville = $_POST['ville'];
         $pays = $_POST['pays'];
         $file = $_FILES['avatar'];

         $file_ext =explode('.',$file['name']);
         $file_ext =strtolower(end($file_ext));
         $allowed = array('jpg','png','jpeg');

         if(in_array($file_ext, $allowed)) {
             $file['name']=ucfirst(trim($_POST['nom'])).ucfirst(trim($_POST['prenom'])).'.'. $file_ext;
              $target = 'avatars/'.$file['name'];
           if (move_uploaded_file($file['tmp_name'], $target)) {
               $avatar =$file['name'];
             if (mysqli_query($bd,"INSERT INTO membres  VALUES('','$nom','$prenom','','$email','$username','$pass','$adresse','$pays','$ville',$zipcode,'$avatar',$confirmkey,'') ")) {
                 $_SESSION['avatar']=$avatar;
                 $_SESSION['user']=$username;
                  $mockup = 1;
                // send mail to user to confirm him or her account
                mail($email,"ChatApp account confirmation","the code to confirm your account is : ".$confirmkey,$headers);

               echo "<div class='text-center alert alert-success'>Bien ajouter</div>";

             }else
               echo "<div class='text-center alert alert-danger'>error lors d'ajout ressayer a nouveau</div>";

           }else
             echo "<div class='text-center alert alert-danger'>error d'upload </div>";
      }else
           echo "<div class='alert alert-danger'>Le type de fichier est inacceptable</div>";

    }

    if($mockup === 1){
      $id = mysqli_insert_id($bd);
      $_SESSION['id']=$id;
    }




 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Chat App</title>
    <!-- Bootstrap core CSS -->
    <link href="ressource/css/bootstrap.min.css" rel="stylesheet">
    <!-- semantic core CSS -->
    <link href="ressource/css/semantic.min.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="ressource/css/font-awesome.min.css" rel="stylesheet" />
    <!-- custom CSS here -->
    <link href="ressource/css/style.css" rel="stylesheet" />
    <!--Core JavaScript file  -->
    <script src="ressource/js/jquery.min.js"></script>
    <!--bootstrap JavaScript file  -->
    <script src="ressource/js/bootstrap.min.js"></script>
    <!--semantic JavaScript file  -->
    <script src="ressource/js/semantic.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-default" role="navigation" style="padding: 10px;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  class="navbar-brand" href="index">Chat App</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div  class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php if (isset($_SESSION['user'])){
                    echo "<ul class='nav navbar-nav navbar-right'><li><div class='alert user'><a href='user'><img class='ui avatar image' src='avatars/{$_SESSION['avatar']}'>
                    <b><span>{$_SESSION['user']} </span></b></a><a href='deconnect' title='deconnecter'><i class='fa fa-sign-out'></i></a></div></li></ul>";
                 }elseif (isset($_COOKIE['username'])) {
                   echo "<ul class='nav navbar-nav navbar-right'><li><div class='alert user'><a href='user'><img class='ui avatar image' src='avatars/{$_COOKIE['avatar']}'>
                    <b><span>{$_COOKIE['username']} </span></b></a><a href='deconnect' title='deconnecter'><i class='fa fa-sign-out'></i></a></div></li></ul>";
                    /*<i class='fa fa-edit '></i>
                    lien de deconnection
                     */
                 }else{ ?>
                    <ul class="nav navbar-nav navbar-right">
                            <li><a data-toggle="modal" data-target="#connect">Sign in</a></li>
                            <li><a data-toggle="modal" data-target="#inscrie">Sign up</a></li>
                    </ul>
                <?php } ?>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


    <!-- for connect -->
    <div class="modal fade" id="connect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Sign in</h4>
          </div>
          <form action="index" method='post' class='ui form'>
          <div class="modal-body">
               <input type='text' name='user' placeholder='votre email or username' class='form-control'><br>
               <input type='password' name='pass' placeholder='votre password' class='form-control'><br>
               <div class="field">
                  <div class="ui toggle checkbox">
                       <input type="checkbox" name="remember" id='remember'>
                       <label for="remember">Remember me</label>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="connect" class="btn btn-primary">Sign in</button>
          </div>
          </form>
        </div>
      </div>
    </div>



    <!-- for inscri -->

    <div class="modal fade" id="inscrie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Sign up</h4>
          </div>
          <form method="post" class="ui form" enctype="multipart/form-data">
          <div class="modal-body">
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
             </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" name="inscri" value="Sign me up" class="btn btn-primary">
         </div>
       </form>
        </div>
      </div>
    </div>
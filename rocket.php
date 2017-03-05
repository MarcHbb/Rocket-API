<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <?php include('fonctions.php'); ?>

    <title></title>
  </head>
  <body>

<div class="container">
  <?php

    $user = $_POST["user"];
    $pass = $_POST["pass"];


      $info = login($user,$pass);

      if($info->status == 'error'){
         ?>

      		<h4 style ='color:orange; '><?php echo 'Identifiant incorrect'; ?> </h4>

      		<form action="" autocomplete="off" method="post">
      			<input type="text" name="user" autocomplete="off" placeholder="Username">
      			<input type="password" name="pass" autocomplete="off" placeholder="Password">
      			<button type="submit" id="login-button">Login</button>
      		</form>
      </div>
      <?php
      } else {

      $token = $info->data->authToken;
      $id = $info->data->userId; ?>

      Liste of channels : </br> <br>
      <div class="list_channels">


      <ul>
        <?php list_channels($token,$id); ?> <br>
      </ul>
    </div>

        <hr> </br>
      <div class="send_msg">
        Message sent to <span class="list_channels">#general</span> : </br> <br><br>

        <?php send_msg($token,$id); }?>
    </div>

</div>
</div>






  </body>
</html>

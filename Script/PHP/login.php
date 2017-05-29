<?php
  
  require_once 'user.php';

  $user = new User();
  $user->login($_POST['umail'], $_POST['psw']);

  if($user->error == "") {
    session_start();

    $_SESSION['currentUser'] = $user;
  }
  else {
    echo $user->error;
  }

?>

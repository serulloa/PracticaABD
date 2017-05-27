<?php

  require 'user.php';

  $user = new User($_POST['uname']);
  echo $user->uname;

?>

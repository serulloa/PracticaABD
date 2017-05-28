<?php

  require_once 'user.php';

  $user = new User($_POST['uname'], $_POST['umail'], $_POST['uage'], $_POST['psw'], $_POST['music']);
  $user->register();

?>

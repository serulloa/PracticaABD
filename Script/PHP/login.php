<?php

  require_once 'user.php';

  $userArray = User::login($_POST['umail'], $_POST['psw']);

  if ($userArray != null) {
    $user = new User($userArray['uname'], $userArray['email'], $userArray['psw'], $userArray['age']);

    session_start();
    $_SESSION['uname'] = $user->uname;
    $_SESSION['email'] = $user->email;
    $_SESSION['age'] = $user->age;
  }

?>

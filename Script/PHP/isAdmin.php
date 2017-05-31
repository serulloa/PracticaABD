<?php

  session_start();
  require_once 'user.php';

  $userArray = User::update($_SESSION['email']);

  if ($userArray != null) {
    $user = new User($userArray['uname'], $userArray['email'], $userArray['age'], $userArray['psw'], "", $userArray['admin']);

    $_SESSION['uname'] = $user->uname;
    $_SESSION['email'] = $user->email;
    $_SESSION['age'] = $user->age;
    $_SESSION['admin'] = $user->admin;

    if ($_SESSION['admin'] == true) echo "verdadero";
    else echo "falso";
  }

  else echo "falso";

?>

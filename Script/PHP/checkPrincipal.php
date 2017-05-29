<?php

  require_once 'user.php';

  session_start();
  $usuario = $_SESSION['currentUser'];

  if($usuario->email == null) {
    echo "falso";
  }
  else {
    echo "verdadero";
  }

?>

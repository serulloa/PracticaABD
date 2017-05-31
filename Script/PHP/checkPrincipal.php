<?php

  require_once 'user.php';

  session_start();

  if(!isset($_SESSION['email'])) {
    echo "falso";
  }
  else {
    echo "verdadero";
  }

?>

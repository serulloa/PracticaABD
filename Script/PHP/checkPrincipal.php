<?php

  require_once 'user.php';

  session_start();

  if(!isset($_SESSION['currentUser'])) {
    echo "falso";
  }
  else {
    echo "verdadero";
  }

?>

<<?php

  session_start();

  if(!isset($_SESSION['currentUser'])) {
    header("Location: index.html");
  }
  else {
    header("Location: principal.html");
  }

?>

<?php

  require_once 'message.php';

  session_start();
  $email = $_SESSION['currentUser']->email;

  $id = Message::insertMessage($_POST['text'], $_POST['type'], $_POST['chat'], $email);

?>

<?php

  session_start();
  require_once 'chats.php';
  require_once 'user.php';

  $type = $_POST['type'];
  $email = $_SESSION['email'];

  if ($type == 'group') {
    Chats::loadGroupChats($email);
  } elseif ($type == 'personal') {
    Chats::loadPersonal($email);
  }

?>

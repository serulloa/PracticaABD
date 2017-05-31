<?php

  session_start();
  require_once 'message.php';

  $type = $_POST['type'];
  $id = $_POST['id'];

  $message = new Message();

  if ($type == 'global') {
    $message->loadGlobal();
  } elseif ($type == 'group') {
    $message->loadGroup();
  } elseif ($type == 'personal') {
    $message->loadPersonal($id);
  }

?>

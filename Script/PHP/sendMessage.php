<?php

  require_once 'message.php';
  require_once 'user.php';

  session_start();
  $email = $_SESSION['email'];

  $id = Message::insertMessage($_POST['text'], $_POST['type'], $_POST['chat'], $email);
  $message = new Message($id, $_POST['text'], $_POST['type'], $_POST['chat'], $email);

  if($message->type == 'tabGlobal') {
    $ok = $message->insertGlobal();
  } elseif ($message->type == 'tabGroup') {
    $message->insertGroup();
  } elseif ($message->type == 'tabPersonal') {
    $message->insertPersonal();
  }

  if($ok) {
    echo "ÉXITO";
  }

?>

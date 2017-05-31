<?php

  session_start();
  require_once "chats.php";
  require_once "message.php";

  $receiverEmail = $_POST['receiverEmail'];
  $text = $_POST['text'];
  $senderEmail = $_SESSION['email'];

  $chat = Chats::newConversation($senderEmail, $receiverEmail);
  if ($chat > 0){
    $id = Message::insertMessage($text);
    $message = new Message($id, $text, "personal", $chat, $senderEmail);
    $message->insertPersonal();

    echo "Mensaje enviado.";
  } elseif ($chat == -1) {
    echo "La conversación ya existe.";
  } else {
    echo "No existe ningún usuario con ese email.";
  }

?>

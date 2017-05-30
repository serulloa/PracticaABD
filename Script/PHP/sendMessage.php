<?php

  require_once 'message.php';

  $id = Message::insertMessage($_POST['text']);

?>

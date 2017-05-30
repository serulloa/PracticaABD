<?php

  require_once 'message.php';

  $type = $_POST['type'];

  if ($type == 'tabGlobal') {
    Message::loadGlobal();
  } elseif ($type == 'tabGroup') {
    Message::loadGroup();
  } elseif ($type == 'tabPersonal') {
    Message::loadPersonal();
  }

?>

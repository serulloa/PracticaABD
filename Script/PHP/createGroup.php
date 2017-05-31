<?php

  require_once 'group.php';

  $ok = Group::createGroup($_POST['name'], $_POST['genre'], $_POST['maxAge'], $_POST['minAge']);

  if($ok) echo "Grupo creado.";
  else echo "Creación fallida.";
?>

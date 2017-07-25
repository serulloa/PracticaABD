<?php

  require_once "group.php";

  $ok = Group::addUser($_POST["group"], $_POST["user"]);

  if ($ok) echo "Usuario añadido.";
  else echo "El usuario ya existe en el grupo.";

?>

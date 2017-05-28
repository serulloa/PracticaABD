<?php

  require_once 'user.php';

  $user = new User($_POST['uname'], $_POST['umail'], $_POST['uage'], $_POST['psw'], $_POST['music']);
  $ok = $user->register();

  if ($ok) {
    echo "Registro completado con éxito!";
  }
  else {
    echo "Registro fallido.";
  }

?>

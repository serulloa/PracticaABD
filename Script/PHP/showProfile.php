<?php

  session_start();
  require_once 'user.php';
  require_once 'genreUser.php';

  $userArray = User::update($_SESSION['email']);
  $genreArray = GenreUser::getGenres($_SESSION['email']);

  if ($userArray != null) {
    $user = new User($userArray['uname'], $userArray['email'], $userArray['age'], $userArray['psw']);

    $_SESSION['uname'] = $user->uname;
    $_SESSION['email'] = $user->email;
    $_SESSION['age'] = $user->age;
    $_SESSION['genres'] = $genreArray;
  }

  echo "<h3>Nombre</h3><p>".$_SESSION['uname']."</p>";
  echo "<h3>Email</h3><p>".$_SESSION['email']."</p>";
  echo "<h3>Edad</h3><p>".$_SESSION['age']."</p>";

  echo "<h3>Géneros favoritos</h3>";
  foreach ($_SESSION['genres'] as $genreName) {
    echo "<p>".$genreName."</p>";
  }

?>

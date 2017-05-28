<?php

  require_once 'database.php';
  require_once 'genreUser.php';

  class User {

    var $uname;
    var $email;
    var $age;
    var $psw;
    var $genres;
    var $error = "";

    function User($uname = "", $email = "", $age = 18, $psw = "", $genres = "") {
      $this->uname = $uname;
      $this->email = $email;
      $this->age = $age;
      $this->psw = $psw;
      $this->genres = explode('$', $genres);
    }

    function login($email = "", $psw = "") {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $stmtEmail, $stmtPsw);

      $stmtEmail = $email;
      $stmtPsw = $psw;
      $ok = $stmt->execute();

      if($ok) {
        $stmt->bind_result($email, $uname, $psw, $age);
        while ($stmt->fetch()) {
          $this->email = $email;
          $this->uname = $uname;
          $this->psw = $psw;
          $this->age = $age;
        }
      }
      else {
        $this->error = "El email o la contraseña no son válidos.";
      }

      $db->close($stmt, $conn);
    }

    function register() {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO user (email, name, password, age) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssi", $stmtemail, $stmtname, $stmtpsw, $stmtage);

      $stmtemail = $this->email;
      $stmtname = $this->uname;
      $stmtpsw = $this->psw;
      $stmtage = $this->age;
      $ok = $stmt->execute();

      $db->close($stmt, $conn);

      if($ok) {
        $this->addGenres();
      }

      return $ok;
    }

    function addGenres() {
      $genreUser = new GenreUser();
      $genreUser->insert($this->email, $this->genres);
    }

  }

?>

<?php

  require 'database.php';

  class User {

    var $uname;
    var $email;
    var $age;
    var $psw;
    var $genres;

    function User($uname = "", $email = "", $age = 18, $psw = "", $genres = "") {
      $this->uname = $uname;
      $this->email = $email;
      $this->age = $age;
      $this->psw = $psw;
      $this->genres = explode('$', $genres);
    }

    function getId() {
      $db = new Database();
      $conn = $db->connect();

      $sql = "SELECT UserId FROM user WHERE email = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $stmtemail);

      $stmtemail = $this->email;
      $stmt->execute();
      $stmt->bind_result($userId);

      $db->close();

      return $userId;
    }

    function register() {
      $db = new Database();
      $conn = $db->connect();

      $sql = "INSERT INTO user (fullName, email, age, password) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssis", $stmtname, $stmtemail, $stmtage, $stmtpsw);

      $stmtname = $this->uname;
      $stmtemail = $this->email;
      $stmtage = $this->age;
      $stmtpsw = $this->psw;
      $stmt->execute();

      $this->addGenres($conn);

      $db->close();
    }

    function addGenres() {
      $db = new Database();
      $conn = $db->connect();

      $userId = $this->getId();
      

      $db->close();
    }

  }

?>

<?php

  require_once 'database.php';

  class Group {

    var $name;
    var $genre;
    var $maxAge;
    var $minAge;

    function Group($name) {
      $this->name = $name;

      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "SELECT genreName, maxAge, minAge FROM group_chat WHERE name = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $stmtName);

      $stmtName = $name;
      $ok = $stmt->execute();

      if($ok) {
        $stmt->bind_result($genreName, $maxAge, $minAge);
        while ($stmt->fetch()) {
          $this->genre = $genreName;
          $this->maxAge = $maxAge;
          $this->minAge = $minAge;
        }
      }

      $db->close($stmt, $conn);
    }

    function createGroup($name, $genre, $maxAge, $minAge) {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO group_chat (name, genreName, maxAge, minAge) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssii", $stmtName, $stmtGenre, $stmtMaxAge, $stmtMinAge);

      $stmtName = $name;
      $stmtGenre = $genre;
      $stmtMaxAge = $maxAge;
      $stmtMinAge = $minAge;
      $ok = $stmt->execute();

      $db->close($stmt, $conn);

      return $ok;
    }

    function loadGroups() {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "SELECT name FROM group_chat";
      $stmt = $conn->prepare($sql);
      $ok = $stmt->execute();

      if($ok) {
        $stmt->bind_result($name);
        while ($stmt->fetch()) {
          echo "<option value='$name'>$name</option>";
        }
      }

      $db->close($stmt, $conn);

      return $ok;
    }

    function loadUsers() {
      $db = new DBSongluvr();
      $conn = $db->connect();
      $conn2 = $db->connect();

      $sql = "SELECT userEmail FROM genre_user WHERE genreName = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $stmtGenre);

      $stmtGenre = $this->genre;
      $ok = $stmt->execute();

      $arrayEmails = array();

      if($ok) {
        $stmt->bind_result($userEmail);
        while ($stmt->fetch()) {
          array_push($arrayEmails, $userEmail);
        }
      }

      $db->close($stmt, $conn);
      $conn = $db->connect();

      foreach ($arrayEmails as $email) {
        $sql = "SELECT email FROM user WHERE (email = ?) AND (age <= ?) AND (age >= ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $stmtEmail, $stmtMaxAge, $stmtMinAge);
        $stmtEmail = $email;
        $stmtMaxAge = $this->maxAge;
        $stmtMinAge = $this->minAge;
        $ok = $stmt->execute();

        if($ok) {
          $stmt->bind_result($emailres);
          while ($stmt->fetch()) {
            echo "<option value='$emailres'>$emailres</option>";
          }
        }
      }

      $db->close($stmt, $conn);
    }

    function addUser($group, $user) {
      $db = new DBSongluvr();

      $conn = $db->connect();

      $sql = "INSERT INTO group_chat_user (groupName, userEmail) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $stmtGroup, $stmtUser);

      $stmtGroup = $group;
      $stmtUser = $user;
      $ok = $stmt->execute();

      $db->close($stmt, $conn);

      return $ok;
    }

  }

?>

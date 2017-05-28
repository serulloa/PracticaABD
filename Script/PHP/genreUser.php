<?php

  require_once 'database.php';

  class GenreUser {

    function insert($userEmail, $genres) {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO genre_user (genreName, userEmail) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $stmtGenreName, $stmtUserEmail);

      $ok = true;

      foreach ($genres as $genreName) {
        if($ok) {
          $stmtGenreName = $genreName;
          $stmtUserEmail = $userEmail;
          $ok = $stmt->execute();
        }
      }

      $db->close($stmt, $conn);
    }

  }

?>

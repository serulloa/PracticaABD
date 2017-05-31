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

    function getGenres($email) {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "SELECT genreName FROM genre_user WHERE userEmail = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $stmtEmail);

      $stmtEmail = $email;
      $ok = $stmt->execute();

      $genres = array();

      if($ok) {
        $stmt->bind_result($genreName);
        while ($stmt->fetch()) {
          array_push($genres, $genreName);
        }
      }

      $db->close($stmt, $conn);

      return $genres;
    }

  }

?>

<?php

  class Database {

    function Database() {

    }

    function connect() {
      $servername = "localhost";
      $username = "songluvr";
      $password = "admin";
      $dbname = "songluvr";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      return $conn
    }

    function close($stmt, $conn) {
      $stmt->close();
      $conn->close();
    }

  }

?>

<?php

  require_once 'database.php';

  class Message {
    var $id;
    var $text;

    function Message($id, $text) {
      $this->id = $id;
      $this->text = $text;
    }

    function insertMessage($text) {
      $db = new DBSongluvr();
      $conn = $db.connect();

      $sql = "INSERT INTO message (name) VALUES (?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $stmtText);

      $stmtText = $text;
      $ok = $stmt->execute();

      $db.close($stmt, $conn);
    }
  }

?>

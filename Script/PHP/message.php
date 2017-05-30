<?php

  require_once 'database.php';

  class Message {
    var $id;
    var $text;

    function Message($id, $text) {
      $this->id = $id;
      $this->text = $text;
    }

    function insertMessage($text, $type, $chat, $sender) {
      echo $sender;

      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO message (text) VALUES (?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $stmtText);

      $stmtText = $text;
      $ok = $stmt->execute();

      $id = $conn->insert_id;
      echo $id;

      $db->close($stmt, $conn);
    }
  }

?>

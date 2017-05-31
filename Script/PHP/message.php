<?php

  require_once 'database.php';

  class Message {
    var $id;
    var $text;
    var $type;
    var $chat;
    var $sender;

    function Message($id = 0, $text = "", $type = "", $chat = "", $sender = "") {
      $this->id = $id;
      $this->text = $text;
      $this->type = $type;
      $this->chat = $chat;
      $this->sender = $sender;
    }

    function insertMessage($text, $type, $chat, $sender) {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO message (sentText) VALUES (?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $stmtText);

      $stmtText = $text;
      $ok = $stmt->execute();

      $id = $conn->insert_id;

      $db->close($stmt, $conn);

      return $id;
    }

    function insertGlobal() {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO message_user_all (messageId, userEmail) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("is", $stmtId, $stmtEmail);

      $stmtId = $this->id;
      $stmtEmail = $this->sender;
      $ok = $stmt->execute();

      $db->close($stmt, $conn);

      return $ok;
    }

    function insertGroup() {

    }

    function insertPersonal() {

    }

    function loadGlobal() {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "SELECT * FROM message_user_all";
      $stmt = $conn->prepare($sql);
      $ok = $stmt->execute();

      if ($ok) {
        $stmt->bind_result($id, $email);
        while ($stmt->fetch()) {
          echo '<h3>'.$email.'</h3>';

          $connText = $db->connect();

          $sqlText = "SELECT sentText FROM message WHERE id = ?";
          $stmtText = $connText->prepare($sqlText);
          $stmtText->bind_param("i", $stmtTextId);

          $stmtTextId = $id;
          $ok = $stmtText->execute();

          if($ok) {
            $stmtText->bind_result($text);
            while ($stmtText->fetch()) {
              echo '<p>'.$text.'</p>';
              echo '<div class="separator"></div>';
            }
          }

          $db->close($stmtText, $connText);
        }
      }

      $db->close($stmt, $conn);
    }

    function loadGroup() {

    }

    function loadPersonal() {

    }
  }

?>

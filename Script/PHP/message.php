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

    function insertMessage($text) {
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
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO message_user_group_chat (messageId, userEmail, groupName) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("iss", $stmtId, $stmtEmail, $stmtGroup);

      $stmtId = $this->id;
      $stmtEmail = $this->sender;
      $stmtGroup = $this->chat;
      $ok = $stmt->execute();

      $db->close($stmt, $conn);

      return $ok;
    }

    function insertPersonal() {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO message_conversation (messageId, conversationId, senderEmail) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("iis", $stmtMessageId, $stmtConverstionId, $stmtSenderEmail);

      $stmtMessageId = $this->id;
      $stmtConverstionId = $this->chat;
      $stmtSenderEmail = $this->sender;
      $ok = $stmt->execute();

      $db->close($stmt, $conn);

      return $ok;
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

    function loadGroup($groupName) {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "SELECT messageId, userEmail FROM message_user_group_chat WHERE groupName = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $stmtGroup);

      $stmtGroup = $groupName;
      $ok = $stmt->execute();

      if ($ok) {
        $stmt->bind_result($messageId, $userEmail);
        while ($stmt->fetch()) {
          $connText = $db->connect();
          echo "<h3>".$userEmail."</h3>";

          $sqlText = "SELECT sentText FROM message WHERE id = ?";
          $stmtText = $connText->prepare($sqlText);
          $stmtText->bind_param("i", $stmtTextId);

          $stmtTextId = $messageId;
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

    function loadPersonal($converId) {
      $db = new DBSongluvr();
      $connEmail = $db->connect();
      $connText = $db->connect();

      $sqlEmail = "SELECT messageId, senderEmail FROM message_conversation WHERE conversationId = ?";
      $stmtEmail = $connEmail->prepare($sqlEmail);
      $stmtEmail->bind_param("i", $stmtEmailId);

      $stmtEmailId = $converId;
      $ok = $stmtEmail->execute();

      if ($ok) {
        $stmtEmail->bind_result($messageId, $senderEmail);
        while ($stmtEmail->fetch()) {
          echo "<h3>".$senderEmail."</h3>";

          $sqlText = "SELECT sentText FROM message WHERE id = ?";
          $stmtText = $connText->prepare($sqlText);
          $stmtText->bind_param("i", $stmtTextId);

          $stmtTextId = $messageId;
          $ok = $stmtText->execute();

          if($ok) {
            $stmtText->bind_result($text);
            while ($stmtText->fetch()) {
              echo '<p>'.$text.'</p>';
              echo '<div class="separator"></div>';
            }
          }
        }
      }

      $db->close($stmtEmail, $connEmail);
      $db->close($stmtText, $connText);
    }
  }

?>

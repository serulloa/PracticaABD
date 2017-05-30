<?php

  require_once 'database.php';

  class Message {
    var $id;
    var $text;
    var $type;
    var $chat;
    var $sender;

    function Message($id, $text, $type, $chat, $sender) {
      $this->id = $id;
      $this->text = $text;
      $this->type = $type;
      $this->chat = $chat;
      $this->sender = $sender;
    }

    function insertMessage($text, $type, $chat, $sender) {
      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "INSERT INTO message (text) VALUES (?)";
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
      echo ('
        <div class="verticalTab">
          <button class="verticalTablinks" onclick="openChat(event, "chatGlobalMessages")" id="chatGlobal">Global</button>
        </div>

        <div id="chatGlobalMessages" class="verticalTabcontent">
      ');
    }

    function loadGroup() {

    }

    function loadPersonal() {

    }
  }

?>

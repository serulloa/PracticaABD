<?php

  require_once "database.php";

  class Chats {

    function loadPersonal($email) {
      echo "<div class='verticalTab'>
              <button class='verticalTablinks' onclick='showModal();' id='modalBtn'>+ Nueva Conversación</button>";

      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "SELECT * FROM conversation WHERE email1 = ? OR email2 = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $stmtEmail1, $stmtEmail2);

      $stmtEmail1 = $email;
      $stmtEmail2 = $email;
      $ok = $stmt->execute();

      $arrayIds = array();

      if ($ok) {
        $stmt->bind_result($id, $email1, $email2);
        while ($stmt->fetch()) {
          echo "<button class='verticalTablinks' onclick='openChat(event, ".'"'.$id."Messages".'"'.");' id='".$id."'>";

          if ($email1 == $email) echo $email2;
          else echo $email1;

          echo "</button>";

          array_push($arrayIds, $id);
        }
      }

      $db->close($stmt, $conn);

      echo "</div>";
      foreach ($arrayIds as $idContent) {
        echo "<div id='".$idContent."Messages' class='verticalTabcontent'>

        </div>";
      }
    }

    function newConversation($email1, $email2) {
      $id = 0;

      if (!Chats::existe($email1, $email2)) {
        $db = new DBSongluvr();
        $conn = $db->connect();

        $sql = "INSERT INTO conversation (email1, email2) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $stmtEmail1, $stmtEmail2);

        $stmtEmail1 = $email1;
        $stmtEmail2 = $email2;
        $ok = $stmt->execute();

        $id = $conn->insert_id;

        $db->close($stmt, $conn);
      }
      else {
        $id = -1;
      }

      return $id;
    }

    function existe($email1, $email2) {
      $existe = false;

      $db = new DBSongluvr();
      $conn = $db->connect();

      $sql = "SELECT * FROM conversation WHERE (email1 = ? AND email2 = ?) OR (email1 = ? AND email2 = ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $stmtEmail1, $stmtEmail2, $stmtEmail2, $stmtEmail1);

      $stmtEmail1 = $email1;
      $stmtEmail2 = $email2;
      $ok = $stmt->execute();

      $stmt->store_result();
      if ($stmt->num_rows > 0) $existe = true;
      else $existe = false;

      $db->close($stmt, $conn);

      return $existe;
    }

  }

?>

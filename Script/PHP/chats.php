<?php

  require_once "database.php";

  class Chats {

    function loadPersonal($email) {
      echo "<div class='verticalTab'>
              <button class='verticalTablinks' onclick='showModalConver();' id='nuevaConver'>+ Nueva Conversación</button>";

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

  }

?>

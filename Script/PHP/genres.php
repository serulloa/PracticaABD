<?php

  require 'database.php';

  class Genres {

    $list;

    function getList() {
      $db = new Database();
      $db->connect();

      $sql = "SELECT GenresId";

      $db->close();
    }

  }

?>

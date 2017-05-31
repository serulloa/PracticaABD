<?php

  require_once 'group.php';

  $groupName = $_POST['name'];
  $group = new Group($groupName);

  $group->loadUsers();

?>

<?php

  class User
  {

    var $uname;
    var $email;
    var $edad;
    var $psw;
    var $genres;

    function User($uname = "")
    {
      $this->uname = $uname;
    }
  }

?>

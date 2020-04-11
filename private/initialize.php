<?php
  ob_start(); // output buffering is turned on
  //ini_set( 'session.cookie_httponly', 1 );
  session_start(); // turn on sessions
  include('public_header.php');
  include('functions.php');
  include('config.php');
  setApiAccessToken();
  $errors = [];
?>

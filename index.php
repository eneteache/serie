<?php

  session_start();
  if (!isset($_SESSION['estado'])) {
    header('location: sesion/iniciarsesion.php');
  } else {

  include_once 'navegacion.php';
  include_once 'body.php';
  include_once 'footer.php';
} ?>
<?php
  if (empty($_SESSION['company_id']) || $_SESSION['role_id'] != 3) {
    echo "Acceso denegado. Por favor, inicia sesión.";
    die(); // Detener la ejecución del script";
  }
  
  include_once 'config/config.php';
  include_once 'views/company/header.php';
?>
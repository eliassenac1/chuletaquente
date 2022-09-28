<?php 
session_name("Chulleta Quente");
session_start();
session_destroy();
header('location: ../index.php');
exit;
?>
<?php
//if (isset($_GET['logout'])) {
session_start();
unset($_SESSION['userId']);
session_unset();
session_destroy();
  header("Location: index.php");
   exit;
//} else {
//    header("Location: index.php");
//    exit;
//}
?>
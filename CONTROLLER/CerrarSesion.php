<?php
session_start();
session_destroy();
header("Location: ../VIEW/Login.php");
exit;
?>
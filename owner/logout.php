<?php
session_start();
session_destroy();
unset($_SESSION['owner']);
echo "<script>window.location='../index.php';</script>";
?>
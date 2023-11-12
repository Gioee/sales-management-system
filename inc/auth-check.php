<?php
session_start();

if (!isset($_SESSION["matricola"]) && !isset($_SESSION["autenticato"])) {
    header("location: login.php");
    exit;
}

?>
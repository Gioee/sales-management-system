<?php

include('./inc/auth-check.php');

$codice = $_GET['codice'];

require_once("./config.php");

$query = "SELECT foto, formato FROM prodotto WHERE codice = ?";

if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param("i", $codice);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $foto = $row['foto'];
        $formato = $row['formato'];
    }
    $stmt->close();
}

header("Content-Type: " . $formato);
echo $foto;

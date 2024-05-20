<?php
$servername = "82.197.80.210";
$username = "u482925761_fag";
$password = "Admin11admin";
$dbname = "u482925761_fixandgo";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}
?>
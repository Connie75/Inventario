<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "Azurro49.";
$dbname = "inventario";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la co: " . $conn->connect_error);
}
?>

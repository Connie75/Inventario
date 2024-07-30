<?php
session_start();
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cliente_id']) && isset($_POST['total'])) {
        $cliente_id = $_POST['cliente_id'];
        $total = $_POST['total'];

        // Insertar la factura en la base de datos
        $query = "INSERT INTO facturas (cliente_id, total) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("id", $cliente_id, $total);

        if ($stmt->execute()) {
            header("Location: ../views/invoices.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: Cliente o total no proporcionado.";
    }
}
?>

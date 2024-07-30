<?php
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Consulta para obtener las facturas con la información del cliente
$query = "SELECT facturas.id, clientes.nombre AS cliente_nombre, facturas.total, facturas.fecha
          FROM facturas
          JOIN clientes ON facturas.cliente_id = clientes.id";
$result = $conn->query($query);

if (!$result) {
    die("Query fallida: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Facturas</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Facturas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['cliente_nombre']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
include '../includes/footer.php';
?>

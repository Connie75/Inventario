<?php
session_start();
include '../includes/header.php';
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener el ID de la factura
if (!isset($_GET['id'])) {
    header("Location: invoices.php");
    exit();
}

$invoice_id = $_GET['id'];

// Obtener los detalles de la factura
$query = "SELECT facturas.id, clientes.nombre AS cliente_nombre, facturas.total, facturas.fecha
          FROM facturas
          JOIN clientes ON facturas.cliente_id = clientes.id
          WHERE facturas.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$result = $stmt->get_result();
$invoice = $result->fetch_assoc();

if (!$invoice) {
    echo "Factura no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Factura</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h2>Detalles de la Factura</h2>
        <table>
            <tr>
                <th>ID</th>
                <td><?php echo $invoice['id']; ?></td>
            </tr>
            <tr>
                <th>Cliente</th>
                <td><?php echo $invoice['cliente_nombre']; ?></td>
            </tr>
            <tr>
                <th>Total</th>
                <td><?php echo $invoice['total']; ?></td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td><?php echo $invoice['fecha']; ?></td>
            </tr>
        </table>
        <a href="invoices.php">Volver a la lista de facturas</a>
    </div>
</body>
</html>
// ... código anterior ...

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['cliente_nombre']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td>
                    <a href="edit_invoice.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="view_invoice.php?id=<?php echo $row['id']; ?>">Ver</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

// ... código posterior ...

<?php
$conn->close();
include '../includes/footer.php';
?>

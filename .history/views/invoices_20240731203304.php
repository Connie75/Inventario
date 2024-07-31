<?php
session_start();
include("../includes/header.php");
include("../includes/db.php");

// Consulta SQL para obtener las facturas junto con los detalles del cliente
$sql = "SELECT facturas.id, clientes.nombre AS cliente_nombre, facturas.total, facturas.fecha 
        FROM facturas
        JOIN clientes ON facturas.cliente_id = clientes.id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error al ejecutar la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Facturas</h1>
    <a href="add_invoice.php">Agregar Factura</a>
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
            <?php while ($factura = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($factura['id']); ?></td>
                    <td><?php echo htmlspecialchars($factura['cliente__nombre']); ?></td>
                    <td><?php echo htmlspecialchars($factura['total']); ?></td>
                    <td><?php echo htmlspecialchars($factura['fecha']); ?></td>
                    <td>
                        <a href="edit_invoice.php?id=<?php echo htmlspecialchars($factura['id']); ?>">Editar</a>
                        <a href="../actions/delete_invoice.php?id=<?php echo htmlspecialchars($factura['id']); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
$conn->close();
include("../includes/footer.php");
?>

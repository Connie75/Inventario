<!-- views/invoices.php -->
<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Obtener lista de facturas
$result = $conn->query("SELECT facturas.*, ventas.total FROM facturas JOIN ventas ON facturas.venta_id = ventas.id");
?>

<h2>Gestión de Facturas</h2>
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


<?php $conn->close(); ?>
<?php include '../includes/footer.php'; ?>

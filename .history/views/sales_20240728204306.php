<!-- views/sales.php -->
<?php 
session_start();
include '../includes/header.php'; 
include '../includes/db.php';
include('config.php'); // Incluye la configuración de la base de datos


// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Obtener lista de ventas
$query = "SELECT ventas.*, productos.nombre AS producto_nombre, usuarios.nombre AS usuario_nombre 
          FROM ventas 
          JOIN productos ON ventas.producto_id = productos.id 
          JOIN usuarios ON ventas.usuario_id = usuarios.id";
$ventas = $conn->query($query);

if (!$ventas) {
    die("Error en la consulta: " . $conn->error);
}



$conn->close();
?>




<h2>Gestión de Ventas</h2>
<a href="add_sale.php">Agregar Venta</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['producto_nombre']; ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td>
                    <a href="edit_sale.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="../actions/delete_sale.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


<?php include '../includes/footer.php'; ?>

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

// Consulta para obtener las ventas
$sql = "SELECT ventas.id, productos.nombre AS producto, ventas.cantidad, ventas.total, ventas.fecha
        FROM ventas
        INNER JOIN productos ON ventas.producto_id = productos.id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Ventas</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye tu archivo de estilos -->
</head>
<body>
    <div class="container">
        <h1>Gestión de Ventas</h1>
        <a href="add_sale.php">Agregar Venta</a>
        <?php
        if ($result && $result->num_rows > 0) {
            echo '<table>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>'.$row["id"].'</td>
                        <td>'.$row["producto"].'</td>
                        <td>'.$row["cantidad"].'</td>
                        <td>'.$row["total"].'</td>
                        <td>'.$row["fecha"].'</td>
                        <td><a href="edit_sale.php?id='.$row["id"].'">Editar</a> | <a href="delete_sale.php?id='.$row["id"].'">Eliminar</a></td>
                    </tr>';
            }
            echo '</table>';
        } else {
            echo "No se encontraron ventas.";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
<?php include '../includes/footer.php'; ?>

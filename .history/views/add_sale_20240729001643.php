<?php
session_start();
include '../includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $usuario_id = $_SESSION['id']; // Asegúrate de que el usuario esté logueado y obtener su ID

    // Obtener el precio del producto para calcular el total
    $query = "SELECT precio FROM productos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    $precio = $producto['precio'];
    $total = $precio * $cantidad;

    // Insertar la venta en la base de datos
    $query = "INSERT INTO ventas (producto_id, usuario_id, cantidad, total) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiid", $producto_id, $usuario_id, $cantidad, $total);

    if ($stmt->execute()) {
        header("Location: ../views/sales.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Venta</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Venta</h1>
        <form action="add_sale.php" method="post">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" required>
                <?php
                $query = "SELECT id, nombre FROM productos";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
                }
                ?>
            </select>
            <br>
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" required>
            <br>
            <button type="submit">Agregar Venta</button>
        </form>
    </div>
</body>
</html>
<?php
$conn->close();
?>

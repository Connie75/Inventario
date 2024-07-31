<?php
session_start();
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar los datos recibidos del formulario
    $cliente_id = isset($_POST['cliente_id']) ? intval($_POST['cliente_id']) : 0;
    $productos = isset($_POST['productos']) ? $_POST['productos'] : [];
    $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;

    if ($cliente_id && !empty($productos) && $total > 0) {
        // Preparar la consulta de inserción para la factura
        $query = $conn->prepare("INSERT INTO facturas (cliente_id, total) VALUES (?, ?)");
        $query->bind_param("id", $cliente_id, $total);

        if ($query->execute()) {
            // Obtener el ID de la factura insertada
            $factura_id = $query->insert_id;

            // Insertar los productos en la tabla de detalles de la factura
            $query = $conn->prepare("INSERT INTO factura_detalles (factura_id, producto_id, cantidad) VALUES (?, ?, ?)");

            foreach ($productos as $producto) {
                $producto_id = intval($producto['producto_id']);
                $cantidad = intval($producto['cantidad']);
                $query->bind_param("iii", $factura_id, $producto_id, $cantidad);
                $query->execute();
            }

            // Redirigir al usuario a la lista de facturas
            header("Location: ../views/invoices.php");
            exit();
        } else {
            $error = "Error al agregar la factura: " . $query->error;
        }
    } else {
        $error = "Por favor, complete todos los campos obligatorios.";
    }
}

// Obtener la lista de clientes y productos para el formulario
$clientes_result = $conn->query("SELECT * FROM clientes");
$productos_result = $conn->query("SELECT * FROM productos");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Factura</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Agregar Factura</h1>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="add_invoice.php">
        <label for="cliente_id">Cliente:</label>
        <select name="cliente_id" id="cliente_id" required>
            <?php while ($cliente = $clientes_result->fetch_assoc()): ?>
                <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nombre']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="productos">Productos:</label>
        <div id="productos">
            <?php while ($producto = $productos_result->fetch_assoc()): ?>
                <div>
                    <input type="checkbox" name="productos[<?php echo $producto['id']; ?>][producto_id]" value="<?php echo $producto['id']; ?>">
                    <?php echo $producto['nombre']; ?>
                    <input type="number" name="productos[<?php echo $producto['id']; ?>][cantidad]" min="1" value="1">
                </div>
            <?php endwhile; ?>
        </div>
        <label for="total">Total:</label>
        <input type="number" name="total" id="total" step="0.01" required>
        <button type="submit">Agregar Factura</button>
    </form>
</body>
</html>

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
$query = "SELECT * FROM facturas WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$result = $stmt->get_result();
$invoice = $result->fetch_assoc();

if (!$invoice) {
    echo "Factura no encontrada.";
    exit();
}

// Obtener la lista de clientes
$clientes = $conn->query("SELECT * FROM clientes");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];
    $total = $_POST['total'];

    $query = "UPDATE facturas SET cliente_id = ?, total = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("idi", $cliente_id, $total, $invoice_id);

    if ($stmt->execute()) {
        header("Location: invoices.php");
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
    <title>Editar Factura</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Factura</h2>
        <form action="edit_invoice.php?id=<?php echo $invoice_id; ?>" method="post">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required>
                <?php while ($cliente = $clientes->fetch_assoc()): ?>
                    <option value="<?php echo $cliente['id']; ?>" <?php if ($cliente['id'] == $invoice['cliente_id']) echo 'selected'; ?>>
                        <?php echo $cliente['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="total">Total:</label>
            <input type="number" step="0.01" name="total" id="total" value="<?php echo $invoice['total']; ?>" required>
            <br>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
include '../includes/footer.php';
?>

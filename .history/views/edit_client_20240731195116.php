<?php
session_start();
include("../includes/header.php");
include("../includes/db.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    // Obtener los datos del cliente
    $result = $conn->query("SELECT * FROM clientes WHERE id = $id");
    $cliente = $result->fetch_assoc();
    if (!$cliente) {
        die("Cliente no encontrado.");
    }
} else {
    die("ID de cliente no válido.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="POST" action="../actions/edit_client.php?id=<?php echo $id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $cliente['nombre']; ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $cliente['email']; ?>" required>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="<?php echo $cliente['telefono']; ?>" required>
        <button type="submit">Actualizar Cliente</button>
    </form>
</body>
</html>
<?php
include("../includes/footer.php");
?>

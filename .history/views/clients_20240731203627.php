<?php
session_start();
include("../includes/header.php");
include("../includes/db.php");

// Consulta SQL para obtener todos los clientes
$sql = "SELECT * FROM clientes";
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
    <title>Clientes</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Clientes</h1>
    <a href="add_client.php">Agregar Cliente</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cliente = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cliente['id']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                    <td>
                        <a href="edit_client.php?id=<?php echo htmlspecialchars($cliente['id']); ?>">Editar</a>
                        <a href="../actions/delete_client.php?id=<?php echo htmlspecialchars($cliente['id']); ?>">Eliminar</a>
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

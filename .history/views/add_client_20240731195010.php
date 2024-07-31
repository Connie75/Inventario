<?php
session_start();
include("../includes/header.php");
include("../includes/db.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Agregar Cliente</h1>
    <form method="POST" action="../actions/add_client.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" required>
        <button type="submit">Agregar Cliente</button>
    </form>
</body>
</html>
<?php
include("../includes/footer.php");
?>

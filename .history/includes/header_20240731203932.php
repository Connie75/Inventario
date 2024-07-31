<!-- includes/header.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oficina de Inventario</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/scripts.js" defer></script>
</head>
<body>
    <header>
        <h1>Oficina de Inventario</h1>
        <nav>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="products.php">Productos</a></li>
        <li><a href="sales.php">Ventas</a></li>
        <li><a href="invoices.php">Facturas</a></li>
        <li><a href="users.php">Usuarios</a></li>
        <li><a href="clients.php">Clientes</a></li> <!-- Nuevo enlace a clientes -->
        <li><a href="logout.php">Cerrar sesión</a></li>
    </ul>
</nav>
    </header>
    <main>
    <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type']; ?>">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>
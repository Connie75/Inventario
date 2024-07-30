<!-- views/dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
?>
<h1>Bienvenido, <?php echo $_SESSION['nombre']; ?></h1>
<p>Tu rol es: <?php echo $_SESSION['rol']; ?></p>
<a href="../actions/logout.php">Cerrar sesión</a>
<?php include '../includes/footer.php'; ?>

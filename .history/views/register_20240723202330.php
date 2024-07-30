<!-- views/register.php -->
<?php include '../includes/header.php'; ?>
<form action="../actions/register.php" method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="rol" required>
        <option value="cliente">Cliente</option>
        <option value="trabajador">Trabajador</option>
        <option value="admin">Administrador</option>
    </select>
    <button type="submit">Registrar</button>
</form>
<?php include '../includes/footer.php'; ?>

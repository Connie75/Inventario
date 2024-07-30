<!-- views/login.php -->
<?php include '../includes/header.php'; ?>
<form action="../actions/login.php" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="button" id="togglePassword">Mostrar</button>
    <button type="submit">Login</button>
</form>
<?php include '../includes/footer.php'; ?>

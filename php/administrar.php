<?php
session_start(); 
require 'db.php'; // Asegúrate de que este archivo contiene la conexión a tu base de datos

if ($_SESSION['role'] != 'owner') {
    die("No tienes permiso para ver esta página");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $action = $_POST['action'];

    if ($action == 'ascend' && $_SESSION['id'] != $userId) {
        $sql = "UPDATE users SET role='admin' WHERE id=?";
    } elseif ($action == 'descend' && $_SESSION['id'] != $userId) {
        $sql = "UPDATE users SET role='user' WHERE id=?";
    } elseif ($action == 'delete' && $_SESSION['id'] != $userId) {
        $sql = "DELETE FROM users WHERE id=?";
    } else {
        die("Acción no permitida");
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);

    header("Location: administrar.php");
    exit;
}

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="../css/styleAdministrar.css">
</head>
<body>
<header>
    <div class="container">
        <div class="top-section">
            <img src="img/fixandgo.png" alt="Logo" class="logo">
            <h1>Fix and Go</h1>
        </div>
        <nav>
            <ul class="left-side">
                <?php
                if ($_SESSION['role'] == 'owner') {
                ?>
                    <li><a href="index.php" class="btn-header">Inicio</a></li>
                    <li><a href="php/Repair_Now.php" class="btn-header">Repair Now </a></li>
                    <li><a href="php/foro.php" class="btn-header">Foro</a></li>
                    <li><a href="php/live.php" class="btn-header">Live</a></li>
                    <li><a href="php/encuentros.php" class="btn-header">Encuentros</a></li>
                    <li><a href="php/administrar.php" class="btn-header">Administrar</a></li>
                <?php
                } else {
                ?>
                    <li><a href="index.php" class="btn-header">Inicio</a></li>
                    <li><a href="php/Repair_Now.php" class="btn-header">Repair Now </a></li>
                    <li><a href="php/foro.php" class="btn-header">Foro</a></li>
                    <li><a href="php/live.php" class="btn-header">Live</a></li>
                    <li><a href="php/encuentros.php" class="btn-header">Encuentros</a></li>
                <?php
                }
                ?>
            </ul>
            <ul class="right-side">
                <?php if ($_SESSION['loggedIn'] === true): ?> 
                    <li class="user-info"><a class="welcome-msg">Bienvenido, <?php echo $_SESSION['username']; ?></a></li>
                    <li class="user-info"><a href="php/logout.php" class="btn-header">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="user-info"><a href="php/register.php" class="btn-header">Registrarse</a></li>
                    <li class="user-info"><a href="php/login.php" class="btn-header">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main>

<table>
        <tr>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['role']; ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                    <button type="submit" name="action" value="ascend">Ascender</button>
                    <button type="submit" name="action" value="descend">Descender</button>
                    <button type="submit" name="action" value="delete">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</main>

<footer>
    <div class="container">
        <p>&copy; 2024 Fix and Go</p>
        <ul>
            <li><a href="#">Aviso legal</a></li>
            <li><a href="#">Política de privacidad</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </div>
</footer>
</body>
</html>


<?php
session_start(); 

include 'connect.php';

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $titulo = $_POST['titulo'];
    $tema = $_POST['tema'];
    $contenido = $_POST['contenido'];

    // Prepara la consulta SQL
    $stmt = $conn->prepare("INSERT INTO Blogs (titulo, tema, contenido, authors_id) VALUES (?, ?, ?, ?)");

    // Vincula los parámetros a la consulta
    $stmt->bind_param("sss", $titulo, $tema, $contenido, $_SESSION['user_id']);

    // Ejecuta la consulta
    $stmt->execute();

    // Redirige al usuario a la página de foros
    header("Location: foro.php");
} else {
    // Si el formulario no fue enviado, redirige al usuario a la página de creación de foros
    header("Location: createForum.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix and Go</title>
    <link rel="stylesheet" type="text/css" href="../css/styleForo.css">
</head>
<body>
<header>
    <div class="container">
        <div class="top-section">
        <img src="../img/fixandgo.png" alt="Logo" class="logo">
        <h1>Fix and Go</h1>
        </div>
        <nav>
            <ul class="left-side">
                <li><a href="../index.php" class="btn-header">Inicio</a></li>
                <li><a href="Repair_Now.php" class="btn-header">Repair Now </a></li>
                <li><a href="foro.php" class="btn-header">Foro</a></li>
                <li><a href="live.php" class="btn-header">Live</a></li>
                <li><a href="encuentros.php" class="btn-header">Encuentros</a></li>
            </ul>
            <ul class="right-side">
                <?php if ($_SESSION['loggedIn'] === true): ?>
                    <li class="user-info"><a class="welcome-msg">Bienvenido, <?php echo $_SESSION['username']; ?></a></li>
                    <li class="user-info"><a href="logout.php" class="btn-header">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="user-info"><a href="register.php" class="btn-header">Registrarse</a></li>
                    <li class="user-info"><a href="login.php" class="btn-header">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
    <h1>Bienvenido al Foro</h1>
    <main>
        <form action="publicar.php" method="post">
            <label for="titulo">Título:</label><br>
            <input type="text" id="titulo" name="titulo" required><br>
            <label for="tema">Tema:</label><br>
            <select id="tema" name="tema" required>
                <option value="">Selecciona un tema</option>
                <option value="tema1">Tema 1</option>
                <option value="tema2">Tema 2</option>
                <option value="tema3">Tema 3</option>
                <option value="tema4">Tema 4</option>
                <option value="tema5">Tema 5</option>
            </select><br>
            <label for="contenido">Contenido:</label><br>
            <textarea id="contenido" name="contenido" required></textarea><br>
            <input type="submit" value="Publicar">
        </form>
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
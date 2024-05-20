<?php
session_start(); 

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
        <section>
            <div class="post">
                <h2>Título del Post 1</h2>
                <p>Contenido del post 1...</p>
                <div class="comments">
                    <h3>Comentarios</h3>
                    <div class="comment">
                        <h4>Usuario 1</h4>
                        <p>Comentario 1...</p>
                    </div>
                    <!-- Agrega más comentarios según sea necesario -->
                </div>
            </div>
        
            <!-- Agrega más posts según sea necesario -->
        
            <div class="new-comment">
                <h2>Publicar un nuevo comentario</h2>
                <form>
                    <label for="username">Nombre de usuario:</label><br>
                    <input type="text" id="username" name="username"><br>
                    <label for="comment">Comentario:</label><br>
                    <textarea id="comment" name="comment"></textarea><br>
                    <input type="submit" value="Publicar">
                </form>
            </div>
        </section> 
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
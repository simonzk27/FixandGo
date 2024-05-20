<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones On Live</title>
    <link rel="stylesheet" type="text/css" href="../css/styleLive.css">
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
                <?php if (isset($_SESSION['username'])): ?>
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
<main class="main"> <!-- Añade la clase .main aquí -->
    <div class="container">
        <div class="video-chat-container">
            <div class="video-container">
                <!-- Contenido del video en vivo (video descargado en formato MP4) -->
                <video controls autoplay>
                    <source src="../img/Y2meta.app-Wil_ Ayúdame por favor mi iphone no tiene señal �� ��-(480p).mp4" type="video/mp4">
                    Tu navegador no soporta el elemento video.
                </video>
            </div>
            <div class="chat-container">
                <!-- Contenido del chat (aquí inserta tu chat) -->
                <script id="cid0020000374742593360" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 80%;height: 80%;">{"handle":"livefix","arch":"js","styles":{"a":"003166","b":100,"c":"FFFFFF","d":"FFFFFF","k":"003166","l":"003166","m":"003166","n":"FFFFFF","p":"10","q":"003166","r":100,"usricon":0,"fwtickm":1}}</script>
            </div>
        </div>
    </div>
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

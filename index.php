<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<header>
    <div class="container">
        <div class="top-section">
            <img src="img/fixandgo.png" alt="Logo" class="logo">
            <h1>Fix and Go.Samycp "tiene 5 tomos!!!!!</h1>
        </div>
        <nav>
            <ul class="left-side">
                <li><a href="index.php" class="btn-header">Inicio</a></li>
                <li><a href="php/Repair_Now.php" class="btn-header">Repair Now </a></li>
                <li><a href="php/foro.php" class="btn-header">Foro</a></li>
                <li><a href="php/live.php" class="btn-header">Live</a></li>
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
    <section class="hero">
        <div class="container">
            <h2 style="color: #333;">Reparar es cuidar, cada objeto cuenta</h2>
            <p style="color: #555;">En Fix and Go, nos apasiona reparar tus objetos favoritos. Brindamos servicios de reparación rápida y eficiente para una amplia gama de artículos, desde electrodomésticos hasta dispositivos electrónicos.</p>
            <a href="php/foro.php" class="btn-hero">Discusiones</a>
        </div>
    </section>

    <section class="servicios">
        <div class="container">
            <h2>Nuestros talleres</h2>
            <p>Reparar es vida, hoy en día nuestra sociedad se ve abrumada por el consumismo. Para ello, traemos una solución para su bolsillo y ayudar al medio ambiente. Nuestro taller ofrece la posibilidad de que pueda reparar sus objetos que aprecia o simplemente desea seguir usando. ¡Entra y aprende cómo reparar!</p>
            <a href="php/Repair_Now.php" class="btn-servicios">Explorar talleres</a>
        </div>
    </section>

    <!-- Sección Conócenos -->
    <section class="conocenos">
        <div class="container">
            <h2>Conócenos</h2>
            <p>Nosotros somos:</p>
            <p>Juan Camilo Mesa</p>
            <p>Michael Bohorquez</p>
            <p>Alejandro Bernal</p>
            <p>Simon Sanmiguel</p>
            <!-- Espacio para el logo -->
            <img src="img/fixandgo.png" alt="Logo Fix and Go" class="logo-conocenos">
        </div>
    </section>

    <section class="testimonios">
        <div class="container">
            <h2>Testimonios</h2>
            <div class="slider">
                <div class="testimonial">
                    <p>"Fix and Go me salvó el día! Mi teléfono estaba averiado y lo arreglaron en cuestión de horas. ¡Son increíbles!"</p>
                    <cite>- Ana López</cite>
                </div>
                <div class="testimonial">
                    <p>"Recomiendo encarecidamente Fix and Go. Son profesionales, honestos y eficientes. ¡Ya no voy a ningún otro lugar para reparar mis dispositivos!"</p>
                    <cite>- Juan Pérez</cite>
                </div>
                <div class="testimonial">
                    <p>"¡El servicio de Fix and Go es excelente! Me ayudaron a reparar mi ordenador de manera rápida y eficiente. ¡Muy recomendable!"</p>
                    <cite>- María Torres</cite>
                </div>
                <div class="testimonial">
                    <p>"Estoy muy satisfecho con Fix and Go. Repararon mi lavadora de forma impecable y a un precio justo. ¡Volveré a confiar en ellos!"</p>
                    <cite>- Pedro Martínez</cite>
                </div>
            </div>
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


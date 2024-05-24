<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar la batería de un iPhone X</title>
    <link rel="stylesheet" href="1.css">
</head>
<body>
<header>
    <div class="container">
        <div class="top-section">
        <img src="../../img/fixandgo.png" alt="Logo" class="logo">
        <h1>Fix and Go</h1>
        </div>
        <nav>
            <ul class="left-side">
                <li><a href="https://fixandgo.site/index.php" class="btn-header">Inicio</a></li>
                <li><a href="https://fixandgo.site/php/Repair_Now.php" class="btn-header">Repair Now </a></li>
                <li><a href="https://fixandgo.site/php/foro.php" class="btn-header">Foro</a></li>
                <li><a href="https://fixandgo.site/php/live.php" class="btn-header">Live</a></li>
            </ul>
            <ul class="right-side">
                <?php if ($_SESSION['loggedIn'] === true): ?>
                    <li class="user-info"><a class="welcome-msg">Bienvenido, <?php echo $_SESSION['username']; ?></a></li>
                    <li class="user-info"><a href="https://fixandgo.site/php/logout.php" class="btn-header">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="user-info"><a href="https://fixandgo.site/php/register.php" class="btn-header">Registrarse</a></li>
                    <li class="user-info"><a href="https://fixandgo.site/php/login.php" class="btn-header">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

    <main>
        <section class="introduccion">
            <div style="display: flex; align-items: start;">
                <img src="principal.jpg" alt="Imagen de un iPhone X" style="width:10%;height:10%;border-radius: 15px;"> 
                <div style="margin-left: 20px;">
                    <h2>Cambiar la batería de un iPhone X</h2>
                    <p>Autor: Fix and go</p>
                    <p>Fecha de subida: Fecha</p>
                </div>
            </div>
            <p>Esta guía te mostrará paso a paso cómo cambiar la batería de tu iPhone X. 
            **Importante:** Antes de comenzar, asegúrate de tener las herramientas y repuestos necesarios.</p>
        </section>

        <section class="herramientas" style="position: relative;">
            <div style="display: flex; align-items: start;"> 
                <div style="margin-left: 20px;">
                    <h2>Herramientas y repuestos necesarios</h2>
                    <ul>
                        <li>Destornillador pentalobe P2</li>
                        <li>Ventosa iSuction</li>
                        <li>Spudger (herramienta de plástico para abrir el teléfono)</li>
                        <li>Pinzas</li>
                        <li>Batería nueva para iPhone X (original o de alta calidad)</li>
                        <li>Adhesivo de sellado para iPhone X (opcional, pero recomendado)</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="pasos">
            <h2>Pasos</h2>
            <div style="display: flex; align-items: start;">
            <img src="apagar.jpg" alt="Apaga tu iPhone X" style="width:10%;height:10%;border-radius: 15px;">
                <div style="margin-left: 20px;">
                    <h3>1. Apaga tu iPhone X</h3>
                    <p style="margin-left: 20px;">Asegúrate de que tu iPhone X esté completamente apagado antes de comenzar.</p>
                </div>
            </div>

            <br>

            <div style="display: flex; align-items: start;">
            <img src="calienta.jpg" alt="Apaga tu iPhone X" style="width:10%;height:10%;border-radius: 15px;">
                <div style="margin-left: 20px;">
                    <h3>2. Calienta la parte frontal del iPhone</h3>
                    <p style="margin-left: 20px;">Calienta la parte frontal del iPhone con una pistola de aire caliente o un secador de pelo durante unos 30 segundos para ablandar el adhesivo.</p>
                </div>
            </div>

            <br>

            <div style="display: flex; align-items: start;">
            <img src="abrir.jpg" alt="Apaga tu iPhone X" style="width:10%;height:10%;border-radius: 15px;">
                <div style="margin-left: 20px;">
                    <h3>3. Abre el iPhone X</h3>
                    <p style="margin-left: 20px;">Utiliza una ventosa iSuction y un spudger para abrir cuidadosamente el iPhone X y desconectar los cables flexibles de la batería, la cámara frontal y el sensor de proximidad.</p>
                </div>
            </div>

            <br>

            <div style="display: flex; align-items: start;">
            <img src="retirar.jpg" alt="Apaga tu iPhone X" style="width:10%;height:10%;border-radius: 15px;">
                <div style="margin-left: 20px;">
                    <h3>4. Retira la batería vieja</h3>
                    <p style="margin-left: 20px;">Con cuidado, retira la batería vieja del iPhone X.</p>
                </div>
            </div>

            <br>

            <div style="display: flex; align-items: start;">
            <img src="nueva.jpg" alt="Apaga tu iPhone X" style="width:10%;height:10%;border-radius: 15px;">
                <div style="margin-left: 20px;">
                    <h3>5. Instala la batería nueva</h3>
                    <p style="margin-left: 20px;">Limpia el área donde estaba la batería vieja y coloca el adhesivo de sellado nuevo. Instala la batería nueva y conecta los cables flexibles.</p>
                </div>
            </div>

            <br>

            <div style="display: flex; align-items: start;">
            <img src="cerrar.jpg" alt="Apaga tu iPhone X" style="width:10%;height:10%;border-radius: 15px;">
                <div style="margin-left: 20px;">
                    <h3>6. Cierra el iPhone X</h3>
                    <p style="margin-left: 20px;">Presiona cuidadosamente la pantalla en su lugar para asegurarte de que quede bien sellada.</p>
                </div>
            </div>

            <br>

            <div style="display: flex; align-items: start;">
            <img src="encender.jpg" alt="Apaga tu iPhone X" style="width:10%;height:10%;border-radius: 15px;">
                <div style="margin-left: 20px;">
                    <h3>7. Enciende tu iPhone X</h3>
                    <p style="margin-left: 20px;">Enciende tu iPhone X y verifica que la batería funcione correctamente.</p>
                </div>
            </div>
        </section>

        <section class="conclusion">
            <h2>Comprobacion</h2>
            <p>Abre la aplicación Ajustes en tu iPhone X, toca Batería y toca Salud de la batería.
            <br>En esta pantalla, verás la siguiente información:
            <br>Capacidad máxima de la batería: Este es el porcentaje de la capacidad original de la batería que queda. Una batería nueva tiene una capacidad máxima del 100%. A medida que la batería envejece, su capacidad máxima disminuye.
            Capacidad de máximo rendimiento: Esta indica si la batería está proporcionando suficiente energía para que el iPhone funcione al máximo rendimiento. Si dice Normal, la batería está funcionando bien. Si dice Reducida, es posible que notes que el rendimiento del iPhone se ha ralentizado un poco.
            Batería necesita servicio: Si ves este mensaje, significa que la batería de tu iPhone está muy desgastada y necesita ser reemplazada.</p>
        </section>

        <section class="retroalimentacion">
            <h2>Retroalimentación</h2>
            <p>¿Fue útil este tutorial?</p>
            <button class = "yes" style="padding: 10px 20px; margin-right: 20px;">Sí, fue útil</button>
            <button class = "no" style="padding: 10px 20px;">No, no funcionó</button>
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

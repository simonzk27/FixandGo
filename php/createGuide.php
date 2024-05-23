<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fix and Go</title>
        <link rel="stylesheet" href="../css/styleCreateGuide.css">
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
        <main>
        
            <form action="processGuide.php" method="post" enctype="multipart/form-data">
                <label for="title">Título:</label><br>
                <input type="text" id="title" name="title" required><br>
                <input type="file" id="mainImage" name="mainImage" accept="image/*" style="display: none;">
                <label for="mainImage" class="custom-file-upload" onclick="triggerClick('mainImage')">Examinar...</label><br>
                <label for="description">Descripción:</label><br>
                <textarea id="description" name="description" required></textarea><br>
                <label for="tools">Herramientas y Repuestos necesarios:</label><br>
                <textarea id="tools" name="tools"></textarea><br>
                <div id="steps">
                    <label for="stepTitle1">Título del paso 1:</label><br>
                    <input type="text" id="stepTitle1" name="stepTitles[]"><br>
                    <label for="stepDescription1">Descripción del paso 1:</label><br>
                    <textarea id="stepDescription1" name="stepDescriptions[]"></textarea><br>
                    <label>Imagen del paso 1:</label><br>
                    <label for="stepImage1" class="custom-file-upload">Examinar...</label>
                    <input type="file" id="stepImage1" name="stepImages[]" accept="image/*" style="display: none;"><br>
                </div>
                <button type="button" onclick="addStep()">Agregar paso</button><br>
                <br></br>
                <input type="submit" value="Crear guía">
            </form>
            <script>
                function triggerClick(id) {
                    document.getElementById(id).click();
                }

                // Agrega un event listener a cada elemento con la clase 'custom-file-upload'
                var fileUploads = document.getElementsByClassName('custom-file-upload');
                for (var i = 0; i < fileUploads.length; i++) {
                    fileUploads[i].addEventListener('click', function() {
                        var inputId = this.getAttribute('for');
                        triggerClick(inputId);
                    });
                }
            </script>
        </main>
        <script>
            let stepCount = 1;
            function addStep() {
                stepCount++;
                const stepsDiv = document.getElementById('steps');
                const newStep = document.createElement('div');
                newStep.setAttribute('id', 'step' + stepCount);
                newStep.innerHTML = `
                    <label for="stepTitle${stepCount}">Título del paso ${stepCount}:</label><br>
                    <input type="text" id="stepTitle${stepCount}" name="stepTitles[]"><br>
                    <label for="stepDescription${stepCount}">Descripción del paso ${stepCount}:</label><br>
                    <textarea id="stepDescription${stepCount}" name="stepDescriptions[]"></textarea><br>
                    <input type="file" id="stepImage${stepCount}" name="stepImages[]" accept="image/*" style="display: none;">
                    <label for="stepImage${stepCount}" class="custom-file-upload" onclick="triggerClick('stepImage${stepCount}')">Examinar...</label><br>
                    <button type="button" onclick="removeStep(${stepCount})">Eliminar paso</button><br>
                    <br></br>
                `;
                stepsDiv.appendChild(newStep);
            }

            function removeStep(stepNumber) {
                const stepToRemove = document.getElementById('step' + stepNumber);
                stepToRemove.parentNode.removeChild(stepToRemove);
                stepCount--;
            }
        </script> 
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
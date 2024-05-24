<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$basePath = __DIR__ . '/../guides/';
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->query("SELECT IFNULL(MAX(id), 0) AS maxId FROM Repairs");
    $row = $stmt->fetch_assoc();
    $guideId = $row['maxId'] + 1;
    $guideDirPath = $basePath . 'g' . $guideId;
    if (!is_dir($guideDirPath)) {
        mkdir($guideDirPath, 0777, true);
    }

    $guideFilePath = $guideDirPath . '/guia.php';
    // Recoge los datos del formulario
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $tools = htmlspecialchars($_POST['tools']);
    $stepTitles = array_map('htmlspecialchars', $_POST['stepTitles']);
    $stepDescriptions = array_map('htmlspecialchars', $_POST['stepDescriptions']);

    // Crea el contenido de la guía
    $guideContent = <<<HTML
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$title</title>
        <link rel="stylesheet" href="/../guides/1.css">
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
    HTML;

    if ($_SESSION['loggedIn'] === true) {
        $guideContent .= <<<HTML
                    <li class="user-info"><a class="welcome-msg">Bienvenido, {$_SESSION['username']}</a></li>
                    <li class="user-info"><a href="https://fixandgo.site/php/logout.php" class="btn-header">Cerrar sesión</a></li>
    HTML;
    } else {
        $guideContent .= <<<HTML
                    <li class="user-info"><a href="https://fixandgo.site/php/register.php" class="btn-header">Registrarse</a></li>
                    <li class="user-info"><a href="https://fixandgo.site/php/login.php" class="btn-header">Iniciar sesión</a></li>
    HTML;
    }

    $guideContent .= <<<HTML
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="introduccion">
            <div style="display: flex; align-items: start;">
                <img src="principal.jpg" alt="Imagen" style="width:10%;height:10%;border-radius: 15px;"> 
                <div style="margin-left: 20px;">
                    <h2>$title</h2>
                    <p>Autor: {$_SESSION['username']}</p>
                </div>
            </div>
            <p>$description</p>
        </section>
        <section class="herramientas" style="position: relative;">
            <div style="display: flex; align-items: start;"> 
                <div style="margin-left: 20px;">
                    <h2>Herramientas y repuestos necesarios</h2>
                    <ul>$tools</ul>
                    <button class="herramientas" style="position: absolute; right: 20px; bottom: 20px;">Encuentra las herramientas</button>
                </div>
            </div>
        </section>
        <section class="pasos">
            <h2>Pasos</h2>
    HTML;

    // Añade cada paso a la guía
    for ($i = 0; $i < count($stepTitles); $i++) {
        $stepNumber = $i + 1;
        $stepTitle = $stepTitles[$i];
        $stepDescription = $stepDescriptions[$i];

        $guideContent .= <<<HTML
            <div style="display: flex; align-items: start;">
            <img src="" alt="Imagen" style="width:10%;height:10%;border-radius: 15px;"> 
                <div style="margin-left: 20px;">
                    <h3>$stepNumber. $stepTitle</h3>
                    <p style="margin-left: 20px;">$stepDescription</p>
                </div>
            </div>
    HTML;
    }

    $guideContent .= <<<HTML
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
    HTML;


    // Guarda el contenido de la guía en un archivo HTML
    file_put_contents($guideFilePath, $guideContent);

    
    $guideUrl = 'https://fixandgo.site/guides/g' . $guideId . '/guia.php';

    // Manejo de la carga de la imagen principal
    if (isset($_FILES['mainImage']) && $_FILES['mainImage']['error'] === UPLOAD_ERR_OK) {
        // Obtén la extensión del archivo
        $fileTmpPath = $_FILES['mainImage']['tmp_name'];
        $fileName = $_FILES['mainImage']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Cambia el nombre del archivo a "principal.elformatooriginal"
        $newFileName = 'principal.' . $fileExtension;

        // Mueve el archivo al directorio de la guía
        $dest_path = $guideDirPath . '/' . $newFileName;
        move_uploaded_file($fileTmpPath, $dest_path);
    }

    // Asegúrate de que tu tabla Repairs tenga una columna para la imagen
    $imagePath = isset($dest_path) ? $dest_path : null;
    $stmt = $conn->prepare("INSERT INTO Repairs (title, url, authors_id, image_url, descripcion) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $guideUrl, $_SESSION['user_id'], $imagePath, $description]);

}
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
        <h2>Crear guía</h2>
            <form method="POST" action="" onsubmit="return confirmCreation()">
                <label for="title">Título:</label><br>
                <input type="text" id="title" name="title" required><br>
                <label for="mainImage">Imagen Principal:</label><br>
                <input type="file" id="mainImage" name="mainImage" accept="image/*"><br>
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
                    <input type="file" id="stepImage1" name="stepImages[]" accept="image/*"><br>
                </div>
                <button type="button" onclick="addStep()">Agregar paso</button><br>
                <br></br>
                <input type="submit" value="Crear guía">
            </form>
            <script>
                let stepCount = 1;
                function addStep() {
                    // Hide the remove button for the previous step
                    if (stepCount > 1) {
                        const previousStepRemoveButton = document.querySelector(`#step${stepCount} .remove-button`);
                        previousStepRemoveButton.style.display = 'none';
                    }

                    stepCount++;
                    const stepsDiv = document.getElementById('steps');
                    const newStep = document.createElement('div');
                    newStep.setAttribute('id', 'step' + stepCount);
                    newStep.innerHTML = `
                        <label for="stepTitle${stepCount}">Título del paso ${stepCount}:</label><br>
                        <input type="text" id="stepTitle${stepCount}" name="stepTitles[]"><br>
                        <label for="stepDescription${stepCount}">Descripción del paso ${stepCount}:</label><br>
                        <textarea id="stepDescription${stepCount}" name="stepDescriptions[]"></textarea><br>
                        <input type="file" id="stepImage${stepCount}" name="stepImages[]" accept="image/*"><br>
                        <button type="button" class="remove-button" onclick="removeStep(${stepCount})">Eliminar paso</button><br>
                    `;
                    stepsDiv.appendChild(newStep);
                }

                function removeStep(stepNumber) {
                    if (stepNumber === stepCount && stepCount > 1) {
                        const stepToRemove = document.getElementById('step' + stepNumber);
                        stepToRemove.parentNode.removeChild(stepToRemove);
                        stepCount--;

                        // Show the remove button for the new last step
                        if (stepCount > 1) {
                            const lastStepRemoveButton = document.querySelector(`#step${stepCount} .remove-button`);
                            lastStepRemoveButton.style.display = 'block';
                        }
                    }
                }
                function confirmCreation() {
                    alert("¡Guía creada con éxito!");
                    return true;
                }
            </script>
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
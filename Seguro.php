<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Archivos Segura</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directorio para almacenar archivos
    $uploadDirectory = "uploads/";

    // Verificar si el directorio de carga existe, si no, crearlo
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Validar si se subió un archivo
    if (isset($_FILES["archivo"])) {
        $archivo = $_FILES["archivo"];

        // Validar si no hubo errores durante la carga
        if ($archivo["error"] == UPLOAD_ERR_OK) {
            // Validar el tipo de archivo permitido (ejemplo: solo imágenes)
            $allowedTypes = array("image/jpeg", "image/png", "image/gif");
            if (in_array($archivo["type"], $allowedTypes)) {
                // Generar un nombre único para el archivo
                $nombreArchivo = uniqid() . "_" . basename($archivo["name"]);

                // Mover el archivo al directorio de carga
                $rutaArchivo = $uploadDirectory . $nombreArchivo;
                move_uploaded_file($archivo["tmp_name"], $rutaArchivo);

                echo "¡Archivo cargado con éxito!";
            } else {
                echo "Error: Solo se permiten archivos de imagen (jpeg, png, gif).";
            }
        } else {
            echo "Error al cargar el archivo. Código de error: " . $archivo["error"];
        }
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="archivo">Seleccione un archivo:</label>
    <input type="file" name="archivo" id="archivo" accept=".jpg, .jpeg, .png, .gif" required>
    <br>
    <input type="submit" value="Cargar Archivo">
</form>

</body>
</html>

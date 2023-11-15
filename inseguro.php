<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Archivos Insegura</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directorio para almacenar archivos
    $uploadDirectory = "uploads/";

    // Validar si se subió un archivo
    if (isset($_FILES["archivo"])) {
        $archivo = $_FILES["archivo"];

        // Mover el archivo al directorio de carga sin realizar validaciones
        $rutaArchivo = $uploadDirectory . basename($archivo["name"]);
        move_uploaded_file($archivo["tmp_name"], $rutaArchivo);

        echo "¡Archivo cargado con éxito!";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="archivo">Seleccione un archivo:</label>
    <input type="file" name="archivo" id="archivo" required>
    <br>
    <input type="submit" value="Cargar Archivo">
</form>

</body>
</html>
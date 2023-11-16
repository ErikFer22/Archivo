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
    $targetDir = "uploads/";
    $originalFileName = $_FILES["fileToUpload"]["name"];
    $targetFile = $targetDir . basename($originalFileName);
    $uploadOk = 1;

    // Obtener la extensión del archivo
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Definir las extensiones permitidas
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    // Verificar si la extensión es permitida
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Solo se permiten archivos con extensiones: " . implode(", ", $allowedExtensions);
        $uploadOk = 0;
    }

    // Verificar si hay errores antes de subir el archivo
    if ($uploadOk == 0) {
        echo "Hubo un error al subir el archivo.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "El archivo ". htmlspecialchars($originalFileName). " ha sido subido.";
        } else {
            echo " Hubo un error al subir el archivo.";
        }
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    Selecciona un archivo para subir:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Subir Archivo" name="submit">
</form>
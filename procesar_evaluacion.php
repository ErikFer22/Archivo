<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directorio donde se almacenarán las evaluaciones
    $target_dir = "uploads/";

    // Generar un nombre único para la evaluación
    $target_file = $target_dir . uniqid() . basename($_FILES["evidence"]["name"]);

    // Obtener el tipo MIME del archivo
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validar el tipo MIME (solo permitir archivos PDF)
    if ($fileType != "pdf") {
        echo "Solo se permiten archivos PDF.";
    } else {
        // Validar el tamaño del archivo (2 Megabytes máximo)
        if ($_FILES["evidence"]["size"] > 2 * 1024 * 1024) {
            echo "El archivo es demasiado grande. Tamaño máximo permitido: 2MB.";
        } else {
            // Verificar el tipo MIME del archivo PDF nuevamente
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES["evidence"]["tmp_name"]);
            finfo_close($finfo);

            if ($mime !== "application/pdf") {
                echo "El archivo no es un PDF válido.";
            } else {
                // Mover el archivo al directorio de destino
                if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $target_file)) {
                    echo "La evaluación se ha subido correctamente.";
                } else {
                    echo "Error al subir el archivo.";
                }
            }
        }
    }
}
?>

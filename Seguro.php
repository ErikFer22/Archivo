<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Teacher evaluation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 400px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Teacher evaluation</h1>

    <!-- Form to upload evaluation files -->
    <form action="procesar_evaluacion.php" method="post" enctype="multipart/form-data" onsubmit="return validarPDF()">
        <label for="evidence">Subir Evaluación (PDF):</label>
        <input type="file" id="evidence" name="evidence" accept=".pdf" required>
        <br>
        <small>Tamaño máximo: 2MB</small>
        <br>
        <button type="submit">Subir Evaluación</button>
    </form>

    <script>
        function validarPDF() {
            var inputFile = document.getElementById('evidence');
            var file = inputFile.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onloadend = function (e) {
                    var arr = (new Uint8Array(e.target.result)).subarray(0, 4);
                    var header = "";
                    for (var i = 0; i < arr.length; i++) {
                        header += arr[i].toString(16);
                    }

                    // Verificar el encabezado del archivo PDF
                    if (header !== "25504446") {
                        alert("Por favor, selecciona un archivo PDF válido.");
                        // Detener la propagación del evento submit si no es un PDF válido
                        return false;
                    }
                };

                // Leer los primeros 4 bytes del archivo (suficientes para determinar si es un PDF)
                reader.readAsArrayBuffer(file.slice(0, 4));
            }

            return true;
        }
    </script>

</body>
</html>

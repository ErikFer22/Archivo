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
    <form action="procesar_evaluacion.php" method="post" enctype="multipart/form-data">
        <label for="evidence">Upload Evaluation (PDF):</label>
        <input type="file" name="evidence" accept=".pdf" required>
        <br>
        <small>Maximum size: 2MB</small>
        <br>
        <button type="submit">Upload Evaluation</button>
    </form>
</body>
</html>

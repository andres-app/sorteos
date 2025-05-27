<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Unirse al sorteo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= URLROOT ?>/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>¡Únete al sorteo en vivo!</h2>
        <form action="<?= URLROOT ?>/SorteoController/unirse" method="POST">
            <label for="codigo">Código del sorteo:</label>
            <input type="text" name="codigo" required placeholder="Ej: SRT-1234"><br>

            <label for="nombre">Tu nombre o apodo:</label>
            <input type="text" name="nombre" required><br>

            <button type="submit">Unirme al sorteo</button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Sorteo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: radial-gradient(circle at center, #1c1c1c, #000);
            color: white;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        a {
            display: inline-block;
            margin: 0.5rem;
            padding: 1rem 2rem;
            background-color: #00ffc8;
            color: #000;
            border-radius: 10px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        a:hover {
            background-color: #00d6a6;
        }
    </style>
</head>
<body>
    <h1>🎉 Bienvenido al sistema de sorteos</h1>
    <a href="<?php echo URLROOT; ?>/sorteo">🎰 Ver sorteo</a>

    <a href="<?php echo URLROOT; ?>/ingresar">📝 Unirme al sorteo</a>
</body>
</html>

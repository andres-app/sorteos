<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Unirse al sorteo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: radial-gradient(circle at center, #282c34 0%, #000000 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #ffffff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #ddd;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 0.9rem;
            background-color: #00ffcc;
            color: #000;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #1effd5;
        }

        @media (max-width: 500px) {
            h2 {
                font-size: 1.5rem;
            }

            button {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🎉 ¡Únete al sorteo en vivo! 🎉</h2>
        <form action="<?php echo URLROOT; ?>/SorteoController/unirse" method="POST">
            <label for="codigo">Código del sorteo:</label>
            <input type="text" name="codigo" required placeholder="Ej: SRT-1234">

            <label for="nombre">Tu nombre o apodo:</label>
            <input type="text" name="nombre" required placeholder="Ej: Camila, Leo, etc.">

            <button type="submit">🎟 Unirme al sorteo</button>
        </form>
    </div>
</body>
</html>

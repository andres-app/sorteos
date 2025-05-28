<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sorteo en vivo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: 'Segoe UI', sans-serif;
            background: radial-gradient(circle at center, #282c34 0%, #000000 100%);
            color: white;
            overflow: hidden;
        }

        main {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            text-align: center;
            padding: 0 5vw;
        }

        h1 {
            font-size: clamp(24px, 6vw, 48px);
            margin: 0;
        }

        #icono {
            font-size: clamp(40px, 10vw, 100px);
        }

        #contador {
            font-size: clamp(60px, 15vw, 120px);
            animation: pulse 1s infinite;
        }

        #ganador {
            font-size: clamp(24px, 6vw, 60px);
            font-weight: bold;
            color: #00ffcc;
            display: none;
            animation: popIn 0.8s ease-out forwards;
        }

        button {
            font-size: clamp(18px, 4vw, 28px);
            padding: 1rem 2.5rem;
            background-color: #00ffcc;
            border: 2px solid white;
            border-radius: 12px;
            color: #000;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
            background-color: #1effd5;
        }

        #participantes {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 1rem;
            border-radius: 10px;
            max-height: 30vh;
            overflow-y: auto;
            width: 90%;
            max-width: 600px;
            margin-top: 2vh;
        }

        #participantes h2 {
            font-size: clamp(20px, 4vw, 28px);
            margin-bottom: 1rem;
        }

        #listaParticipantes {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        #listaParticipantes li {
            background-color: #00ffcc;
            color: #000;
            padding: 0.6rem 1.2rem;
            border-radius: 999px;
            font-size: clamp(14px, 3vw, 20px);
            font-weight: bold;
            transition: all 0.3s ease;
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            60% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }

        #listaParticipantes li {
            background-color: #00ffcc;
            color: #000;
            padding: 0.6rem 1.2rem;
            border-radius: 999px;
            font-size: clamp(14px, 3vw, 20px);
            font-weight: bold;
            transition: all 0.3s ease;
            animation: bounceIn 0.5s ease;
        }


        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 600px) {

            h1,
            #ganador {
                font-size: clamp(22px, 8vw, 40px);
            }

            button {
                font-size: clamp(16px, 6vw, 24px);
                padding: 0.8rem 2rem;
            }
        }
    </style>

</head>

<body>
    <main>
        <h1>🎉 Sorteo en Vivo 🎉</h1>
        <div id="icono">🎊</div>
        <div id="contador"></div>
        <div id="ganador"></div>
        <div id="participantes">
            <h2>Participantes</h2>
            <ul id="listaParticipantes"></ul>
        </div>

        <button id="botonSorteo" onclick="iniciarSorteo()">🎊 Iniciar Sorteo</button>
    </main>

    <script>
        function iniciarSorteo() {
            const contador = document.getElementById("contador");
            const ganadorDiv = document.getElementById("ganador");
            const boton = document.getElementById("botonSorteo");

            boton.disabled = true;
            boton.textContent = "Girando...";
            ganadorDiv.style.display = "none";

            let cuenta = 5;
            contador.textContent = cuenta;

            const interval = setInterval(() => {
                cuenta--;
                if (cuenta > 0) {
                    contador.textContent = cuenta;
                } else {
                    clearInterval(interval);
                    contador.textContent = "🎊";

                    fetch("http://localhost:8080/sorteos/public/SorteoController/elegirGanador")
                        .then(res => res.json())
                        .then(data => {
                            if (data.nombre) {
                                ganadorDiv.textContent = "🎉 Ganador: " + data.nombre + " 🎉";
                            } else {
                                ganadorDiv.textContent = "❌ No hay participantes.";
                            }

                            ganadorDiv.style.display = "block";
                            boton.textContent = "🎰 Girar otra vez";
                            boton.disabled = false;
                        })
                        .catch(() => {
                            ganadorDiv.textContent = "⚠️ Error al contactar al servidor.";
                            ganadorDiv.style.display = "block";
                            boton.textContent = "🎰 Girar otra vez";
                            boton.disabled = false;
                        });
                }
            }, 1000);
        }

        function cargarParticipantes() {
            fetch("http://localhost:8080/sorteos/public/SorteoController/obtenerParticipantes")
                .then(res => res.json())
                .then(data => {
                    console.log("Participantes cargados:", data);

                    const lista = document.getElementById("listaParticipantes");
                    lista.innerHTML = "";
                    data.forEach(p => {
                        const li = document.createElement("li");
                        li.textContent = p.nombre;
                        lista.appendChild(li);
                    });
                })
                .catch(error => {
                    console.error("❌ Error al obtener participantes:", error);
                });
        }

        cargarParticipantes(); // Ejecuta al cargar la página
        setInterval(cargarParticipantes, 1000); // Ejecuta cada 1 segundo
    </script>
</body>

</html>
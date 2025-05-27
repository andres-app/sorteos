<?php
class SorteoController extends Controller
{
    public function index()
    {
        $this->view('inicio');
    }


    public function ingresar()
    {
        $this->view('ingresar');
    }

    public function unirse()
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];

        $sorteoModel = $this->model('SorteoModel');
        $sorteo = $sorteoModel->buscarSorteoPorCodigo($codigo);

        if ($sorteo) {
            $yaRegistrado = $sorteoModel->verificarParticipante($sorteo['id'], $nombre);
            if (!$yaRegistrado) {
                $sorteoModel->registrarParticipante($sorteo['id'], $nombre);
                echo "¡Bienvenido al sorteo, $nombre!";
            } else {
                echo "Ya estás registrado en este sorteo.";
            }
        } else {
            echo "Código no válido.";
        }
    }

    public function sorteo()
    {
        $this->view('sorteo');
    }

    public function elegirGanador()
    {
        header('Content-Type: application/json');

        try {
            $modelo = $this->model('SorteoModel');
            $ganador = $modelo->seleccionarGanadorAleatorio(1); // sorteo_id fijo

            if ($ganador) {
                echo json_encode(["nombre" => $ganador['nombre']]);
            } else {
                echo json_encode(["nombre" => null]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error interno del servidor"]);
        }
    }
    public function obtenerParticipantes() {
        header('Content-Type: application/json');
    
        try {
            $modelo = $this->model('SorteoModel');
            $participantes = $modelo->listarParticipantes(1); // sorteo_id fijo
    
            if (is_array($participantes)) {
                echo json_encode($participantes);
            } else {
                echo json_encode([]); // por si no devuelve nada
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error en el servidor"]);
        }
    
        exit; // IMPORTANTE: asegura que no se envíe nada más
    }
    



}


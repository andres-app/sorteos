<?php
class SorteoModel
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function buscarSorteoPorCodigo($codigo)
    {
        $stmt = $this->db->prepare("SELECT * FROM sorteos WHERE codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function verificarParticipante($sorteo_id, $nombre)
    {
        $stmt = $this->db->prepare("SELECT id FROM participantes WHERE sorteo_id = ? AND nombre = ?");
        $stmt->bind_param("is", $sorteo_id, $nombre);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function registrarParticipante($sorteo_id, $nombre)
    {
        $stmt = $this->db->prepare("INSERT INTO participantes (sorteo_id, nombre) VALUES (?, ?)");
        $stmt->bind_param("is", $sorteo_id, $nombre);
        return $stmt->execute();
    }

    public function seleccionarGanadorAleatorio($sorteo_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM participantes WHERE sorteo_id = ? ORDER BY RAND() LIMIT 1");
        $stmt->bind_param("i", $sorteo_id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();

        if ($resultado) {
            // Guardar en tabla ganadores
            $stmt2 = $this->db->prepare("INSERT INTO ganadores (sorteo_id, participante_id) VALUES (?, ?)");
            $stmt2->bind_param("ii", $sorteo_id, $resultado['id']);
            $stmt2->execute();
        }

        return $resultado;
    }

    public function listarParticipantes($sorteo_id) {
        $stmt = $this->db->prepare("SELECT nombre FROM participantes WHERE sorteo_id = ?");
        $stmt->bind_param("i", $sorteo_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // <- DEBE DEVOLVER array válido
    }
    


}

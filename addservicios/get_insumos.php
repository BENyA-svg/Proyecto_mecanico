<?php
include('../conexionbd.php');

if (isset($_GET['id_service'])) {
    $id_service = $_GET['id_service'];
    $query = "SELECT e.nombre AS etapa, i.tipo AS insumo, n.cantidad
              FROM etapa e
              JOIN tienen_etapa_service tes ON e.id_etapa = tes.id_etapa
              JOIN necesitan n ON e.id_etapa = n.id_etapa
              JOIN insumos i ON n.id_insumo = i.id_insumos
              WHERE tes.id_service = '$id_service'
              ORDER BY e.nombre";
    $result = $con->query($query);
    $detalles = [];
    while ($row = $result->fetch_assoc()) {
        $detalles[] = $row;
    }
    echo json_encode($detalles);
} else {
    echo json_encode([]);
}
?>

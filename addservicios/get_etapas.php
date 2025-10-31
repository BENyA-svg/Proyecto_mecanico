<?php
include('../conexionbd.php');

if (isset($_GET['id_service'])) {
    $id_service = $_GET['id_service'];
    $query = "SELECT e.nombre FROM etapa e JOIN tienen_etapa_service tes ON e.id_etapa = tes.id_etapa WHERE tes.id_service = '$id_service'";
    $result = $con->query($query);
    $etapas = [];
    while ($row = $result->fetch_assoc()) {
        $etapas[] = $row;
    }
    echo json_encode($etapas);
} else {
    echo json_encode([]);
}
?>

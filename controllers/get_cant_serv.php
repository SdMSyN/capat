<?php

include('../config/conexion.php');
include('../config/variables.php');
$servs = array();
$msgErr = '';
$ban = false;

$idCuota = $_POST['idCuota'];

//Obtenemos el monto del servicio seleccionado
$sqlGetCom = "SELECT $tCuotas.cantidad as cant "
        . "FROM $tCuotas "
        . "WHERE $tCuotas.id = '$idCuota' ";

$resGetCom = $con->query($sqlGetCom);
if ($resGetCom->num_rows > 0) {
    while ($rowGetCom = $resGetCom->fetch_assoc()) {
        $cant = $rowGetCom['cant'];
        $servs[] = array('cant' => $cant);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen cuotas en éste servicio.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $servs, "sql2"=>$sqlGetCom));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, "sql2"=>$sqlGetCom));
}
?>
<?php

include('../config/conexion.php');
include('../config/variables.php');
$years = array();
$msgErr = '';
$ban = false;

$idUser = $_POST['idUser'];
$sqlGetIdColony = "SELECT $tDirs.comunidad_id as idColony "
        . " FROM $tUsersData"
        . " INNER JOIN $tDirs ON $tDirs.id = $tUsersData.direccion_id"
        . " WHERE $tUsersData.id = '$idUser' ";
$resGetIdColony = $con->query($sqlGetIdColony);
$rowGetColony = $resGetIdColony->fetch_assoc();
$idColony = $rowGetColony['idColony'];

$sqlGetCom = "SELECT DISTINCT $tCuotas.year as yearCuota "
        . "FROM $tCuotas "
        . "INNER JOIN $tTypeServ ON $tTypeServ.id=$tCuotas.tipo_servicio_id "
        . "WHERE $tCuotas.comunidad_id='$idColony' ORDER BY yearCuota DESC";

$resGetCom = $con->query($sqlGetCom);
if ($resGetCom->num_rows > 0) {
    while ($rowGetCom = $resGetCom->fetch_assoc()) {
        $id = $rowGetCom['yearCuota'];
        $name = $rowGetCom['yearCuota'];
        $years[] = array('id' => $id, 'nombre' => $name);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen años de servicios aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $years, "sql"=>$sqlGetIdColony, "sql2"=>$sqlGetCom));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, "sql"=>$sqlGetIdColony, "sql2"=>$sqlGetCom));
}
?>
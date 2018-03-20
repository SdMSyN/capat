<?php

include('../config/conexion.php');
include('../config/variables.php');
$servs = array();
$msgErr = '';
$ban = false;

$idYear = $_POST['year'];
$idUser = $_POST['idUser'];

//Obtenemos la colonia del usuario
$sqlGetIdColony = "SELECT $tDirs.comunidad_id as idColony "
        . " FROM $tUsersData"
        . " INNER JOIN $tDirs ON $tDirs.id = $tUsersData.direccion_id"
        . " WHERE $tUsersData.id = '$idUser' ";
$resGetIdColony = $con->query($sqlGetIdColony);
$rowGetColony = $resGetIdColony->fetch_assoc();
$idColony = $rowGetColony['idColony'];

//Obtenemos los tipos de servicio (id)
$sqlGetCom = "SELECT $tCuotas.id as idCuota, $tTypeServ.nombre as nameTypeServ "
        . "FROM $tCuotas "
        . "INNER JOIN $tTypeServ ON $tTypeServ.id = $tCuotas.tipo_servicio_id " 
        . "WHERE $tCuotas.year = '$idYear' AND $tCuotas.comunidad_id = '$idColony' ";

$resGetCom = $con->query($sqlGetCom);
if ($resGetCom->num_rows > 0) {
    while ($rowGetCom = $resGetCom->fetch_assoc()) {
        $id = $rowGetCom['idCuota'];
        $name = $rowGetCom['nameTypeServ'];
        $servs[] = array('id' => $id, 'nombre' => $name);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen servicios aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $servs, "sql2"=>$sqlGetCom));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr, "sql2"=>$sqlGetCom));
}
?>
<?php

include('../config/conexion.php');
include('../config/variables.php');
$pagos = array();
$msgErr = '';
$ban = false;

$sqlGetPays = "SELECT $tUsersData.name as nameUser, $tUsersData.ap as apUser, $tUsersData.am as amUser, "
        . "$tUsersData.tarjeta as tarjUser, $tUsersData.folio as folioUser, $tContratos.numero_contrato as numContr, "
        . "Date_format($tPays.fecha_inicio, '%m-%Y') as inicioFecha, Date_format($tPays.fecha_fin, '%m-%Y') as finFecha, "
        . "$tPays.monto as monto, $tPays.id as idPay  "
        . "FROM $tPays "
        . "INNER JOIN $tUsersData ON $tUsersData.id = $tPays.usuario_data_id "
        . "INNER JOIN $tContratos ON $tContratos.id = $tUsersData.contrato_id "
        . "WHERE $tPays.estatus_id = '2'  ";


//Buscar
$query = (isset($_POST['query'])) ? $_POST['query'] : "";
if ($query != '') {
    $sqlGetPays .= " AND $tUsersData.name LIKE '%$query%' ";
    $sqlGetPays .= " OR $tUsersData.ap LIKE '%$query%' ";
    $sqlGetPays .= " OR $tUsersData.am LIKE '%$query%' ";
    $sqlGetPays .= " OR $tUsersData.tarjeta LIKE '%$query%' ";
    $sqlGetPays .= " OR $tUsersData.folio LIKE '%$query%' ";
    $sqlGetPays .= " OR $tContratos.numero_contrato LIKE '%$query%' ";
    $sqlGetPays .= " OR $tPays.ticket LIKE '%$query%' ";
}
/*
//editar (buscar por ID)
$edit = (isset($_POST['idColony'])) ? $_POST['idColony'] : "";
if ($edit != '') {
    $sqlGetCom .= " AND $tTypeServ.id = $edit ";
}
*/
//Ordenar ASC y DESC
$vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
if ($vorder != '') {
    $sqlGetPays .= " ORDER BY " . $vorder;
}


$resGetPays = $con->query($sqlGetPays);
if ($resGetPays->num_rows > 0) {
    while ($rowGetPay = $resGetPays->fetch_assoc()) {
        $id = $rowGetPay['idPay'];
        $name = $rowGetPay['nameUser'].' '.$rowGetPay['apUser'].' '.$rowGetPay['amUser'];
        $tarjeta = $rowGetPay['tarjUser'];
        $folio = $rowGetPay['folioUser'];
        $contrato = $rowGetPay['numContr'];
        $inicioFecha = $rowGetPay['inicioFecha'];
        $finFecha = $rowGetPay['finFecha'];
        $monto = $rowGetPay['monto'];
        $pagos[] = array('id' => $id, 'nombre' => $name, 'tarj' => $tarjeta, 
            'folio'=>$folio, 'contr'=>$contrato, 'inicioFecha'=>$inicioFecha, 
            'finFecha'=>$finFecha, 'monto'=>$monto);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen pagos.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $pagos));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>
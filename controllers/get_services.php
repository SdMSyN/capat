<?php

include('../config/conexion.php');
include('../config/variables.php');
$colonys = array();
$msgErr = '';
$ban = false;

$sqlGetCom = "SELECT * FROM $tTypeServ WHERE 1=1 ";

//Buscar
$query = (isset($_POST['query'])) ? $_POST['query'] : "";
if ($query != '') {
    $sqlGetCom .= " AND $tTypeServ.nombre LIKE '%$query%' ";
}

//editar (buscar por ID)
$edit = (isset($_POST['idColony'])) ? $_POST['idColony'] : "";
if ($edit != '') {
    $sqlGetCom .= " AND $tTypeServ.id = $edit ";
}

//Ordenar ASC y DESC
$vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
if ($vorder != '') {
    $sqlGetCom .= " ORDER BY " . $vorder;
}

$resGetCom = $con->query($sqlGetCom);
if ($resGetCom->num_rows > 0) {
    while ($rowGetCom = $resGetCom->fetch_assoc()) {
        $id = $rowGetCom['id'];
        $name = $rowGetCom['nombre'];
        $created = $rowGetCom['creado'];
        $colonys[] = array('id' => $id, 'nombre' => $name, 'creado' => $created);
        $ban = true;
    }
} else {
    $ban = false;
    $msgErr = 'No existen servicios aún.<br>' . $con->error;
}

if ($ban) {
    echo json_encode(array("error" => 0, "dataRes" => $colonys));
} else {
    echo json_encode(array("error" => 1, "msgErr" => $msgErr));
}
?>
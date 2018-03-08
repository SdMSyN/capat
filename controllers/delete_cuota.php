<?php

    include('../config/conexion.php');
    include('../config/variables.php');

    $idCuota = $_POST['idCuota'];
    $ban = false;
    $msgErr = '';
    $sqlDeleteCuota = "DELETE FROM $tCuotas WHERE id='$idCuota' ";
		//echo $sqlDeleteProf;
    if($con->query($sqlDeleteCuota) === TRUE){
        $ban = true;
        $msgErr .= 'Se elimino con éxito.';
    }else{
        $banTmp = false;
        $msgErr .= 'Error al eliminar cuota.'.$con->error;
    }

    if($ban){
        echo json_encode(array("error"=>0, "dataRes"=>$msgErr));
    }else{
        echo json_encode(array("error"=>1, "dataRes"=>$msgErr));
    }
?>
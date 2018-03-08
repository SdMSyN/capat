<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idCuota = $_POST['inputIDCuota'];
    $year = $_POST['inputYear'];
    $cuota = $_POST['inputCuota'];
    $typeService = $_POST['inputTypeService'];

    $cad = '';
    $ban = false;
    

		$sqlUpdateUser = "UPDATE $tCuotas SET year='$year', cantidad='$cuota', tipo_servicio_id='$typeService' WHERE id='$idCuota' ";
		if($con->query($sqlUpdateUser) === TRUE){
			$ban = true;
			$cad .= 'Cuota modificada con éxito.';
		}else{
			$ban = false;
			$cad .= 'Error al actualizar cuota.<br>'.$con->error;
		}

    
    //$ban = true;
    if($ban){
			echo json_encode(array("error"=>0, "msg"=>$cad));
    }else{
			echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>
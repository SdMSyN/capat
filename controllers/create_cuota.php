<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idColony = $_POST['inputIDColony'];
    $year = $_POST['inputYear'];
    $cuota = $_POST['inputCuota'];
    $typeService = $_POST['inputTypeService'];

    $cad = '';
    $ban = false;
    

		$sqlInsertCuota = "INSERT INTO $tCuotas "
				."(year, cantidad, comunidad_id, tipo_servicio_id, creado) "
				. "VALUES ('$year', '$cuota', '$idColony', '$typeService', '$dateNow' ) ";
		if($con->query($sqlInsertCuota) === TRUE){
				$ban = true;
				$cad .= 'Cuota añadida con éxito.';
		}else{
				$ban = false;
				$cad .= 'Error al crear nueva cuota.<br>'.$con->error;
		}

    
    //$ban = true;
    if($ban){
        echo json_encode(array("error"=>'0', "msg"=>$cad));
    }else{
        echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>
<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $service = $_POST['inputService'];

    $cad = '';
    $ban = false;
    

		$sqlInsertColony = "INSERT INTO $tTypeServ "
				."(nombre, creado) "
				. "VALUES ('$service', '$dateNow' ) ";
		if($con->query($sqlInsertColony) === TRUE){
				$ban = true;
				$cad .= 'Servicio añadido con éxito.';
		}else{
				$ban = false;
				$cad .= 'Error al crear nuevo servicio.<br>'.$con->error;
		}

    
    //$ban = true;
    if($ban){
        echo json_encode(array("error"=>'0', "msg"=>$cad));
    }else{
        echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>
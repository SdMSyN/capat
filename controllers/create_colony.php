<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $colony = $_POST['inputColony'];

    $cad = '';
    $ban = false;
    

		$sqlInsertColony = "INSERT INTO $tCom "
				."(nombre, creado) "
				. "VALUES ('$colony', '$dateNow' ) ";
		if($con->query($sqlInsertColony) === TRUE){
				$ban = true;
				$cad .= 'Colonia añadida con éxito.';
		}else{
				$ban = false;
				$cad .= 'Error al crear nueva colonia.<br>'.$con->error;
		}

    
    //$ban = true;
    if($ban){
        echo json_encode(array("error"=>'0', "msg"=>$cad));
    }else{
        echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>
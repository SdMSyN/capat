<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idColony = $_POST['inputIDColony'];
    $name = $_POST['inputColony'];

    $cad = '';
    $ban = false;
    

		$sqlUpdateUser = "UPDATE $tCom SET nombre='$name' WHERE id='$idColony' ";
		if($con->query($sqlUpdateUser) === TRUE){
			$ban = true;
			$cad .= 'Comunidad modificada con éxito.';
		}else{
			$ban = false;
			$cad .= 'Error al actualizar comunidad.<br>'.$con->error;
		}

    
    //$ban = true;
    if($ban){
			echo json_encode(array("error"=>0, "msg"=>$cad));
    }else{
			echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>
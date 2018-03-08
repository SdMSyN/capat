<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $idService = $_POST['inputIDService'];
    $name = $_POST['inputService'];

    $cad = '';
    $ban = false;
    

		$sqlUpdateUser = "UPDATE $tTypeServ SET nombre='$name' WHERE id='$idService' ";
		if($con->query($sqlUpdateUser) === TRUE){
			$ban = true;
			$cad .= 'Servicio modificado con éxito.';
		}else{
			$ban = false;
			$cad .= 'Error al actualizar servicio.<br>'.$con->error;
		}

    
    //$ban = true;
    if($ban){
			echo json_encode(array("error"=>0, "msg"=>$cad));
    }else{
			echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>
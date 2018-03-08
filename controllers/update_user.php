<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    
    $inputIdUser = $_POST['inputIDUser'];
    $inputName = $_POST['inputName'];
    $inputAP = $_POST['inputAP'];
    $inputAM = $_POST['inputAM'];
    $inputFolio = $_POST['inputFolio'];
    $inputNumContr = $_POST['inputNumContr'];
    $inputTypeContr = $_POST['inputTypeContr'];
    $inputCol = $_POST['inputCol'];
    $inputDir = $_POST['inputDir'];
    $inputDirName = isset($_POST['inputDirName']) ? $_POST['inputDirName'] : "";
    $inputNum = $_POST['inputNum'];

    $cad = '';
    $ban = true;

		$idDir = 0;
		if($inputDir == 0){
			$sqlInsertDir = "INSERT INTO $tDirs (calle, comunidad_id, creado) VALUES ('$inputDirName', '$inputCol', '$dateNow') ";
			if($con->query($sqlInsertDir) === TRUE){
				$idDir = $con->insert_id;
				$ban = true;
			}else{
				$ban = false;
				$cad .= 'Error al añadir nueva dirección.<br>'.$con->error;
			}
		}else{
			$idDir = $inputDir;
		}

		if($ban){
			$sqlUpdateUser = "UPDATE $tUsersData SET name='$inputName', ap='$inputAP', am='$inputAM', tarjeta='$inputFolio', folio='$inputFolio', direccion_id='$idDir', numero='$inputNum' WHERE id='$inputIdUser' ";
			if($con->query($sqlUpdateUser) === TRUE){
				$ban = true;
			}else{
				$ban = false;
				$cad .= 'Error: Al modificar usuario.<br>'.$con->error;
			}
		}else{
			$ban = false;
		}
    
    //$ban = true;
    if($ban){
			echo json_encode(array("error"=>0, "msg"=>$cad));
    }else{
			echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>
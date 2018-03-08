<?php

    include('../config/conexion.php');
    include('../config/variables.php');
		
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
    
		$idDir = 0; $idContr = 0;
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
			$sqlInsertContr = "INSERT INTO $tContratos (tipo_contrato_id, numero_contrato, creado) "
				."VALUES ('$inputTypeContr', '$inputNumContr', '$dateNow' ) ";
				if($con->query($sqlInsertContr) === TRUE){
					$idContr = $con->insert_id;
					$ban = true;
				}else{
					$ban = false;
					$cad .= 'Error al añadir nuevo contrato.<br>'.$con->error;
				}
		}
		if($ban){
			$sqlInsertUser = "INSERT INTO $tUsersData (name, ap, am, tarjeta, folio, contrato_id, direccion_id, numero, creado) VALUES ('$inputName', '$inputAP', '$inputAM', '$inputFolio', '$inputFolio', '$idContr', '$idDir', '$inputNum', '$dateNow' ) ";
			if($con->query($sqlInsertUser) === TRUE){
				$ban = true;
			}else{
				$ban = false;
				$cad .= 'Error: Al añadir usuario.<br>'.$con->error;
			}
		}else{
			$ban = false;
		}
		
    //$ban = true;
    if($ban){
        echo json_encode(array("error"=>'0', "msg"=>$cad));
    }else{
        echo json_encode(array("error"=>1, "msg"=>$cad));
    }
?>
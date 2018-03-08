<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $dirs = array();
    $msgErr = '';
    $ban = false;
    
    $sqlGetCom = "SELECT * FROM $tDirs "
			."WHERE 1=1 ";
    
		//Buscar
		$query = (isset($_POST['query'])) ? $_POST['query'] : "";
		if($query != ''){
			$sqlGetCom .= " AND $tCom.nombre LIKE '%$query%' ";
		}
		
		//editar (buscar por ID)
		$idColony = (isset($_POST['idColony'])) ? $_POST['idColony'] : "";
		if($idColony != ''){
			$sqlGetCom .= " AND $tDirs.comunidad_id = $idColony ";
		}
		
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
			$sqlGetCom .= " ORDER BY ".$vorder;
    }
   
    $resGetCom = $con->query($sqlGetCom);
    if($resGetCom->num_rows > 0){
			while($rowGetCom = $resGetCom->fetch_assoc()){
				$id = $rowGetCom['id'];
				$calle = $rowGetCom['calle'];
				$dirs[] = array('id'=>$id, 'calle'=>$calle );
				$ban = true;
			}
    }else{
			$ban = false;
			$msgErr = 'No existen direcciones en esta comunidad, aún.'.$con->error;
    }
    
    if($ban){
			echo json_encode(array("error"=>0, "dataRes"=>$dirs));
    }else{
			echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>
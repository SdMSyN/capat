<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $services = array();
    $msgErr = '';
    $ban = false;
    
		$idColony = $_POST['idColony'];
    $sqlGetCom = "SELECT $tCuotas.*, $tTypeServ.nombre as servicioNombre "
			."FROM $tCuotas "
			."INNER JOIN $tTypeServ ON $tTypeServ.id = $tCuotas.tipo_servicio_id "
			."WHERE $tCuotas.comunidad_id='$idColony' ";
    
		//Buscar
		$query = (isset($_POST['query'])) ? $_POST['query'] : "";
		if($query != ''){
			$sqlGetCom .= " AND $tCuotas.nombre LIKE '%$query%' ";
		}
		
		//editar (buscar por ID)
		$idCuota = (isset($_POST['idCuota'])) ? $_POST['idCuota'] : "";
		if($idCuota != ''){
			$sqlGetCom .= " AND $tCuotas.id = '$idCuota' ";
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
				$year = $rowGetCom['year'];
				$cant = $rowGetCom['cantidad'];
				$serviceName = $rowGetCom['servicioNombre'];
				$services[] = array('id'=>$id, 'year'=>$year, 'cant'=>$cant, 'nombreServicio'=>$serviceName );
				$ban = true;
			}
    }else{
			$ban = false;
			$msgErr = 'No existen servicios para esta comunidad, aún.<br>'.$con->error;
    }
    
    if($ban){
			echo json_encode(array("error"=>0, "dataRes"=>$services, "sql"=>$sqlGetCom));
    }else{
			echo json_encode(array("error"=>1, "msgErr"=>$msgErr, "sql"=>$sqlGetCom));
    }

?>
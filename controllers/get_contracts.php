<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $contracts = array();
    $msgErr = '';
    $ban = false;
    
    $sqlGetCont = "SELECT * FROM $tContratosTipos WHERE 1=1 ";
    
		/*
		//Buscar
		$query = (isset($_POST['query'])) ? $_POST['query'] : "";
		if($query != ''){
			$sqlGetCom .= " AND $tTypeServ.nombre LIKE '%$query%' ";
		}
		
		//editar (buscar por ID)
		$edit = (isset($_POST['idColony'])) ? $_POST['idColony'] : "";
		if($edit != ''){
			$sqlGetCom .= " AND $tTypeServ.id = $edit ";
		}
		
    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
			$sqlGetCom .= " ORDER BY ".$vorder;
    }
    */
    $resGetCont = $con->query($sqlGetCont);
    if($resGetCont->num_rows > 0){
			while($rowGetCont = $resGetCont->fetch_assoc()){
				$id = $rowGetCont['id'];
				$name = $rowGetCont['nombre'];
				$created = $rowGetCont['creado'];
				$contracts[] = array('id'=>$id, 'nombre'=>$name, 'creado'=>$created );
				$ban = true;
			}
    }else{
			$ban = false;
			$msgErr = 'No existen contratos aún.<br>'.$con->error;
    }
    
    if($ban){
			echo json_encode(array("error"=>0, "dataRes"=>$contracts));
    }else{
			echo json_encode(array("error"=>1, "msgErr"=>$msgErr));
    }

?>
<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $users = array();
    $msgErr = '';
    $ban = false;
    
    $sqlGetUsers = "SELECT $tCom.id as idCom, $tCom.nombre as nameCom, "
			."$tUsersData.name as nameUser, $tUsersData.ap as ap, $tUsersData.am as am, "
			."$tUsersData.folio as folio, $tContratos.numero_contrato as numCont, $tContratosTipos.nombre as nameTypeCont, "
			."$tDirs.calle as calle, $tUsersData.numero as num, $tUsersData.id as idUser  "
			."FROM $tUsersData "
			."INNER JOIN $tContratos ON $tContratos.id=$tUsersData.contrato_id "
			."INNER JOIN $tContratosTipos ON $tContratosTipos.id=$tContratos.tipo_contrato_id "
			."INNER JOIN $tDirs ON $tDirs.id=$tUsersData.direccion_id "
			."INNER JOIN $tCom ON $tCom.id=$tDirs.comunidad_id "
			."WHERE 1=1 ";

    
		//Buscar
		$query = (isset($_POST['query'])) ? $_POST['query'] : "";
		if($query != ''){
			$sqlGetUsers .= " AND $tUsersData.name LIKE '%$query%' ";
			$sqlGetUsers .= " OR $tUsersData.ap LIKE '%$query%' ";
			$sqlGetUsers .= " OR $tUsersData.am LIKE '%$query%' ";
			$sqlGetUsers .= " OR $tUsersData.folio LIKE '%$query%' ";
			$sqlGetUsers .= " OR $tCom.nombre LIKE '%$query%' ";
		}
		
		//editar (buscar por ID)
		$idUser = (isset($_POST['idUser'])) ? $_POST['idUser'] : "";
		if($idUser != ''){
			$sqlGetUsers .= " AND $tUsersData.id = '$idUser' ";
		}

    //Ordenar ASC y DESC
    $vorder = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
    if($vorder != ''){
			$sqlGetUsers .= " ORDER BY ".$vorder;
    }else{
			$sqlGetUsers .= " ORDER BY $tUsersData.name ";
		}
    $resGetCom = $con->query($sqlGetUsers);
    if($resGetCom->num_rows > 0){
			while($rowGetCom = $resGetCom->fetch_assoc()){
				$nameCom = $rowGetCom['nameCom'];
				$idUser = $rowGetCom['idUser'];
				$nameUser = $rowGetCom['nameUser'];
				$apUser = $rowGetCom['ap'];
				$amUser = $rowGetCom['am'];
				$folio = $rowGetCom['folio'];
				$numContr = $rowGetCom['numCont'];
				$calle = $rowGetCom['calle'];
				$num = $rowGetCom['num'];
				$users[] = array('idUser'=>$idUser,'comunidad'=>$nameCom, 'nombre'=>$nameUser, 'ap'=>$apUser, 'am'=>$amUser, 'folio'=>$folio, 'numContr'=>$numContr, 'calle'=>$calle, 'num'=>$num );
				$ban = true;
			}
    }else{
			$ban = false;
			$msgErr = 'No existen usuarios, aún.<br>'.$con->error;
    }
    
    if($ban){
			echo json_encode(array("error"=>0, "dataRes"=>$users, "sql"=>$sqlGetUsers));
    }else{
			echo json_encode(array("error"=>1, "msgErr"=>$msgErr, "sql"=>$sqlGetUsers));
    }

?>
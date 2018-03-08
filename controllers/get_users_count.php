<?php

    include('../config/conexion.php');
    include('../config/variables.php');
    $users = array();
    $msgErr = '';
    $ban = false;
    
    $sqlGetUsers = "SELECT COUNT(*) as numUsers FROM $tUsersData ";

    $resGetCom = $con->query($sqlGetUsers);
    if($resGetCom->num_rows > 0){
			while($rowGetCom = $resGetCom->fetch_assoc()){
				$numUsers = $rowGetCom['numUsers'];
				$users[] = array('numUsers'=>$numUsers);
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
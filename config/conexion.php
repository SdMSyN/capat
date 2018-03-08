<?php
	
    date_default_timezone_set('America/Mexico_City');
    $host="localhost";
    $user="root";
    $pass="";
    $db="totolac_capat";
    $con=mysqli_connect($host, $user, $pass, $db);
    if($con->connect_error){
            die("Connection failed: ".$con->connect_error);
    }
    //echo 'Hola';

    //Tablas Usuarios
		$tCom = "comunidades";
		$tUsers = "usuarios";
		$tUsersData = "usuarios_data";
		$tDirs = "direcciones";
		$tContratos = "contratos";
		$tContratosTipos= "tipos_contratos";//[Domestico, Comercial e Industrial]
		$tUPerfil = "perfiles"; //[1-sysadmin, 2-administrador, 3-director, 4-capturista, 5-técnico, 6-usuario]
		$tCuotas = "cuotas";
		$tTypeServ = "tipos_servicios";

?>
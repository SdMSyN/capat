<?php

    if(isset($_SESSION['sessU'])  AND $_SESSION['sessU'] == "true"){
        $cadMenuNavbar='';
        if($_SESSION['userPerfil'] == "1"){//Sysadmin
						$cadMenuNavbar .= '<li><a href="#"><i class="fa fa-calendar text-green"></i> <span>Asignaciones</span></a></li>';
						$cadMenuNavbar .= '<li><a href="director_planes_estudios.php"><i class="fa fa-list text-yellow"></i> <span>Planes de estudio</span></a></li>';
        } else if($_SESSION['userPerfil'] == "2"){//Administrador
				
        } else if($_SESSION['userPerfil'] == "3"){//Director
          $cadMenuNavbar .= '<li><a href="director_comunidades.php"><i class="fa fa-tint text-aqua"></i><span>Comunidades</span></a></li>';
          $cadMenuNavbar .= '<li><a href="director_servicios.php"><i class="fa fa-bath  text-yellow"></i><span>Servicios</span></a></li>';
        } else if($_SESSION['userPerfil'] == "4"){//Capturista
          $cadMenuNavbar .= '<li><a href="capturista_usuarios.php"><i class="fa fa-users  text-red"></i><span>Usuarios</span></a></li>';
        } else if($_SESSION['userPerfil'] == "5"){ //Tecnico
          
        } else if($_SESSION['userPerfil'] == "6"){ //Usuario
          
        } else{
            $cadMenuNavbar .= '<li>¿Cómo llegaste hasta acá?</li>';
        }
        echo $cadMenuNavbar;
    }
	
?>
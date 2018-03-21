<?php
    include ('../config/conexion.php');
    include ('../config/variables.php');
    
    $idPay=$_POST['idPay'];

    $sqlUpdPay="UPDATE $tPays SET estatus_id='1', actualizado='$dataTimeNow' WHERE id='$idPay' ";
    if($con->query($sqlUpdPay) === TRUE){
        echo "true";
    }else{
        echo "Error al actualizar pago.";
    }

?>
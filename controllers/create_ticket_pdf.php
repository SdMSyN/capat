<?php

include ('../config/conexion.php');
include ('../config/variables.php');
include('../barcode/barcode.php');

$idUser = $_POST['inputIDUser'];

$yearServ = $_POST['inputYearServ'];
$typeServ = $_POST['inputTypeService'];
$monto = $_POST['inputMonto'];
$monthBegin = $_POST['inputMonthBegin'];
$monthEnd = $_POST['inputMonthEnd'];

$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
//Obtenemos información del usuario
$sqlGetUserData = "SELECT $tUsersData.name as nameUser, $tUsersData.ap as apUser, $tUsersData.am as amUser, "
        . "$tUsersData.tarjeta as tarjUser, $tUsersData.folio as folioUser, $tContratos.numero_contrato as numContr,"
        . "$tContratosTipos.nombre as nameTypeContr, $tDirs.calle as calleUser, "
        . "$tCom.nombre as colonyUser, $tUsersData.numero as numCalle "
        . "FROM $tUsersData "
        . "INNER JOIN $tContratos ON $tContratos.id = $tUsersData.contrato_id "
        . "INNER JOIN $tContratosTipos ON $tContratosTipos.id = $tContratos.tipo_contrato_id "
        . "INNER JOIN $tDirs ON $tDirs.id = $tUsersData.direccion_id "
        . "INNER JOIN $tCom ON $tCom.id = $tDirs.comunidad_id "
        . "WHERE $tUsersData.id = '$idUser'  ";
$resGetUserData = $con->query($sqlGetUserData);
$rowGetUserData = $resGetUserData->fetch_assoc();
$nameUser = $rowGetUserData['nameUser'].' '.$rowGetUserData['apUser'].' '.$rowGetUserData['amUser'];
$dirUser = $rowGetUserData['calleUser'].' '.$rowGetUserData['numCalle'].' de '.$rowGetUserData['colonyUser'];
$tarjUser = $rowGetUserData['tarjUser'];
$folioUser = $rowGetUserData['folioUser'];
$numContr = $rowGetUserData['numContr'];
$nameTypeContr = $rowGetUserData['nameTypeContr'];

//Obtenemos el tipo de servicio
$sqlGetTypeServ = "SELECT $tTypeServ.id as idTypeServ, $tTypeServ.nombre as nameTypeServ "
        . "FROM $tCuotas "
        . "INNER JOIN $tTypeServ ON $tTypeServ.id = $tCuotas.tipo_servicio_id "
        . "WHERE $tCuotas.id = '$typeServ' ";
$resGetTypeServ = $con->query($sqlGetTypeServ);
$rowGetTypeServ = $resGetTypeServ->fetch_assoc();
$idTypeServ = $rowGetTypeServ['idTypeServ'];
$nameTypeServ = $rowGetTypeServ['nameTypeServ'];

//Generamos código de barras
$code = $year.$mes.$dia.$hour.$minute.$second;
barcode('../codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);


//Insertamos información del pago
$cad = '';
$fechaInicio = $yearServ."-".($monthBegin+1)."-01";
$fechaFin = $yearServ."-".$monthEnd."-01";
$sqlInsertPay = "INSERT INTO $tPays "
        . "(usuario_data_id, tipo_servicio_id, fecha_inicio, fecha_fin, monto, estatus_id, ticket, creado, actualizado) "
        . "VALUES ('$idUser', '$idTypeServ', '$fechaInicio', '$fechaFin', '$monto', '2', '$code', '$dataTimeNow', '$dataTimeNow' )";
if ($con->query($sqlInsertPay) === TRUE) {
    $ban = true;
    $cad .= 'Pago añadido con éxito.';
} else {
    $ban = false;
    $cad .= 'No se pudo insertar el pago.<br>' . $con->error;
}


$cad = '';
$ban = true;
$msgErr = '';

//fpdf
require('../fpdf/fpdf.php');

class PDF extends FPDF {

    //Función para línea punteada
    function SetDash($black=false, $white=false){
        if($black and $white)
            $s=sprintf('[%.3f %.3f] 0 d', $black*$this->k, $white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }
}

//Fin class PDF
// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times', '', 10);
$pdf->Cell(40, 16, '', 1, 0, 'C', $pdf->Image('../dist/img/totolac.png', $pdf->GetX() + 5, $pdf->GetY(), 30, 15));
$pdf->MultiCell(110, 4, utf8_decode("Tesorería Municipal de Totolac, 2017-2021. \n Sistema de Comisión de Agua Potable y Alcantarillado de Totolac \n R.F.C.: MTT850101U72, Palacio Municipal S/N , San Juan Totolac, Tlax. \n CP: 90160, Tel.: 246 46 5 05 60 "), 1, 'C');
$pdf->SetXY(160, 10);
$pdf->Cell(40, 16, '', 1, 1, 'C', $pdf->Image('../dist/img/ico_gota.png', $pdf->GetX() + 5, $pdf->GetY(), 30, 15));                

//Datos del usuario
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Nombre: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(75, 8, utf8_decode($nameUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Dirección: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(75, 8, utf8_decode($dirUser), 1, 1, 'L');

//Datos del contrato
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 8, utf8_decode("Datos de contrato:"), 1, 0, 'L');
$pdf->Cell(15, 8, utf8_decode("Tarjeta: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($tarjUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 8, utf8_decode("Folio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($folioUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Contrato: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($numContr), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 8, utf8_decode("Tipo: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(40, 8, utf8_decode($nameTypeContr), 1, 1, 'L');

//Datos de pago
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 8, utf8_decode("Tipo de Servicio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($nameTypeServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 8, utf8_decode("Inicio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(30, 8, utf8_decode($meses[$monthBegin].' '.$yearServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Fin: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(30, 8, utf8_decode($meses[$monthEnd-1].' '.$yearServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Monto: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(25, 8, utf8_decode('$'.$monto), 1, 1, 'L');

$pdf->Cell(0, 8, utf8_decode("Totolac, Tlax., a ".$dia." de ".$meses[$mes-1]." del ".$year), 1, 1, 'L');
$pdf->SetFont('Times', 'I', 9);
$pdf->MultiCell(0, 4, utf8_decode("Nota: Éste recibo deberá de presentarlo el causante al realizar el próximo pago. No es valido si contiene raspaduras o enmendaduras."), 1, 'L');
$pdf->SetFont('Times', 'I', 8);
$pdf->MultiCell(0, 4, utf8_decode("La reproducción no autorizada de éste comprobante constituye un delito en los terminos de las disposiciones fiscales. \n"
        . "El pago de éste recibo no libera al causante de adeudos posteriores."), 1, 'L');
$pdf->Cell(130, 10, '', 1, 0, 'C', $pdf->Image('../dist/img/firma.png', $pdf->GetX() + 80, $pdf->GetY(), 30, 12));
$pdf->Cell(60, 10, '', 1, 1, 'C', $pdf->Image('../codigos/'.$code.'.png', $pdf->GetX()+15, $pdf->GetY(), 30, 12, 'PNG'));
$pdf->MultiCell(0, 4, utf8_decode("L.A.E. Veneranda \nTesorera Municipal"), 1, 'C');
$pdf->SetDash(1,1);
$pdf->Line(0, $pdf->GetY()+5, 220, $pdf->GetY()+5);

$pdf->SetDash(0,0);
$pdf->SetXY(10, 102);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(40, 16, '', 1, 0, 'C', $pdf->Image('../dist/img/totolac.png', $pdf->GetX() + 5, $pdf->GetY(), 30, 15));
$pdf->MultiCell(110, 4, utf8_decode("Tesorería Municipal de Totolac, 2017-2021. \n Sistema de Comisión de Agua Potable y Alcantarillado de Totolac \n R.F.C.: MTT850101U72, Palacio Municipal S/N , San Juan Totolac, Tlax. \n CP: 90160, Tel.: 246 46 5 05 60 "), 1, 'C');
$pdf->SetXY(160, 102);
$pdf->Cell(40, 16, '', 1, 1, 'C', $pdf->Image('../dist/img/ico_gota.png', $pdf->GetX() + 5, $pdf->GetY(), 30, 15));                

//Datos del usuario
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Nombre: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(75, 8, utf8_decode($nameUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Dirección: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(75, 8, utf8_decode($dirUser), 1, 1, 'L');

//Datos del contrato
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 8, utf8_decode("Datos de contrato:"), 1, 0, 'L');
$pdf->Cell(15, 8, utf8_decode("Tarjeta: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($tarjUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 8, utf8_decode("Folio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($folioUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Contrato: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($numContr), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 8, utf8_decode("Tipo: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(40, 8, utf8_decode($nameTypeContr), 1, 1, 'L');

//Datos de pago
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 8, utf8_decode("Tipo de Servicio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($nameTypeServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 8, utf8_decode("Inicio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(30, 8, utf8_decode($meses[$monthBegin].' '.$yearServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Fin: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(30, 8, utf8_decode($meses[$monthEnd-1].' '.$yearServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Monto: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(25, 8, utf8_decode('$'.$monto), 1, 1, 'L');

$pdf->Cell(0, 8, utf8_decode("Totolac, Tlax., a ".$dia." de ".$meses[$mes-1]." del ".$year), 1, 1, 'L');
$pdf->SetFont('Times', 'I', 9);
$pdf->MultiCell(0, 4, utf8_decode("Nota: Éste recibo deberá de presentarlo el causante al realizar el próximo pago. No es valido si contiene raspaduras o enmendaduras."), 1, 'L');
$pdf->SetFont('Times', 'I', 8);
$pdf->MultiCell(0, 4, utf8_decode("La reproducción no autorizada de éste comprobante constituye un delito en los terminos de las disposiciones fiscales. \n"
        . "El pago de éste recibo no libera al causante de adeudos posteriores."), 1, 'L');
$pdf->Cell(130, 10, '', 1, 0, 'C', $pdf->Image('../dist/img/firma.png', $pdf->GetX() + 80, $pdf->GetY(), 30, 12));
$pdf->Cell(60, 10, '', 1, 1, 'C', $pdf->Image('../codigos/'.$code.'.png', $pdf->GetX()+15, $pdf->GetY(), 30, 12, 'PNG'));
$pdf->MultiCell(0, 4, utf8_decode("L.A.E. Veneranda \nTesorera Municipal"), 1, 'C');
$pdf->SetDash(1,1);
$pdf->Line(0, $pdf->GetY()+5, 220, $pdf->GetY()+5);

$pdf->SetDash(0,0);
$pdf->SetXY(10, 195);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(40, 16, '', 1, 0, 'C', $pdf->Image('../dist/img/totolac.png', $pdf->GetX() + 5, $pdf->GetY(), 30, 15));
$pdf->MultiCell(110, 4, utf8_decode("Tesorería Municipal de Totolac, 2017-2021. \n Sistema de Comisión de Agua Potable y Alcantarillado de Totolac \n R.F.C.: MTT850101U72, Palacio Municipal S/N , San Juan Totolac, Tlax. \n CP: 90160, Tel.: 246 46 5 05 60 "), 1, 'C');
$pdf->SetXY(160, 195);
$pdf->Cell(40, 16, '', 1, 1, 'C', $pdf->Image('../dist/img/ico_gota.png', $pdf->GetX() + 5, $pdf->GetY(), 30, 15));                

//Datos del usuario
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Nombre: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(75, 8, utf8_decode($nameUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Dirección: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(75, 8, utf8_decode($dirUser), 1, 1, 'L');

//Datos del contrato
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 8, utf8_decode("Datos de contrato:"), 1, 0, 'L');
$pdf->Cell(15, 8, utf8_decode("Tarjeta: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($tarjUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 8, utf8_decode("Folio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($folioUser), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Contrato: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($numContr), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 8, utf8_decode("Tipo: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(40, 8, utf8_decode($nameTypeContr), 1, 1, 'L');

//Datos de pago
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(30, 8, utf8_decode("Tipo de Servicio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(20, 8, utf8_decode($nameTypeServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(15, 8, utf8_decode("Inicio: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(30, 8, utf8_decode($meses[$monthBegin].' '.$yearServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Fin: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(30, 8, utf8_decode($meses[$monthEnd-1].' '.$yearServ), 1, 0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(20, 8, utf8_decode("Monto: "), 1, 0, 'L');
$pdf->SetFont('Times', '', 11);
$pdf->Cell(25, 8, utf8_decode('$'.$monto), 1, 1, 'L');

$pdf->Cell(0, 8, utf8_decode("Totolac, Tlax., a ".$dia." de ".$meses[$mes-1]." del ".$year), 1, 1, 'L');
$pdf->SetFont('Times', 'I', 9);
$pdf->MultiCell(0, 4, utf8_decode("Nota: Éste recibo deberá de presentarlo el causante al realizar el próximo pago. No es valido si contiene raspaduras o enmendaduras."), 1, 'L');
$pdf->SetFont('Times', 'I', 8);
$pdf->MultiCell(0, 4, utf8_decode("La reproducción no autorizada de éste comprobante constituye un delito en los terminos de las disposiciones fiscales. \n"
        . "El pago de éste recibo no libera al causante de adeudos posteriores."), 1, 'L');
$pdf->Cell(130, 10, '', 1, 0, 'C', $pdf->Image('../dist/img/firma.png', $pdf->GetX() + 80, $pdf->GetY(), 30, 12));
$pdf->Cell(60, 10, '', 1, 1, 'C', $pdf->Image('../codigos/'.$code.'.png', $pdf->GetX()+15, $pdf->GetY(), 30, 12, 'PNG'));
$pdf->MultiCell(0, 4, utf8_decode("L.A.E. Veneranda \nTesorera Municipal"), 1, 'C');
 
$pdf->Output();
/* if($ban){
  echo "Exito";
  }else{
  echo "Fracaso<br>";
  echo $msgErr;
  } */
?>
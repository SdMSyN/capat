<?php

include('../barcode/barcode.php');
//Generamos código de barras
$code = $year.$mes.$dia.$hour.$minute.$second;
barcode('../codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);

?>

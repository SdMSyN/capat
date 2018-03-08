<?php require('header.php'); ?>

	<title><?= $tit; ?></title>
	<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
	<meta name="description" content="Descripción de la página" />
	<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">

  <?php require('navbar.php'); ?>
	
	<?php
		if(isset($_SESSION['sessU']) AND $_SESSION['userPerfil'] == 4){ 
	?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escritorio
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Escritorio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
			<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 class="numUsers"></h3>
              <p>Usuarios</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="capturista_usuarios.php" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
              <p>Comunidades</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php require('footer.php'); ?>
	<!-- scripts acá -->
	<script>
		filtrar();
			function filtrar(){
				$(".loader").show();
				$.ajax({
					type: "POST",
					url: "../controllers/get_users_count.php",
					success: function(msg){
						console.log(msg);
						var msg = jQuery.parseJSON(msg);
						if(msg.error == 0){
							$("#data tbody").html("");
							$(".numUsers").html(msg.dataRes[0].numUsers);
						}else{
							var newRow = '<tr><td colspan="3">'+msg.msgErr+'</td></tr>';
							$("#data tbody").html(newRow);
						}
					},
					error: function(x, e){
						var cadErr = '';
						if (x.status==0) {
							cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
						} else if(x.status==404) {
							cadErr = 'Página no encontrada.';
						} else if(x.status==500) {
							cadErr = 'Error interno del servidor.';
						} else if(e=='parsererror') {
							cadErr = 'Error.\nFalló la respuesta JSON.';
						} else if(e=='timeout'){
							cadErr = 'Tiempo de respuesta excedido.';
						} else {
							cadErr = 'Error desconocido.\n'+x.responseText;
						}
						alert(cadErr);
					}
				});
				$(".loader").hide();
			}
		
	</script>
	<?php
		}
	?>
</body>
</html>

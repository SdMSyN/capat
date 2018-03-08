<?php require('header.php'); ?>

	<title><?= $tit; ?></title>
	<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
	<meta name="description" content="Descripción de la página" />
	<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">

  <?php require('navbar.php'); ?>

	<?php
		if(isset($_SESSION['sessU']) AND $_SESSION['userPerfil'] == 3){ 
	?>
	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
			<div class="row">
				<div class="col-xs-3">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Buscar por nombre" id="buscar" >
						<span class="input-group-btn">
						<button class="btn btn-default" type="button" onclick="load(1);"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
				<div class="col-xs-4"></div>
				<div class="col-xs-5 ">
					<div class="btn-group pull-right">
						<a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalAddColony"><i class="fa fa-plus"></i> Nuevo</a>
						<!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Mostrar <span class="caret"></span>
						</button> -->
					</div>
				</div>
			</div>

			<!-- modal añadir comunidad -->
				<form class="form-horizontal" id="formAddColony" name="formAddColony">
					<div class="modal fade" id="modalAddColony" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Nueva comunidad</h4>
									<p class="divError"></p>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="inputColony" class="col-sm-3 control-label">Nombre</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="inputColony" name="inputColony" required>
										</div>
									</div>
								</div><!-- ./modal-body -->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button type="submit" id="guardar_datos" class="btn btn-primary">Añadir</button>
								</div><!-- ./modal-footer -->
							</div><!-- ./modal-content -->
						</div><!-- ./modal-dialog -->
					</div><!-- ./modal fade -->
				</form>
			<!-- fin modal -->
			
			<!-- modal editar comunidad -->
				<form class="form-horizontal" id="formUpdColony" name="formUpdColony">
					<div class="modal fade" id="modalUpdColony" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Editar Comunidad</h4>
									<p class="divError"></p>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="inputColony" class="col-sm-3 control-label">Nombre</label>
										<div class="col-sm-9">
											<input type="hidden" class="form-control" id="inputIDColony" name="inputIDColony" required>
											<input type="text" class="form-control" id="inputColony" name="inputColony" required>
										</div>
									</div>
								</div><!-- ./modal-body -->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button type="submit" id="guardar_datos" class="btn btn-primary">Actualizar</button>
								</div><!-- ./modal-footer -->
							</div><!-- ./modal-content -->
						</div><!-- ./modal-dialog -->
					</div><!-- ./modal fade -->
				</form>
			<!-- fin modal -->
    </section>

    <!-- Main content -->
    <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Listado de comunidades</h3>
							<div class="divError"></div>
						</div>
						<div class="box-body">
							<div class="table table-condensed table-hover table-striped">
								<table class="table table-striped table-bordered" id="data">
									<thead>
										<tr>
											<th><span title="nombre">Nombre</span></th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div><!-- ./table -->
						</div><!-- ./box-body -->
					</div><!-- ./box -->
				</div><!-- ./col-sm-12 -->
			</div><!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php require('footer.php'); ?>
	<!-- scripts acá -->
	
	<script>
		$(".loader").hide();
		var ordenar = '';
		$(document).ready(function(){
			filtrar();
			function filtrar(){
				$(".loader").show();
				$.ajax({
					type: "POST",
					data: ordenar,
					url: "../controllers/get_comunidades.php",
					success: function(msg){
						console.log(msg);
						var msg = jQuery.parseJSON(msg);
						if(msg.error == 0){
							$("#data tbody").html("");
							$.each(msg.dataRes, function(i, item){
								var newRow = '<tr>'
									+'<td>'+msg.dataRes[i].nombre+'</td>'
									+'<td><div class="btn-group pull-right dropdown">'
										+'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
									+'<ul class="dropdown-menu">'
										+'<li><a href="#" data-toggle="modal" data-target="#modalUpdColony" id="editar" data-value="'+msg.dataRes[i].id+'"><i class="fa fa-edit"></i> Editar</a></li>'
										+'<li><a href="director_cuotas.php?ID='+msg.dataRes[i].id+'" ><i class="fa fa-usd "></i> Cuotas de servicios</a></li>'
									+'</ul></div></td>'
									+'</tr>';
								$(newRow).appendTo("#data tbody");
							})
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
			
			//Ordenar ASC y DESC header tabla
			$("#data th span").click(function(){
				if($(this).hasClass("desc")){
					$("#data th span").removeClass("desc").removeClass("asc");
					$(this).addClass("asc");
					ordenar = "&orderby="+$(this).attr("title")+" asc";
				}else{
					$("#data th span").removeClass("desc").removeClass("asc");
					$(this).addClass("desc");
					ordenar = "&orderby="+$(this).attr("title")+" desc";
				}
				filtrar();
			});
			
			$("#buscar").keyup(function(){
				var consulta = $(this).val();
				$.ajax({
					type: "POST",
					data: {ordenar: ordenar, query: consulta},
					url: "../controllers/get_comunidades.php",
					success: function(msg){
						console.log(msg);
						var msg = jQuery.parseJSON(msg);
						if(msg.error == 0){
							$("#data tbody").html("");
							$.each(msg.dataRes, function(i, item){
								var newRow = '<tr>'
									+'<td>'+msg.dataRes[i].nombre+'</td>'
									+'<td><div class="btn-group pull-right dropdown">'
										+'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
									+'<ul class="dropdown-menu">'
										+'<li><a href="#" data-toggle="modal" data-target="#modalUpdColony" id="editar" data-value="'+msg.dataRes[i].id+'"><i class="fa fa-edit"></i> Editar</a></li>'
										+'<li><a href="#" id="cuotas" data-value="'+msg.dataRes[i].id+'" data-edo="1" ><i class="fa fa-usd "></i> Cuotas de servicios</a></li>'
									+'</ul></div></td>'
									+'</tr>';
								$(newRow).appendTo("#data tbody");
							})
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
			})
		
			$("#data").on("click", "#editar", function(){
				var idColony = $(this).data('value');
				console.log(idColony);
				$(".loader").show();
				$.ajax({
					type: "POST",
					url: "../controllers/get_comunidades.php",
					data: {idColony: idColony},
					success: function(msg){
						console.log(msg);
						var datos = jQuery.parseJSON(msg);
						$("#modalUpdColony .modal-body #inputIDColony").val(datos.dataRes[0].id);
						$("#modalUpdColony .modal-body #inputColony").val(datos.dataRes[0].nombre);
						$(".loader").hide();
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
				})
			})
			
			$(document).on("click",".modal-body li a",function(){
        tab = $(this).attr("href");
        $(".modal-body .tab-content div").each(function(){
					$(this).removeClass("active");
        });
        $(".modal-body .tab-content "+tab).addClass("active");
			});
		
		
		});	
	</script>
	
	<script>
		var form1 = $( "#formAddColony" );
		form1.validate({ 
			ignore: "",
			rules:{
				inputColony: {required: true}
			},
			messages:{
				inputColony: "Nombre de la colonia obligatorio",
			},
			errorPlacement: function ( error, element ) {
				error.addClass( "help-block" );
				element.parents( ".col-sm-9" ).addClass( "has-feedback" );
				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertAfter( element.parent( "label" ) );
				} else {
					error.insertAfter( element );
				}
				if ( !element.next( "span" )[ 0 ] ) {
					$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
				}
			},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-9" ).addClass( "has-error" ).removeClass( "has-success" );
				$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
			},
			unhighlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-9" ).addClass( "has-success" ).removeClass( "has-error" );
				$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
			}
		});
		$( "#formAddColony" ).submit(function( event ) {
			var form1 = $(this).valid(); 
			var parametros = $(this).serialize();
			if (this.hasChildNodes('.nav.nav-tabs')) {
				var validator = $(this).validate();
				$(this).find("input").each(function () {
					if (!validator.element(this)) {
						form1= false;
						$('a[href=\\#' + $(this).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
						return false;
					}
				});
			}
			if (form1) {
				$(".loader").show();
				$('#guardar_datos').attr("disabled", true);	
				$.ajax({
					type: "POST",
					url: "../controllers/create_colony.php",
					data: parametros,
					success: function(msg){
						var datos = jQuery.parseJSON(msg);
						if(datos.error == 0){
							$(".divError").removeClass("bg-danger");
							$(".divError").addClass("bg-success");
							$(".divError").html(datos.msg);
							setTimeout(function(){
								location.reload();
							}, 3000);
						}else{
							$(".divError").removeClass("bg-success");
							$(".divError").addClass("bg-danger");
							$(".divError").html(datos.msg);
							$(".loader").hide();
							setTimeout(function(){
								$(".divError").hide();
							}, 3000);
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
						$(".divError").addClass("bg-danger");
						$(".divError").html(cadErr);
						setTimeout(function(){
							$(".divError").hide();
						}, 3000);
					}
				});
				event.preventDefault();
			} 
		})
	</script>
	
	<script>
		var form2 = $( "#formUpdColony" );
		form2.validate({ 
			ignore: "",
			rules:{
				inputName: {required: true}
			},
			messages:{
				inputName: "Nombre obligatorio"
			},
			errorPlacement: function ( error, element ) {
				error.addClass( "help-block" );
				element.parents( ".col-sm-9" ).addClass( "has-feedback" );
				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertAfter( element.parent( "label" ) );
				} else {
					error.insertAfter( element );
				}
				if ( !element.next( "span" )[ 0 ] ) {
					$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
				}
			},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-9" ).addClass( "has-error" ).removeClass( "has-success" );
				$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
			},
			unhighlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-9" ).addClass( "has-success" ).removeClass( "has-error" );
				$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
			}
		});
		$( "#formUpdColony" ).submit(function( event ) {
			var form2 = $(this).valid(); 
			var parametros = $(this).serialize();
			if (this.hasChildNodes('.nav.nav-tabs')) {
				var validator = $(this).validate();
				$(this).find("input").each(function () {
					if (!validator.element(this)) {
						form2= false;
						$('a[href=\\#' + $(this).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
						return false;
					}
				});
			}
			if (form2) {
				$(".loader").show();
				$('#guardar_datos').attr("disabled", true);	
				$.ajax({
					type: "POST",
					url: "../controllers/update_colony.php",
					data: parametros,
					success: function(msg){
						console.log(msg);
						var datos = jQuery.parseJSON(msg);
						if(datos.error == 0){
							$(".loader").hide();
							$(".divError").removeClass("bg-danger");
							$(".divError").addClass("bg-success");
							$(".divError").html(datos.msg);
							setTimeout(function(){
								location.reload();
							}, 3000);
						}else{
							$(".loader").hide();
							$(".divError").removeClass("bg-success");
							$(".divError").addClass("bg-danger");
							$(".divError").html(datos.msg);
							setTimeout(function(){
								$(".divError").hide();
							}, 3000);
						}
					},
					error: function(x, e){
						$(".loader").hide();
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
						$(".divError").addClass("bg-danger");
						$(".divError").html(cadErr);
						setTimeout(function(){
							$(".divError").hide();
						}, 3000);
					}
				});
				event.preventDefault();
			} 
		})
	</script>
	
		<?php 
			}else{
		?>
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Error 401
				</h1>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="error-page">
					<h2 class="headline text-yellow"> 401</h2>

					<div class="error-content">
						<h3><i class="fa fa-warning text-yellow"></i> Oops! No tienes autorización para visualizar ésta página.</h3>

						<p>
							<a href="login.php">Inicia sesión</a> para poder visualizar el contenido, lamentamos las molestias.
						</p>

					</div>
					<!-- /.error-content -->
				</div>
				<!-- /.error-page -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<?php require('footer.php'); ?>
		<script>
			$(".loader").hide();
		</script>
		<?php
			}
		?>
</body>
</html>

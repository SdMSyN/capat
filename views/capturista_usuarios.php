<?php require('header.php'); ?>

<title><?= $tit; ?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">

    <?php require('navbar.php'); ?>

    <?php
    if (isset($_SESSION['sessU']) AND $_SESSION['userPerfil'] == 4) {
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
                            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalAddUser"><i class="fa fa-plus"></i> Nuevo</a>
                            <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Mostrar <span class="caret"></span>
                            </button> -->
                        </div>
                    </div>
                </div>

                <!-- modal añadir user -->
                <form class="form-horizontal" id="formAddUser" name="formAddUser">
                    <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nuevo Usuario</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#navUser" data-toggle="tab">Usuario</a></li>
                                            <li><a href="#navContract" data-toggle="tab">Contrato</a></li>
                                            <li><a href="#navDir" data-toggle="tab">Dirección</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="navUser">
                                                <div class="form-group">
                                                    <label for="inputName" class="col-sm-3 control-label">Nombre</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputName" name="inputName" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAP" class="col-sm-3 control-label">Apellido Paterno</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputAP" name="inputAP" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAM" class="col-sm-3 control-label">Apellido Materno</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputAM" name="inputAM" required>
                                                    </div>
                                                </div>
                                            </div><!-- ./tab-pane -->
                                            <div class="tab-pane" id="navContract">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" id="inputFolio">Folio:</label>
                                                    <div class="input-group col-sm-9">
                                                        <input type="text" class="form-control" id="inputFolio" name="inputFolio" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" id="inputNumContr">Número de Contrato:</label>
                                                    <div class="input-group col-sm-9">
                                                        <input type="text" class="form-control" id="inputNumContr" name="inputNumContr" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="inputTypeContr">Tipo de Contrato:</label>
                                                    <div class="input-group col-sm-9">
                                                        <select type="text" class="form-control" id="inputTypeContr" name="inputTypeContr" ></select>
                                                    </div>
                                                </div>
                                            </div><!-- ./tab-pane -->
                                            <div class="tab-pane" id="navDir">
                                                <div class="form-group">
                                                    <label for="inputCol" class="col-sm-3 control-label">Colonia</label>
                                                    <div class="col-sm-9">
                                                        <select type="text" class="form-control" id="inputCol" name="inputCol" ></select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDir" class="col-sm-3 control-label">Dirección</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="inputDir" name="inputDir" ></select>
                                                        <input type="text" name="inputDirName" id="inputDirName" class="form-control" disabled placeholder="Selecciona la opción 'otra' para hábilitar esta opción.">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputNum" class="col-sm-3 control-label">Número</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputNum" name="inputNum" >
                                                    </div>
                                                </div>
                                            </div><!-- ./tab-pane -->
                                        </div><!-- ./tab-content -->
                                    </div><!-- ./nav-tabs-custom  -->
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

                <!-- modal actualizar user -->
                <form class="form-horizontal" id="formUpdUser" name="formUpdUser">
                    <div class="modal fade" id="modalUpdUser" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Modificar Usuario</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#navUser" data-toggle="tab">Usuario</a></li>
                                            <li><a href="#navContract" data-toggle="tab">Contrato</a></li>
                                            <li><a href="#navDir" data-toggle="tab">Dirección</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="navUser">
                                                <div class="form-group">
                                                    <label for="inputName" class="col-sm-3 control-label">Nombre</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputIDUser" name="inputIDUser" >
                                                        <input type="text" class="form-control" id="inputName" name="inputName" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAP" class="col-sm-3 control-label">Apellido Paterno</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputAP" name="inputAP" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAM" class="col-sm-3 control-label">Apellido Materno</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputAM" name="inputAM" required>
                                                    </div>
                                                </div>
                                            </div><!-- ./tab-pane -->
                                            <div class="tab-pane" id="navContract">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" id="inputFolio">Folio:</label>
                                                    <div class="input-group col-sm-9">
                                                        <input type="text" class="form-control" id="inputFolio" name="inputFolio" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" id="inputNumContr">Número de Contrato:</label>
                                                    <div class="input-group col-sm-9">
                                                        <input type="text" class="form-control" id="inputNumContr" name="inputNumContr" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="inputTypeContr">Tipo de Contrato:</label>
                                                    <div class="input-group col-sm-9">
                                                        <select type="text" class="form-control" id="inputTypeContr" name="inputTypeContr" ></select>
                                                    </div>
                                                </div>
                                            </div><!-- ./tab-pane -->
                                            <div class="tab-pane" id="navDir">
                                                <div class="form-group">
                                                    <label for="inputCol" class="col-sm-3 control-label">Colonia</label>
                                                    <div class="col-sm-9">
                                                        <select type="text" class="form-control" id="inputCol" name="inputCol" ></select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDir" class="col-sm-3 control-label">Dirección</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="inputDir" name="inputDir" ></select>
                                                        <input type="text" name="inputDirName" id="inputDirName" class="form-control" disabled placeholder="Selecciona la opción 'otra' para hábilitar esta opción.">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputNum" class="col-sm-3 control-label">Número</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputNum" name="inputNum" >
                                                    </div>
                                                </div>
                                            </div><!-- ./tab-pane -->
                                        </div><!-- ./tab-content -->
                                    </div><!-- ./nav-tabs-custom  -->
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

                <!-- modal cobrar -->
                <form class="form-horizontal" id="formAddPay" name="formAddPay" method="post" action="../controllers/create_ticket_pdf.php" target="_blank">
                    <div class="modal fade" id="modalAddPay" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Añadir pago</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#navPay" data-toggle="tab">Pago</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="navPay">
                                                <div class="form-group">
                                                    <label for="inputYearServ" class="col-sm-3 control-label">Año de Servicio</label>
                                                    <div class="col-sm-9">
                                                        <select id="inputYearServ" name="inputYearServ" class="form-control"></select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputTypeService" class="col-sm-3 control-label">Tipo de servicio</label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" class="form-control" id="inputIDUser" name="inputIDUser" >
                                                        <select id="inputTypeService" name="inputTypeService" class="form-control"></select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputMonto" class="col-sm-3 control-label">Monto</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="inputMonto" name="inputMonto" required readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputMonthBegin" class="col-sm-3 control-label">Mes inicio</label>
                                                    <div class="col-sm-9">
                                                        <select id="inputMonthBegin" name="inputMonthBegin" class="form-control">
                                                            <option value="0">Enero</option>
                                                            <option value="1">Febrero</option>
                                                            <option value="2">Marzo</option>
                                                            <option value="3">Abril</option>
                                                            <option value="4">Mayo</option>
                                                            <option value="5">Junio</option>
                                                            <option value="6">Julio</option>
                                                            <option value="7">Agosto</option>
                                                            <option value="8">Septiembre</option>
                                                            <option value="9">Octubre</option>
                                                            <option value="10">Noviembre</option>
                                                            <option value="11">Diciembre</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputMonthEnd" class="col-sm-3 control-label">Mes fin</label>
                                                    <div class="col-sm-9">
                                                        <select id="inputMonthEnd" name="inputMonthEnd" class="form-control">
                                                            <option value="1">Enero</option>
                                                            <option value="2">Febrero</option>
                                                            <option value="3">Marzo</option>
                                                            <option value="4">Abril</option>
                                                            <option value="5">Mayo</option>
                                                            <option value="6">Junio</option>
                                                            <option value="7">Julio</option>
                                                            <option value="8">Agosto</option>
                                                            <option value="9">Septiembre</option>
                                                            <option value="10">Octubre</option>
                                                            <option value="11">Noviembre</option>
                                                            <option value="12">Diciembre</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div><!-- ./tab-pane -->
                                        </div><!-- ./tab-content -->
                                    </div><!-- ./nav-tabs-custom  -->
                                </div><!-- ./modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="guardar_datos" class="btn btn-primary">Generar Ficha de pago</button>
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
                                <h3 class="box-title">Listado de Usuarios</h3>
                                <div class="divError"></div>
                            </div>
                            <div class="box-body">
                                <div class="table table-condensed table-hover table-striped">
                                    <table class="table table-striped table-bordered" id="data">
                                        <thead>
                                            <tr>
                                                <th><span title="nameUser">Nombre</span></th>
                                                <th><span title="ap">Paterno</span></th>
                                                <th><span title="am">Materno</span></th>
                                                <th><span title="folio">Folio</span></th>
                                                <th><span title="numCont">Contrato</span></th>
                                                <th><span title="nameCom">Colonia</span></th>
                                                <th><span title="calle">Dirección</span></th>
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
            $(document).ready(function () {

                //Obtenemos los tipos de contratos
                $.ajax({
                    type: "POST",
                    url: "../controllers/get_contracts.php",
                    success: function (msg) {
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        if (msg.error == 0) {
                            $("#formAddUser .modal-body #inputTypeContr").html("");
                            $.each(msg.dataRes, function (i, item) {
                                $("#formAddUser .modal-body #inputTypeContr").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                                $("#formUpdUser .modal-body #inputTypeContr").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                        } else {
                            $("#formAddUser .modal-body #inputTypeContr").append($('<option>', {
                                value: 0,
                                text: "No existen tipos de contratos aún"
                            }));
                            $("#formUpdUser .modal-body #inputTypeContr").append($('<option>', {
                                value: 0,
                                text: "No existen tipos de contratos aún"
                            }));
                        }
                        $(".loader").hide();
                    },
                    error: function (x, e) {
                        var cadErr = '';
                        if (x.status == 0) {
                            cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                        } else if (x.status == 404) {
                            cadErr = 'Página no encontrada.';
                        } else if (x.status == 500) {
                            cadErr = 'Error interno del servidor.';
                        } else if (e == 'parsererror') {
                            cadErr = 'Error.\nFalló la respuesta JSON.';
                        } else if (e == 'timeout') {
                            cadErr = 'Tiempo de respuesta excedido.';
                        } else {
                            cadErr = 'Error desconocido.\n' + x.responseText;
                        }
                        alert(cadErr);
                    }
                })

                //Obtenemos las colonias
                $.ajax({
                    type: "POST",
                    url: "../controllers/get_comunidades.php",
                    success: function (msg) {
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        if (msg.error == 0) {
                            $("#formAddUser .modal-body #inputCol").html("");
                            $("#formAddUser .modal-body #inputCol").append($('<option>', {
                                value: 0,
                                text: ""
                            }));
                            $("#formUpdUser .modal-body #inputCol").html("");
                            $("#formUpdUser .modal-body #inputCol").append($('<option>', {
                                value: 0,
                                text: ""
                            }));
                            $.each(msg.dataRes, function (i, item) {
                                $("#formAddUser .modal-body #inputCol").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                                $("#formUpdUser .modal-body #inputCol").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                        } else {
                            $("#formAddUser .modal-body #inputCol").append($('<option>', {
                                value: 0,
                                text: "No existen colonias aún"
                            }));
                            $("#formUpdUser .modal-body #inputCol").append($('<option>', {
                                value: 0,
                                text: "No existen colonias aún"
                            }));
                        }
                        $(".loader").hide();
                    },
                    error: function (x, e) {
                        var cadErr = '';
                        if (x.status == 0) {
                            cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                        } else if (x.status == 404) {
                            cadErr = 'Página no encontrada.';
                        } else if (x.status == 500) {
                            cadErr = 'Error interno del servidor.';
                        } else if (e == 'parsererror') {
                            cadErr = 'Error.\nFalló la respuesta JSON.';
                        } else if (e == 'timeout') {
                            cadErr = 'Tiempo de respuesta excedido.';
                        } else {
                            cadErr = 'Error desconocido.\n' + x.responseText;
                        }
                        alert(cadErr);
                    }
                })
                
                //Cambios dinamicos
                $('#formAddUser .modal-body #inputCol').on('change', function () {
                    var idColony = $(this).val();
                    console.log(idColony);
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_streets.php",
                        data: {idColony: idColony},
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            $("#formAddUser .modal-body #inputDir").html("");
                            $("#formAddUser .modal-body #inputDir").append($('<option>', {
                                value: 0,
                                text: ""
                            }));
                            if (msg.error == 0) {
                                $.each(msg.dataRes, function (i, item) {
                                    $("#formAddUser .modal-body #inputDir").append($('<option>', {
                                        value: msg.dataRes[i].id,
                                        text: msg.dataRes[i].calle
                                    }));
                                });
                                $("#formAddUser .modal-body #inputDir").append($('<option>', {
                                    value: 0,
                                    text: "Otra"
                                }));
                            } else {
                                $("#formAddUser .modal-body #inputDir").append($('<option>', {
                                    value: 0,
                                    text: "Otra (" + msg.msgErr + ")"
                                }));
                            }
                            $(".loader").hide();
                        }
                    });
                });
                
                //Cambios dinamicos actualizar usuario
                $('#formUpdUser .modal-body #inputCol').on('change', function () {
                    var idColony = $(this).val();
                    console.log(idColony);
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_streets.php",
                        data: {idColony: idColony},
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            $("#formUpdUser .modal-body #inputDir").html("");
                            $("#formUpdUser .modal-body #inputDir").append($('<option>', {
                                value: 0,
                                text: ""
                            }));
                            if (msg.error == 0) {
                                $.each(msg.dataRes, function (i, item) {
                                    $("#formUpdUser .modal-body #inputDir").append($('<option>', {
                                        value: msg.dataRes[i].id,
                                        text: msg.dataRes[i].calle
                                    }));
                                });
                                $("#formUpdUser .modal-body #inputDir").append($('<option>', {
                                    value: 0,
                                    text: "Otra"
                                }));
                            } else {
                                $("#formUpdUser .modal-body #inputDir").append($('<option>', {
                                    value: 0,
                                    text: "Otra (" + msg.msgErr + ")"
                                }));
                            }
                            $(".loader").hide();
                        }
                    });
                });

                //Habilitar o deshabilitar introducir dirección
                $('#formAddUser .modal-body #inputDir').on('change', function () {
                    var optSel = $(this).val();
                    console.log(optSel);
                    if (optSel == 0) {
                        $('#formAddUser .modal-body #inputDirName').prop('disabled', false);
                    } else {
                        $('#formAddUser .modal-body #inputDirName').prop('disabled', true);
                    }
                })
                
                //Habilitar o deshabilitar introducir direccion al actualizar usuario
                $('#formUpdUser .modal-body #inputDir').on('change', function () {
                    var optSel = $(this).val();
                    console.log(optSel);
                    if (optSel == 0) {
                        $('#formUpdUser .modal-body #inputDirName').prop('disabled', false);
                    } else {
                        $('#formUpdUser .modal-body #inputDirName').prop('disabled', true);
                    }
                })

                filtrar();
                function filtrar() {
                    $(".loader").show();
                    $.ajax({
                        type: "POST",
                        data: ordenar,
                        url: "../controllers/get_users.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td>' + msg.dataRes[i].nombre + '</td>'
                                            + '<td>' + msg.dataRes[i].ap + '</td>'
                                            + '<td>' + msg.dataRes[i].am + '</td>'
                                            + '<td>' + msg.dataRes[i].folio + '</td>'
                                            + '<td>' + msg.dataRes[i].numContr + '</td>'
                                            + '<td>' + msg.dataRes[i].comunidad + '</td>'
                                            + '<td>' + msg.dataRes[i].calle + ' No. ' + msg.dataRes[i].num + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalUpdUser" id="editar" data-value="' + msg.dataRes[i].idUser + '"><i class="fa fa-edit"></i> Editar</a></li>'
                                            + '<li><a href="#" ><i class="fa fa-ban "></i> Bajas</a></li>'
                                            + '<li><a href="#" ><i class="fa fa-undo "></i> Reconexión</a></li>'
                                            + '<li><a href="#" ><i class="fa fa-plus "></i> Altas</a></li>'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalAddPay" data-value="' + msg.dataRes[i].idUser + '" ><i class="fa fa-usd "></i> Pago</a></li>'
                                            + '</ul></div></td>'
                                            + '</tr>';
                                    $(newRow).appendTo("#data tbody");
                                })
                            } else {
                                var newRow = '<tr><td colspan="3">' + msg.msgErr + '</td></tr>';
                                $("#data tbody").html(newRow);
                            }
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            alert(cadErr);
                        }
                    });
                    $(".loader").hide();
                }

                //Ordenar ASC y DESC header tabla
                $("#data th span").click(function () {
                    if ($(this).hasClass("desc")) {
                        $("#data th span").removeClass("desc").removeClass("asc");
                        $(this).addClass("asc");
                        ordenar = "&orderby=" + $(this).attr("title") + " asc";
                    } else {
                        $("#data th span").removeClass("desc").removeClass("asc");
                        $(this).addClass("desc");
                        ordenar = "&orderby=" + $(this).attr("title") + " desc";
                    }
                    filtrar();
                });

                //Buscar usuario
                $("#buscar").keyup(function () {
                    var consulta = $(this).val();
                    $.ajax({
                        type: "POST",
                        data: {ordenar: ordenar, query: consulta},
                        url: "../controllers/get_users.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td>' + msg.dataRes[i].nombre + '</td>'
                                            + '<td>' + msg.dataRes[i].ap + '</td>'
                                            + '<td>' + msg.dataRes[i].am + '</td>'
                                            + '<td>' + msg.dataRes[i].folio + '</td>'
                                            + '<td>' + msg.dataRes[i].numContr + '</td>'
                                            + '<td>' + msg.dataRes[i].comunidad + '</td>'
                                            + '<td>' + msg.dataRes[i].calle + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalUpdColony" id="editar" data-value="' + msg.dataRes[i].id + '"><i class="fa fa-edit"></i> Editar</a></li>'
                                            + '<li><a href="director_cuotas.php?ID=' + msg.dataRes[i].id + '" ><i class="fa fa-usd "></i> Cuotas de servicios</a></li>'
                                            + '</ul></div></td>'
                                            + '</tr>';
                                    $(newRow).appendTo("#data tbody");
                                })
                            } else {
                                var newRow = '<tr><td colspan="3">' + msg.msgErr + '</td></tr>';
                                $("#data tbody").html(newRow);
                            }
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            alert(cadErr);
                        }
                    });
                })

                //Editar 
                $("#data").on("click", "#editar", function () {
                    var idUser = $(this).data('value');
                    console.log(idUser);
                    $(".loader").show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_users.php",
                        data: {idUser: idUser},
                        success: function (msg) {
                            console.log(msg);
                            var datos = jQuery.parseJSON(msg);
                            $("#modalUpdUser .modal-body #inputIDUser").val(datos.dataRes[0].idUser);
                            $("#modalUpdUser .modal-body #inputName").val(datos.dataRes[0].nombre);
                            $("#modalUpdUser .modal-body #inputAP").val(datos.dataRes[0].ap);
                            $("#modalUpdUser .modal-body #inputAM").val(datos.dataRes[0].am);
                            $("#modalUpdUser .modal-body #inputFolio").val(datos.dataRes[0].folio);
                            $("#modalUpdUser .modal-body #inputNumContr").val(datos.dataRes[0].numContr);
                            $("#modalUpdUser .modal-body #inputNum").val(datos.dataRes[0].num);
                            $(".loader").hide();
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            alert(cadErr);
                        }
                    })
                })

                //Obtenemos el idUser para cargar modal de pagos
                $("#modalAddPay").on("show.bs.modal", function(e){
                    var idUser = $(e.relatedTarget).data('value');
                    console.log(idUser);
                    $("#modalAddPay #inputIDUser").val(idUser);
                    //Obtenemos los años de servicio según la colonia del usuario
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_year_services_by_colony_for_idUser.php",
                        data: {idUser: idUser},
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            $("#formAddPay .modal-body #inputYearServ").html("");
                            $("#formAddPay .modal-body #inputYearServ").append($('<option>', {
                                value: 0,
                                text: ""
                            }));
                            if (msg.error == 0) {
                                $.each(msg.dataRes, function (i, item) {
                                    $("#formAddPay .modal-body #inputYearServ").append($('<option>', {
                                        value: msg.dataRes[i].nombre,
                                        text: msg.dataRes[i].nombre
                                    }));
                                });
                            } else {
                                $("#formAddPay .modal-body #inputYearServ").append($('<option>', {
                                    value: 0,
                                    text: "No existen años de servicios aún."
                                }));
                            }
                            $(".loader").hide();
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            alert(cadErr);
                        }
                    })
                })

                //Buscamos tipos de servicios segun el año
                $('#formAddPay .modal-body #inputYearServ').on('change', function () {
                    var yearCuota = $(this).val();
                    console.log(yearCuota);
                    var idUser = $("#modalAddPay #inputIDUser").val();
                    console.log(idUser);
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_services_by_year.php",
                        data: {year: yearCuota, idUser: idUser},
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            $("#formAddPay .modal-body #inputTypeService").html("");
                            $("#formAddPay .modal-body #inputTypeService").append($('<option>', {
                                value: 0,
                                text: ""
                            }));
                            if (msg.error == 0) {
                                $.each(msg.dataRes, function (i, item) {
                                    $("#formAddPay .modal-body #inputTypeService").append($('<option>', {
                                        value: msg.dataRes[i].id,
                                        text: msg.dataRes[i].nombre
                                    }));
                                });
                            } else {
                                $("#formAddPay .modal-body #inputTypeService").append($('<option>', {
                                    value: 0,
                                    text: "No existen servicios aún."
                                }));
                            }
                            $(".loader").hide();
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            alert(cadErr);
                        }
                    })
                }); 
                
                //Obtenemos el monto mensual para iniciar calculos
                $('#formAddPay .modal-body #inputTypeService').on('change', function () {
                    var idCuota = $(this).val();
                    console.log(idCuota);
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_cant_serv.php",
                        data: {idCuota: idCuota},
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            $("#formAddPay .modal-body #inputMonto").html("");
                            if (msg.error == 0) {
                                $("#formAddPay .modal-body #inputMonto").val(msg.dataRes[0].cant);
                            } else {
                                $("#formAddPay .modal-body #inputMonto").val(msg.msgErr);
                            }
                            $(".loader").hide();
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            alert(cadErr);
                        }
                    })
                });    
                    
                //Modificamos monto a pagar
                $('#formAddPay .modal-body #inputMonthBegin').on('change', function () {
                    calcMonto();
                });  
                $('#formAddPay .modal-body #inputMonthEnd').on('change', function () {
                    calcMonto();
                });
                function calcMonto(){
                    var mesInicio = $("#inputMonthBegin").val();
                    var mesFin = $("#inputMonthEnd").val();
                    console.log(mesInicio+"--"+mesFin);
                    var monto = $("#inputMonto").val();
                    var montoTmp = (mesFin - mesInicio) * monto;
                    $("#formAddPay .modal-body #inputMonto").val(montoTmp);
                }
                
                $(document).on("click", ".modal-body li a", function () {
                    tab = $(this).attr("href");
                    $(".modal-body .tab-content div").each(function () {
                        $(this).removeClass("active");
                    });
                    $(".modal-body .tab-content " + tab).addClass("active");
                });


            });
        </script>

        <script>
            var form1 = $("#formAddUser");
            form1.validate({
                ignore: "",
                rules: {
                    inputName: {required: true},
                    inputAP: {required: true},
                    inputAM: {required: true},
                    inputFolio: {required: true},
                    inputNumContr: {required: true},
                    inputTypeContr: {required: true},
                    inputCol: {required: true},
                    inputDir: {required: true},
                    inputNum: {required: true}
                },
                messages: {
                    inputName: "Nombre obligatorio",
                    inputAP: "Apellido paterno obligatorio",
                    inputAM: "Apellido materno obligatorio",
                    inputFolio: "Número de Folio obligatorio",
                    inputNumContr: "Número de contrato obligatorio",
                    inputTypeContr: "Tipo de contrato obligatorio obligatorio",
                    inputCol: "Colonia obligatoria",
                    inputDir: "Calle obligatoria",
                    inputNum: "Número de la casa obligatorio"
                },
                errorPlacement: function (error, element) {
                    error.addClass("help-block");
                    element.parents(".col-sm-9").addClass("has-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                    if (!element.next("span")[ 0 ]) {
                        $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-error").removeClass("has-success");
                    $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-success").removeClass("has-error");
                    $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
                }
            });
            $("#formAddUser").submit(function (event) {
                var form1 = $(this).valid();
                var parametros = $(this).serialize();
                if (this.hasChildNodes('.nav.nav-tabs')) {
                    var validator = $(this).validate();
                    $(this).find("input").each(function () {
                        if (!validator.element(this)) {
                            form1 = false;
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
                        url: "../controllers/create_user.php",
                        data: parametros,
                        success: function (msg) {
                            var datos = jQuery.parseJSON(msg);
                            if (datos.error == 0) {
                                $(".divError").removeClass("bg-danger");
                                $(".divError").addClass("bg-success");
                                $(".divError").html(datos.msg);
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            } else {
                                $(".divError").removeClass("bg-success");
                                $(".divError").addClass("bg-danger");
                                $(".divError").html(datos.msg);
                                $(".loader").hide();
                                setTimeout(function () {
                                    $(".divError").hide();
                                }, 3000);
                            }
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            $(".divError").addClass("bg-danger");
                            $(".divError").html(cadErr);
                            setTimeout(function () {
                                $(".divError").hide();
                            }, 3000);
                        }
                    });
                    event.preventDefault();
                }
            })
        </script>

        <script>
            var form2 = $("#formUpdUser");
            form2.validate({
                ignore: "",
                rules: {
                    inputName: {required: true},
                    inputAP: {required: true},
                    inputAM: {required: true},
                    inputFolio: {required: true},
                    inputNumContr: {required: true},
                    inputTypeContr: {required: true},
                    inputCol: {required: true},
                    inputDir: {required: true},
                    inputNum: {required: true}
                },
                messages: {
                    inputName: "Nombre obligatorio",
                    inputAP: "Apellido paterno obligatorio",
                    inputAM: "Apellido materno obligatorio",
                    inputFolio: "Número de Folio obligatorio",
                    inputNumContr: "Número de contrato obligatorio",
                    inputTypeContr: "Tipo de contrato obligatorio obligatorio",
                    inputCol: "Colonia obligatoria",
                    inputDir: "Calle obligatoria",
                    inputNum: "Número de la casa obligatorio"
                },
                errorPlacement: function (error, element) {
                    error.addClass("help-block");
                    element.parents(".col-sm-9").addClass("has-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                    if (!element.next("span")[ 0 ]) {
                        $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-error").removeClass("has-success");
                    $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-success").removeClass("has-error");
                    $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
                }
            });
            $("#formUpdUser").submit(function (event) {
                var form2 = $(this).valid();
                var parametros = $(this).serialize();
                if (this.hasChildNodes('.nav.nav-tabs')) {
                    var validator = $(this).validate();
                    $(this).find("input").each(function () {
                        if (!validator.element(this)) {
                            form2 = false;
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
                        url: "../controllers/update_user.php",
                        data: parametros,
                        success: function (msg) {
                            console.log(msg);
                            var datos = jQuery.parseJSON(msg);
                            if (datos.error == 0) {
                                $(".loader").hide();
                                $(".divError").removeClass("bg-danger");
                                $(".divError").addClass("bg-success");
                                $(".divError").html(datos.msg);
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            } else {
                                $(".loader").hide();
                                $(".divError").removeClass("bg-success");
                                $(".divError").addClass("bg-danger");
                                $(".divError").html(datos.msg);
                                setTimeout(function () {
                                    $(".divError").hide();
                                }, 3000);
                            }
                        },
                        error: function (x, e) {
                            $(".loader").hide();
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            $(".divError").addClass("bg-danger");
                            $(".divError").html(cadErr);
                            setTimeout(function () {
                                $(".divError").hide();
                            }, 3000);
                        }
                    });
                    event.preventDefault();
                }
            })
        </script>

        <script>
            var form1 = $("#formAddPay");
            form1.validate({
                ignore: "",
                rules: {
                    inputYearServ: {required: true},
                    inputTypeService: {required: true},
                    inputMonto: {required: true},
                    inputMonthBegin: {required: true},
                    inputMonthEnd: {required: true}
                },
                messages: {
                    inputYearServ: "Año del servicio obligatorio",
                    inputTypeService: "Tip ode servicio obligatorio",
                    inputMonto: "Monto obligatorio ¿Si no cómo vamos a cobrar?",
                    inputMonthBegin: "Mes de inicio obligatorio",
                    inputMonthEnd: "Mes de finalización obligatorio"
                },
                errorPlacement: function (error, element) {
                    error.addClass("help-block");
                    element.parents(".col-sm-9").addClass("has-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                    if (!element.next("span")[ 0 ]) {
                        $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-error").removeClass("has-success");
                    $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-success").removeClass("has-error");
                    $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
                }
            });
            $("#formAddPay").submit(function (event) {
                var form1 = $(this).valid();
                var parametros = $(this).serialize();
                if (this.hasChildNodes('.nav.nav-tabs')) {
                    var validator = $(this).validate();
                    $(this).find("input").each(function () {
                        if (!validator.element(this)) {
                            form1 = false;
                            $('a[href=\\#' + $(this).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
                            return false;
                        }
                    });
                }
                if (form1) {
                    /*$(".loader").show();
                    $('#guardar_datos').attr("disabled", true);
                    $.post('../controllers/create_ticket_pdf.php', parametros, function(data){
                        
                    })
                    event.preventDefault();*/
                    form1.submit();
                }
            })
        </script>
        
        <?php
    } else {
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

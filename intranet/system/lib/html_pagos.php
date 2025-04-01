<?php
class html_pagos extends f{
	private $baseurl = "";

	function html_pagos(){
		$this->load()->lib_html("Table", false);
		$this->baseurl = BASEURL;
	}
    function container(){
        $r = '<style>
                .select2-container{
                    width: 100% !important;
                }
            </style>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <span style="float: right; margin-bottom: 10px;" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#formulario" id="btn_nuevo" onclick="nuevo_pago();"><i class="fa fa-plus"></i> Registrar Pago</span>
                        <h5 class="">
                            <i class="fa fa-bars" aria-hidden="true"></i> Registro de Pagos
                        </h5>
                        <small>
                            <i class="far fa-edit"></i> Aquí podrá ver toda la información de todos los Pagos registrados
                        </small>
                        <hr>         
                        <div class="container" style="max-width: 100%;">
                            <div class="row">
                                <div class="table-responsive" >
                                    <table  class="datatable table dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Alumno</th>
                                                <th>M. Pagado</th>
                                                <th>Fecha</th>
                                                <th>Debe</th>
                                                <th>Nº Cuotas</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!----------------------------------------------------------------------->
            <div class="modal fade" id="formulario" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 80%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Nuevo Alumno</h3>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group" style="width: 100%;">
                                <div class="col-12 mb-2">
                                    <label for="">Alumno</label>
                                    <select class="form-control mt-2 mb-1" id="id_alumno">
                                        <option value="-1">--SELECCIONAR--</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-3 mb-2">
                                        <label for="">Concepto</label>
                                        <select class="form-control" id="id_concepto"></select>
                                    </div>
                                    <div class="col-3 mb-2">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control" id="pension" readonly>
                                    </div>
                                    <div class="col-3 mb-2">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control" id="monto">
                                        <span id="sp_deuda" class="badge badge-primary"></span>
                                        <input type="hidden" id="adeuda">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <label for="">Fecha</label>
                                        <input type="text" class="form-control datepicker" id="fecha">
                                    </div>
                                </div>
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-6">
                                        <label >Fecha Desde</label>
                                        <input type="text" class="form-control datepicker" id="fecha_desde" name="fecha_desde">
                                    </div>
                                    <div class="col-6">
                                        <label >Fecha Hasta</label>
                                        <input type="text" class="form-control datepicker" id="fecha_hasta" name="fecha_hasta">
                                    </div>
                                </div>
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-6">
                                        <label >Método de Pago</label>
                                        <select class="form-control" id="id_metodo_pago"></select>
                                    </div>
                                    <div class="col-3">
                                        <label class="d-block">Adjuntar Comprobante</label>
                                        <label for="foto" style="font-weight: bold;">
                                            <i class="fa fa-camera" style="font-size: 2rem; cursor: pointer;"></i>
                                            <input id="foto" class="form-control" name="foto" type="file" style="display: none;"/>
                                        </label>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <img src="" id="profile-img-tag" width="200px" style="margin-left: auto;margin-right: auto;" />
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <progress id="progressBar" class="mt-2" value="0" max="100" style="width:100%;"></progress>
                                    <p id="status"></p>
                                    <p id="loaded_n_total"></p>
                                </div>
                                <div class="form-row text-center">
                                    <button type="submit" class="btn btn-success" id="btn_finalizar">Guardar</button>
                                    <span class="btn btn-danger" type="button" data-dismiss="modal" id="cerrar_formulario_docente" style="margin-left: 10px">
                                        Cancelar
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {

                    $( ".datepicker" ).datetimepicker({
                        format: "Y-m-d",
                        timepicker:false
                    });
                    $.datetimepicker.setLocale(\'es\');
                    var table = $(".datatable").DataTable({
                        "ajax": {
                            url: "' . $this->baseurl . INDEX . 'pagos/loadpagos/",
                            "dataSrc": ""
                        },
                        "columns": [{
                            "data": "alumno"
                        },  {
                            "data": "monto",
                            "render": function(data){
                                return `<span class="badge badge-success">S/ ${data}</span>`
                            }
                        },  {
                            "data": "fecha"
                        }, {
                            "data": "debe",
                            "render": function(data){
                                return `<span class="badge badge-danger">S/ ${data}</span>`
                            }
                        }, {
                            "data": "n_cuotas"
                        }, ],
                        "language": {
                            "url": "'.$this->baseurl.'includes/datatables/Spanish.json"
                        },
                        "lengthMenu": [
                            [10, 15, 20, -1],
                            [10, 15, 20, "All"]
                        ]
                    });
                    $(".datatable tbody").on("click", "#btn_eliminar", function() {
                        var data = table.row($(this).parents("tr")).data();
                        if (data == undefined) {
                            var selected_row = $(this).parents("tr");
                            if (selected_row.hasClass("child")) {
                                selected_row = selected_row.prev();
                            }
                            var rowData = $(".datatable").DataTable().row(selected_row).data();
                            alertify.confirm("<i class=\"fa fa-bars\" aria-hidden=\"true\"></i> Eliminar", "¿Desea eliminar el Alumno <strong>" + rowData["apellidos"] + "</strong>?",
                            function() {
                                eliminar(rowData["id"]);
                                alertify.notify("Se elimino el Alumno <strong>" + rowData["apellidos"] + "</strong> correctamente.", "custom-black", 4, function() {});
                            },
                            function() {
                                alertify.notify("Se cancelo la <strong>eliminación</strong>.", "custom-black", 4, function() {});
                            }).set("labels", { ok: "Eliminar", cancel: "Cancelar" });
                        } else {
                            alertify.confirm("<i class=\"fa fa-bars\" aria-hidden=\"true\"></i> Eliminar", "¿Desea eliminar el Alumno <strong>" + data["apellidos"] + "</strong>?",
                            function() {
                                eliminar(data["id"]);
                                alertify.notify("Se elimino el Alumno <strong>" + data["apellidos"] + "</strong> correctamente.", "custom-black", 4, function() {});
                            },
                            function() {
                                alertify.notify("Se cancelo la <strong>eliminación</strong>.", "custom-black", 4, function() {});
                            }).set("labels", { ok: "Eliminar", cancel: "Cancelar" });
                        }
                    });
                    $(".datatable tbody").on("click", "#btn_editar", function() {
                        var data = table.row($(this).parents("tr")).data();
                        if (data == undefined) {
                            var selected_row = $(this).parents("tr");
                            if (selected_row.hasClass("child")) {
                                selected_row = selected_row.prev();
                            }
                            var rowData = $(".datatable").DataTable().row(selected_row).data();
                            editar(rowData["id"]);
                        } else {
                            editar(data["id"]);
                        }
                    });
                });
                function load_padres(){
                    $.get("' . $this->baseurl . INDEX . 'padres/loadpadres", function(response){
                        var obj = JSON.parse(response);
                        $.each(obj, function(index, val){
                            $("#padre_").append("<option value=" + val.id + ">" + val.apellidos + ", " + val.nombres + "</option>");
                        });
                    });
                }
                function nuevo_alumno(){
                    $("#exampleModalLabel").text("Nuevo Alumno");
                    //$("#form_nuevo").attr("action", "'. $this->baseurl . INDEX . 'alumnos/save");
                    $("#btn_finalizar").text("Guardar");
                    $("#btn_finalizar").attr("onclick", "guardar_alumno();");
                    limpiar_formulario();
                }
                function eliminar(id) {
                    $.ajax({
                        url: "' . $this->baseurl . INDEX . 'alumnos/eliminar",
                        type: "POST",
                        dataType: "html",
                        data: {
                            "id": id,
                        },
                        success: function(data) {
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                        }
                    });
                }
                function limpiar_formulario(){
                    $("#dni").val("");
                    $("#nombres").val("");
                    $("#apellidos").val("");
                    $("#fecha_nacimiento").val("");
                    $("#telefono").val("");
                    $("#direccion").val("");
                    $("#correo").val("");
                    $("#id_padre").val("");
                    //$("#btn_finalizar").removeAttr("onclick");
                    $("#btn_finalizar").text("Guardar");
                }
                function editar(id){
                    $.ajax({
                        url: "' . $this->baseurl . INDEX . 'alumnos/editar",
                        type: "POST",
                        dataType: "json",
                        data: {
                            "id": id,
                        },
                        success: function(data) {
                            $("#div_padre").empty();
                            $("#dni").val(data.dni);
                            $("#nombres").val(data.nombres);
                            $("#apellidos").val(data.apellidos);
                            $("#fecha_nacimiento").val(data.fecha_nacimiento);
                            $("#telefono").val(data.telefono);
                            $("#direccion").val(data.direccion);
                            $("#correo").val(data.correo);
                            $("#id_padre").val(data.id_padre);
                            $("#btn_finalizar").text("Actualizar");
                            
                            $("#profile-img-tag").attr("src", "system/controllers/uploads/" + data.foto);
                            
                            $("#btn_finalizar").attr("onclick", "actualizar_alumno("+data.id+");");
                            $("#form_nuevo").attr("action", "'.$this->baseurl . INDEX . 'alumnos/editarBD");
                            $("#exampleModalLabel").text("Editar Alumno");
                        }
                    });
                }
                $("#cerrar_formulario_docente").click(function(){
                    limpiar_formulario();
                });
                function guardar_alumno(){
                    var file_data = $("#foto").prop("files")[0];
                    var form_data = new FormData();
                    form_data.append("file1", file_data)
                    
                    form_data.append("dni", $("#dni").val())
                    form_data.append("nombres", $("#nombres").val())
                    form_data.append("apellidos", $("#apellidos").val())
                    form_data.append("telefono", $("#telefono").val())
                    form_data.append("fecha_nacimiento", $("#fecha_nacimiento").val())
                    form_data.append("direccion", $("#direccion").val())
                    form_data.append("correo", $("#correo").val())
                    form_data.append("usuario", $("#usuario").val())
                    form_data.append("pass", $("#pass").val())
                    $.ajax({
                        url: "'. $this->baseurl . INDEX . 'alumnos/save",
                        dataType: "script",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         // Setting the data attribute of ajax with file_data
                        type: "post",
                        success: function(response){
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                            alertify.notify("<strong>Alumno</strong> agregado correctamente.", "custom-black", 3, function() {});
                            $("#cerrar_formulario_docente").click();
                        },error: function() {
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                            alertify.notify("<strong>Alumno</strong> agregado correctamente.", "custom-black", 3, function() {});
                            $("#cerrar_formulario_docente").click();
                        }
                    });
                }
                function actualizar_alumno(id){
                    /*$.post("'.$this->baseurl . INDEX . 'alumnos/editarBD", {
                        dni: $("#dni").val(),
                        nombres: $("#nombres").val(), 
                        apellidos: $("#apellidos").val(), 
                        telefono: $("#telefono").val(), 
                        fecha_nacimiento: $("#fecha_nacimiento").val(), 
                        direccion: $("#direccion").val(), 
                        correo: $("#correo").val(),
                        id_padre: $("#id_padre").val(),
                        usuario: $("#usuario").val(),
                        pass: $("#pass").val(),
                        id: id 
                    }, function(response){
                        var obj = JSON.parse(response);
                        if(obj.Result == "OK"){
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                            alertify.notify("<strong>Alumno</strong> Modificado correctamente.", "custom-black", 3, function() {});
                            $("#cerrar_formulario_docente").click();
                            $("#cerrar_alerta").click();
                        }else{
                            alertify.notify("<strong>Algo ha salido muy mal.</strong>", "custom-black", 3, function() {});
                        }
                    });*/
                    
                    var file_data = $("#foto").prop("files")[0];
                    var form_data = new FormData();
                    form_data.append("file1", file_data)
                    
                    form_data.append("dni", $("#dni").val())
                    form_data.append("nombres", $("#nombres").val())
                    form_data.append("apellidos", $("#apellidos").val())
                    form_data.append("telefono", $("#telefono").val())
                    form_data.append("fecha_nacimiento", $("#fecha_nacimiento").val())
                    form_data.append("direccion", $("#direccion").val())
                    form_data.append("correo", $("#correo").val())
                    form_data.append("usuario", $("#usuario").val())
                    form_data.append("pass", $("#pass").val())
                    form_data.append("id", id)
                    $.ajax({
                        url: "'.$this->baseurl . INDEX . 'alumnos/editarBD",
                        dataType: "script",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         // Setting the data attribute of ajax with file_data
                        type: "post",
                        success: function(response){
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                            alertify.notify("<strong>Alumno</strong> modificado correctamente.", "custom-black", 3, function() {});
                            $("#cerrar_formulario_docente").click();
                        },error: function() {
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                            alertify.notify("<strong>Alumno</strong> modificado correctamente.", "custom-black", 3, function() {});
                            $("#cerrar_formulario_docente").click();
                        }
                    });
                }
            </script>';     
            return $r;
        }
    }
?>

<?php
class html_pagos_2 extends f
{
    private $baseurl = "";

    function html_pagos_2()
    {
        $this->load()->lib_html("Table", false);
        $this->baseurl = BASEURL;
    }
    function container()
    {
        $r = '<style>
                .select2-container{
                    width: 100% !important;
                }
            </style>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <span style="float: right; margin-bottom: 10px;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#formulario" id="btn_nuevo" onclick="nuevo_pago();">Nuevo Pago</span>
                        <h5 class="">
                            <i class="fa fa-bars" aria-hidden="true"></i> Registro de Pagos
                        </h5>
                        <small>
                            <i class="fa fa-edit"></i> Aquí podrá ver toda la información de todos los Pagos registrados
                        </small>
                        <hr>         
                        <div class="container" style="max-width: 100%;">
                            <div class="row">
                                <div class="table-responsive" >
                                    <table  class="datatable table dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th>Fecha</th>    
                                            <th>Alumno</th>
                                                <th>M. Pagado</th>
                                                
                                                <th>Concepto</th>
                                                <th>Mes</th>
                                                <th>Eliminar</th>
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
                                    <div class="col-4 mb-2">
                                        <label for="">Pensión</label>
                                        <input type="text" class="form-control" id="pension" readonly>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control" id="monto">
                                        <span id="sp_deuda" class="badge badge-primary"></span>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label for="">Fecha</label>
                                        <input type="text" class="form-control datepicker" id="fecha">
                                    </div>
                                </div>
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-6">
                                        <label >Concepto de Pago</label>
                                        <input type="text" class="form-control" id="concepto" name="concepto">
                                    </div>
                                    <div class="col-6">
                                        <label >Días Plazo de Pago</label>
                                        <input type="text" class="form-control" id="plazo" name="plazo" placeholder="Ex: 5" value="0" readonly>
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
            <!----------------------------------------------------------------------->
            <script>
                $(document).ready(function() {
                    $("#id_alumno").select2({
                        dropdownParent: $("#formulario")
                    });
                    llenar_alumnos();

                    $( ".datepicker" ).datetimepicker({
                        format: "Y-m-d",
                        timepicker:false
                    });
                    var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                    $.datetimepicker.setLocale(\'es\');
                    var table = $(".datatable").DataTable({
                        "ajax": {
                            url: "' . $this->baseurl . INDEX . 'pagos_2/loadpagos/",
                            "dataSrc": ""
                        },
                        order: [[ 0, "desc" ]],
                        "columns": [{
                            "data": "fecha"
                        },{
                            "data": "alumno"
                        },  {
                            "data": "monto",
                            "render": function(data){
                                return `<span class="badge badge-success">S/ ${data}</span>`
                            }
                        }, {
                            "data": "concepto",
                            "render": function(data){
                                return `<span class="" style="white-space: break-spaces;">${$.trim(data)}</span>`
                            }
                        }, {
                            "data": "mes",
                            "render": function(data){
                                if(data > 0){
                                    return `<span class="badge badge-danger">${meses[parseInt(data - 1)]}</span>`
                                }else{
                                    return ``;
                                }
                            }
                        }, {
                            data: "id",
                            "render": function(data){
                                return "<button id=\"btn_eliminar\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash\"></i></button>" + `<a href="system/lib/pdf_venta.php?id_venta=${data}" title="Imprimir" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-file"></i></a>`
                            }
                        }, ],
                        "language": {
                            "url": "' . $this->baseurl . 'includes/datatables/Spanish.json"
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
                            alertify.confirm("<i class=\"fa fa-bars\" aria-hidden=\"true\"></i> Eliminar", "¿Desea eliminar el pago del Alumno <strong>" + rowData["alumno"] + "</strong>?",
                            function() {
                                eliminar(rowData["id"]);
                                alertify.notify("Se elimino el pago del Alumno <strong>" + rowData["alumno"] + "</strong> correctamente.", "custom-black", 4, function() {});
                            },
                            function() {
                                alertify.notify("Se cancelo la <strong>eliminación</strong>.", "custom-black", 4, function() {});
                            }).set("labels", { ok: "Eliminar", cancel: "Cancelar" });
                        } else {
                            alertify.confirm("<i class=\"fa fa-bars\" aria-hidden=\"true\"></i> Eliminar", "¿Desea eliminar el pago del Alumno <strong>" + data["alumno"] + "</strong>?",
                            function() {
                                eliminar(data["id"]);
                                alertify.notify("Se elimino el pago del Alumno <strong>" + data["alumno"] + "</strong> correctamente.", "custom-black", 4, function() {});
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


                    $("#id_alumno").on("change", function(){
                        $.post("' . $this->baseurl . INDEX . 'pagos_2/deuda", {
                            id_alumno: $("#id_alumno").val()
                        }, function(responseText){
                            var obj = JSON.parse(responseText);

                            $("#pension").val(obj[0].pension);
                        });
                    });
                    $("#monto").on("keyup", function(){
                        if($("#monto").val() == ""){
                            $("#sp_deuda").text("Deuda: " + $("#pension").val());
                        }else{
                            $("#sp_deuda").text("Deuda: " + ($("#pension").val() - parseFloat($("#monto").val())));
                        }
                    });
                    
                    $("#monto").on("change", function(){
                        if($("#monto").val() < $("#pension").val()){
                            $("#plazo").removeAttr("readonly");
                        }else{
                            $("#plazo").attr("readonly", true);
                        }
                    });
                });
                function nuevo_pago(){
                    $("#exampleModalLabel").text("Registrar Pago");
                    $("#btn_finalizar").text("Guardar");
                    $("#btn_finalizar").attr("onclick", "guardar_pago();");
                    limpiar_formulario();
                }
                function eliminar(id) {
                    $.ajax({
                        url: "' . $this->baseurl . INDEX . 'pagos_2/eliminar_pago",
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
                function llenar_alumnos(){
                    $.post("' . $this->baseurl . INDEX . 'alumnos/get_alumnos/", function(response){
                        var obj = JSON.parse(response);

                        $.each(obj, function(index, val){
                            $("#id_alumno").append(`<option value="${val.id}">${val.nombres} ${val.apellidos}</option>`);
                        });
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
                    $("#concepto").val("");
                    $("#plazo").val("");
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
                            $("#concepto").val(data.concepto);
                            $("#plazo").val(data.plazo);
                            $("#btn_finalizar").text("Actualizar");
                            
                            $("#profile-img-tag").attr("src", "system/controllers/uploads/" + data.foto);
                            
                            $("#btn_finalizar").attr("onclick", "actualizar_alumno("+data.id+");");
                            $("#form_nuevo").attr("action", "' . $this->baseurl . INDEX . 'alumnos/editarBD");
                            $("#exampleModalLabel").text("Editar Alumno");
                        }
                    });
                }
                $("#cerrar_formulario_docente").click(function(){
                    limpiar_formulario();
                });
                function guardar_pago(){
                    var form_data = new FormData();
                    
                    form_data.append("id_usuario", $("#id_alumno").val());
                    form_data.append("monto", $("#monto").val());
                    form_data.append("fecha", $("#fecha").val());
                    form_data.append("mes", $("#mes").val());
                    form_data.append("concepto", $("#concepto").val());
                    form_data.append("plazo", $("#plazo").val());
                    
                    $.ajax({
                        url: "' . $this->baseurl . INDEX . 'pagos_2/save",
                        dataType: "script",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         // Setting the data attribute of ajax with file_data
                        type: "post",
                        success: function(response){
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                            alertify.notify("<strong>Pago</strong> agregado correctamente.", "custom-black", 3, function() {});
                            $("#cerrar_formulario_docente").click();
                        },error: function() {
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                            alertify.notify("<strong>Pago</strong> agregado correctamente.", "custom-black", 3, function() {});
                            $("#cerrar_formulario_docente").click();
                        }
                    });
                }
            </script>';
        return $r;
    }
}

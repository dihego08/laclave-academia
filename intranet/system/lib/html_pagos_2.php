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
                .table > thead > tr > th { 
                    font-size: 11px !important;

                }
                .table > tbody > tr > td { 
                    font-size: 11px !important;

                }
                tbody td {
                    padding: 5px 7px;
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
                            <i class="fa fa-edit"></i> Aquí podrá ver toda la información de todos los Pagos registrados
                        </small>
                        <hr>         
                        <div class="container" style="max-width: 100%;">
                            <div class="row">
                                <div class="table-responsive" >
                                    <table  class="datatable table table-sm dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>    
                                                <th>Alumno</th>
                                                <th>M. Pagado</th>
                                                <th>Concepto</th>
                                                <th>Adeuda</th>
                                                <th>Metodo Pago</th>
                                                <th></th>
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
                                    <div class="col-6">
                                        <label >Monto</label>
                                        <input type="text" class="form-control" id="monto">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label for="">Fecha</label>
                                        <input type="text" class="form-control datepicker" id="fecha">
                                    </div>
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
                                <div class="col-12 mb-2 form-row">
                                    <table class="table" id="tabla_plan_pagos">
                                        <thead>
                                            <th>Concepto</th>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                            <th>Fecha Pago</th>
                                            <th>Monto Pagado</th>
                                            <th>Debe</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <progress id="progressBar" class="mt-2" value="0" max="100" style="width:100%;"></progress>
                                    <p id="status"></p>
                                    <p id="loaded_n_total"></p>
                                </div>
                                <div class="form-row text-center">
                                    <button type="submit" class="btn btn-success" id="btn_finalizar">Guardar</button>
                                    <span class="btn btn-danger" type="button"  id="cerrar_formulario_docente" style="margin-left: 10px">
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


            <div class="modal fade" id="formulario_pago" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width: 50%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Cancelar Deuda</h3>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group" style="width: 100%;">
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-6 mb-2">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control" id="monto_2">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label for="">Fecha</label>
                                        <input type="text" class="form-control datepicker" id="fecha_2">
                                    </div>
                                </div>
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-6">
                                        <label >Método de Pago</label>
                                        <select class="form-control" id="id_metodo_pago_2"></select>
                                    </div>
                                    <div class="col-3">
                                        <label class="d-block">Adjuntar Comprobante</label>
                                        <label for="foto_2" style="font-weight: bold;">
                                            <i class="fa fa-camera" style="font-size: 2rem; cursor: pointer;"></i>
                                            <input id="foto_2" class="form-control" name="foto" type="file" style="display: none;"/>
                                        </label>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <img src="" id="profile-img-tag_2" width="200px" style="margin-left: auto;margin-right: auto;" />
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <progress id="progressBar_2" class="mt-2" value="0" max="100" style="width:100%;"></progress>
                                    <p id="status_2"></p>
                                    <p id="loaded_n_total_2"></p>
                                </div>
                                <div class="form-row text-center">
                                    <button type="submit" class="btn btn-success" id="btn_finalizar_2">Guardar</button>
                                    <span class="btn btn-danger" type="button" data-dismiss="modal" id="cerrar_formulario_docente_2" style="margin-left: 10px">
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

        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <!----------------------------------------------------------------------->
            <script>
                function get_metodos_pagos(){
                    $.post("' . $this->baseurl . INDEX . 'pagos_2/get_metodos_pagos", function(response){
                        var obj = JSON.parse(response);
                        $("#id_metodo_pago").append(`<option value="0">--SELECCIONAR--</option>`);
                        //id_metodo_pago_2
                        $("#id_metodo_pago_2").append(`<option value="0">--SELECCIONAR--</option>`);
                        $.each(obj, function(index, val){
                            $("#id_metodo_pago").append(`<option value="${val.id}">${val.metodo_pago}</option>`);
                            $("#id_metodo_pago_2").append(`<option value="${val.id}">${val.metodo_pago}</option>`);
                        });
                    });
                }

                function llenar_conceptos(){
                    $.post("' . $this->baseurl . INDEX . 'alumnos/llenar_conceptos_alumno/", {
                        id: $("#id_alumno").val()
                    }, function(response){
                        var obj = JSON.parse(response);
                        /*conceptos_pagos=[];
                        $("#id_concepto").empty();
                        $("#id_concepto").append(`<option value="0" selected>--SELECCIONE--</option>`);
                        $.each(obj, function(index, val){
                            conceptos_pagos.push({
                                id_concepto:val.id,
                                fecha_pago:val.fecha_pago,
                                monto:val.monto
                            });
                            $("#id_concepto").append(`<option value="${val.id}" >${val.concepto}</option>`);
                        });*/
                        $("#tabla_plan_pagos").find("tbody").empty();
                        $.each(obj, function(index, val){
                            let estado = "";
                            let estadoe = "";
                            let checkedd = "";
                            if(val.estado == 0){
                                estado = `<span class="badge badge-danger">Deuda</span>`;
                            }else{
                                estado = `<span class="badge badge-success">Pagado</span>`;
                                estadoe = "disabled";
                                checkedd = "checked";
                            }
                            $("#tabla_plan_pagos").find("tbody").append(`<tr>
                                <td>${val.concepto}</td>
                                <td>${val.fecha}</td>
                                <td>${val.monto}</td>
                                <td>${estado}</td>
                                <td>${$.trim(val.fecha_pago)}</td>
                                <td>${val.monto_pago}</td>
                                <td>${val.monto - val.monto_pago}</td>
                                <td>
                                    <input ${estadoe} type="checkbox" class="cb-dt-selecciona" name="id-plan" value="${val.id}" ${checkedd}>
                                </td>
                            </tr>`);
                        });
                        $(".cb-dt-selecciona").on("click", function(){
                            if($(this).is(":checked")){
                                $(this).parents("tr").css("background", "#bbbbbb");
                            }else{
                                $(this).parents("tr").css("background", "none");
                            }
                            let total = 0;
                            conceptos_seleccionados = 0;
                            $(\'input[name="id-plan"]\').each(function(){
                                if($(this).is(":checked")){
                                    conceptos_seleccionados += ","+$(this).val();
                                    let monto = parseFloat($(this).closest("tr").find("td:eq(2)").text());
                                    total += monto;
                                }
                            });
                            //$("#btn-exportar-carnet").prop("href", "system/lib/generar-carnet.php?id="+conceptos_seleccionados);
                            console.log(conceptos_seleccionados);
                            $("#monto").val(total.toFixed(2));
                        });
                    });
                }
                var conceptos_pagos = [];
                var conceptos_seleccionados = "";
                $(document).ready(function() {
                    

                    get_metodos_pagos();
                    //llenar_conceptos();
                    function readURL_2(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $("#profile-img-tag_2").attr("src", e.target.result);
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $("#profile-img-tag").attr("src", e.target.result);
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $("#foto").change(function(){
                        readURL(this);
                    });
                    $("#foto_2").change(function(){
                        readURL_2(this);
                    });
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
                        dom: "Bfrtip",
                        "columns": [{
                            "data": "fecha"
                        },{
                            "data": "alumno"
                        },  {
                            "data": "monto",
                            "render": function(data){
                                return `<span class="badge badge-success" style="font-size: 13px;">S/ ${data}</span>`
                            }
                        }, {
                            "data": "concepto",
                            "render": function(data){
                                return `<span class="" style="white-space: break-spaces;">${$.trim(data)}</span>`
                            }
                        }, {
                            "data": "adeuda",
                            "render": function(data){
                                if(data > 0){
                                    return `<span class="badge badge-danger"  style="font-size: 13px;">S/ ${data}</span>`+
                                    `<span id="btn_pagar" class="btn btn-outline-info btn-sm mt-1 d-block" title="Actualizar Pago"><i class="fa fa-money"></i></span>`
                                }else{
                                    return ``;
                                }
                            }
                        }, {
                            "data": "metodo_pago"
                        }, {
                            data: "id",
                            "render": function(data, a, b){
                                var boton_ver_imagen = "";
                                if(b.foto_comprobante == null || b.foto_comprobante == "null" || b.foto_comprobante == ""){ }else{
                                    boton_ver_imagen = `<span class="btn btn-outline-primary btn-sm d-block"><a target="_blank" href="system/controllers/comprobantes_pago/${b.foto_comprobante}"><i class="fa fa-image"></i></a></span>`;
                                }
                                return "<button id=\"btn_eliminar\" class=\"btn btn-outline-danger btn-sm d-block mb-1 w-100\"><i class=\"fa fa-trash\"></i></button>" + `<span  title="Imprimir" class="btn btn-outline-info btn-sm mb-1 d-block"><a href="system/lib/pdf_venta.php?id_venta=${data}" target="_blank"><i class="fa fa-file"></i></a></span>`+
                                `${boton_ver_imagen}`
                            }
                        }, ],
                        "language": {
                            "url": "' . $this->baseurl . 'includes/datatables/Spanish.json"
                        },
                        buttons: [
                            "excel"
                        ],
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
                    //btn_pagar
                    $(".datatable tbody").on("click", "#btn_pagar", function() {
                        var data = table.row($(this).parents("tr")).data();
                        if (data == undefined) {
                            var selected_row = $(this).parents("tr");
                            if (selected_row.hasClass("child")) {
                                selected_row = selected_row.prev();
                            }
                            var rowData = $(".datatable").DataTable().row(selected_row).data();
                            abrir_formulario_pago(rowData["id"], rowData["adeuda"], rowData["id_concepto"]);
                        } else {
                            abrir_formulario_pago(data["id"], data["adeuda"], data["id_concepto"]);
                        }
                    });

                    $("#id_alumno").on("change", function(){
                        llenar_conceptos();
                    });
                    $("#id_concepto").on("change", function(){
                        console.log(conceptos_pagos);
                        let concepto_seleccionado = conceptos_pagos.filter((item) => item.id_concepto == $(this).val());
                        console.log(concepto_seleccionado);
                        $("#pension").val(concepto_seleccionado[0].monto);
                    });
                    /*$("#monto").on("keyup", function(){
                        if($("#monto").val() == ""){
                            $("#sp_deuda").text("Deuda: " + $("#pension").val());
                            $("#adeuda").val($("#pension").val());
                        }else{
                            $("#sp_deuda").text("Deuda: " + ($("#pension").val() - parseFloat($("#monto").val())));
                            $("#adeuda").val(($("#pension").val() - parseFloat($("#monto").val())));
                        }
                    });
                    
                    $("#monto").on("change", function(){
                        if($("#monto").val() < $("#pension").val()){
                            $("#plazo").removeAttr("readonly");
                        }else{
                            $("#plazo").attr("readonly", true);
                        }
                    });*/
                    $("#monto").on("change", function () {
                        let montoDisponible = parseFloat($(this).val()) || 0; // Obtener el monto ingresado
                        let suma = 0;

                        $(".cb-dt-selecciona:not(:disabled)").prop("checked", false); // Desmarcar todos los checkboxes

                        $(".cb-dt-selecciona:not(:disabled)").each(function () {
                            let fila = $(this).closest("tr");
                            let montoPagadoPrevio = parseFloat(fila.find("td:eq(5)").text()) || 0; // Monto Pagado actual
                            let montoDebe = parseFloat(fila.find("td:eq(6)").text()) || 0; // Monto que falta pagar

                            if (suma < montoDisponible && montoDebe > 0) {
                                let montoRestante = montoDisponible - suma; // Cuánto nos queda del pago disponible
                                let pagoRealizado = Math.min(montoRestante, montoDebe); // Solo pago lo que falta

                                fila.find("td:eq(5)").text((montoPagadoPrevio + pagoRealizado).toFixed(2)); // Actualizar Monto Pagado
                                fila.find("td:eq(6)").text((montoDebe - pagoRealizado).toFixed(2)); // Actualizar Deuda
                                suma += pagoRealizado; // Acumulamos lo pagado

                                $(this).prop("checked", true); // Marcar checkbox
                            }
                        });
                    });
                });
                function abrir_formulario_pago(id, adeuda, id_concepto){
                    $("#monto_2").val("");
                    $("#fecha_2").val("");
                    $("#id_metodo_pago_2").val(0);

                    $("#formulario_pago").modal("show");
                    $("#btn_finalizar_2").attr("onclick", "actualizar_pago("+id+", \'"+adeuda+"\', "+id_concepto+");");
                }
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
                    /*$("#dni").val("");
                    $("#nombres").val("");
                    $("#apellidos").val("");
                    $("#fecha_nacimiento").val("");
                    $("#telefono").val("");
                    $("#direccion").val("");
                    $("#correo").val("");
                    $("#id_padre").val("");
                    $("#concepto").val("");
                    $("#plazo").val("");
                    $("#btn_finalizar").text("Guardar");*/
                    $("#tabla_plan_pagos").find("tbody").empty();
                            $("#id_alumno").val(0).trigger("change");
                            $("#monto").val("");
                            $("#fecha").val("");
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
                            $("#id_concepto").val(data.id_concepto);
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
                function _(el){
                    return document.getElementById(el);
                }
                function uploadFile(){
                    var file = _("foto").files[0];
                    var formdata = new FormData();
                    formdata.append("foto", file);
                    formdata.append("id_curso", $("#id_curso").val());
                    formdata.append("id_tema", $("#id_tema").val());
                    formdata.append("tarea", $("#tarea").val());
                    formdata.append("fecha_entrega", $("#fecha_entrega").val());
                    formdata.append("parAccion", "guardar_tarea");
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.addEventListener("load", completeHandler, false);
                    ajax.addEventListener("error", errorHandler, false);
                    ajax.addEventListener("abort", abortHandler, false);
                    ajax.open("POST", "../php/tarea.php");
                    ajax.send(formdata);
                }
                function progressHandler(event){
                    _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
                    var percent = (event.loaded / event.total) * 100;
                    _("progressBar").value = Math.round(percent);
                }
                function completeHandler(event){
                    var obj = JSON.parse(event.target.response);
                    if(obj.Result == "OK"){
                        alertify.notify("Realizado Correctamente.</strong>", "custom-black", 4, function() {});
                    }else{
                        if(obj.Code == 125){
                            alertify.notify("El DNI se encuentra registrado ya.</strong>", "custom-black", 4, function() {});
                        }else{
                            alertify.notify("Algo ha salido mal.</strong>", "custom-black", 4, function() {});
                        }
                        
                    }
                    table = $(".datatable").DataTable();
                    table.ajax.reload();
                    limpiar_formulario();
                    //$("#close_formulario_3").click();
                    
                    _("progressBar").value = 0;
                }
                function errorHandler(event){
                    _("status").innerHTML = "Upload Failed";
                }
                function abortHandler(event){
                    _("status").innerHTML = "Upload Aborted";
                }
                function actualizar_pago(id, adeuda, id_concepto){
                    var form_data = new FormData();
                    
                    var file = _("foto_2").files[0];
                    form_data.append("foto", file);
                    
                    form_data.append("pago", $("#monto_2").val());
                    form_data.append("fecha", $("#fecha_2").val());
                    form_data.append("id_metodo_pago", $("#id_metodo_pago_2").val());
                    form_data.append("id", id);
                    form_data.append("adeuda", adeuda);
                    form_data.append("id_concepto", id_concepto);
                    
                    $.ajax({
                        url: "' . $this->baseurl . INDEX . 'pagos_2/updatePago",
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
                            $("#cerrar_formulario_docente_2").click();
                        },error: function() {
                            table = $(".datatable").DataTable();
                            table.ajax.reload();
                            alertify.notify("<strong>Pago</strong> agregado correctamente.", "custom-black", 3, function() {});
                            $("#cerrar_formulario_docente_2").click();
                        }
                    });
                }
                function guardar_pago(){
                    var form_data = new FormData();
                    
                    if($("#monto").val()==""||$("#monto").val()==0){
                        alertify.error("El monto no puede ser vacío o 0."); 
                        return;
                    }/*else if($("#concepto").val()==""){
                        alertify.error("Se debe ingresar un concepto necesariamente."); 
                        return;
                    }*/

                    let pagos = [];

                    $(".cb-dt-selecciona:checked:not(:disabled)").each(function () {
                        let fila = $(this).closest("tr");
                        let idPlan = $(this).val(); // Extrae el ID del checkbox
                        let montoPagado = parseFloat(fila.find("td:eq(5)").text()) || 0; // Obtiene el monto pagado
                        let monto = parseFloat(fila.find("td:eq(2)").text()) || 0; // Obtiene el monto pagado

                        pagos.push({
                            id_plan: idPlan,
                            monto_pagado: montoPagado,
                            monto: monto
                        });
                    });

                    if (pagos.length === 0) {
                        alert("No hay pagos seleccionados.");
                        return;
                    }

                    var file = _("foto").files[0];
                    form_data.append("foto", file);
                    
                    form_data.append("id_usuario", $("#id_alumno").val());
                    form_data.append("monto", $("#monto").val());
                    form_data.append("fecha", $("#fecha").val());
                    //form_data.append("mes", $("#mes").val());
                    //form_data.append("concepto", $("#id_concepto option:selected").text());
                    /*form_data.append("adeuda", $("#adeuda").val());
                    form_data.append("plazo", $("#plazo").val());*/
                    form_data.append("id_metodo_pago", $("#id_metodo_pago").val());
                    //form_data.append("id_concepto", $("#id_concepto").val());
                    form_data.append("pagos", JSON.stringify(pagos));
                    form_data.append("fecha_desde", $("#fecha_desde").val());
                    form_data.append("fecha_hasta", $("#fecha_hasta").val());
                    
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
                            $("#tabla_plan_pagos").find("tbody").empty();
                            $("#id_alumno").val(0).trigger("change");
                            $("#monto").val("");
                            $("#fecha").val("");
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

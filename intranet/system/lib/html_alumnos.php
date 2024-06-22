<?php
class html_alumnos extends f
{
    private $baseurl = "";

    function html_alumnos()
    {
        $this->load()->lib_html("Table", false);
        $this->baseurl = BASEURL;
    }
    function container()
    {
        $r = '<script>
                function abrir_modal(b,a){alertify.dialog(b,function(){return{main:function(c){this.setContent(c);},setup:function(){return{focus:{element:function(){return this.elements.body.querySelector(this.get("selector"));
                },select:true},options:{basic:false,title:a,maximizable:false,resizable:false,padding:true,modal:true,transition:false,}};},settings:{selector:undefined}};
                });}
            </script>
            <style>
                .select2-container{
                    width: 100% !important;
                }
                /*#myelement {
                    position: relative;
                    overflow: hidden;
                  }*/
                  #myelement {
                    /*content: "";
                    position: absolute;
                    width: 200%;
                    height: 200%;
                    top: -50%;
                    left: -50%;
                    z-index: -1;*/
                    background: url(/img/logo_rotado.jpeg);
                    /*transform: rotate(30deg);*/
                    background-position: center;
                    background-size: 90%;
                    background-repeat: no-repeat;
                  }
                                    
            </style>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <span style="float: right; margin-bottom: 10px;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#formulario" id="btn_nuevo" onclick="nuevo_alumno();">Nuevo Alumno</span>
                        <a style="float: right; margin-bottom: 10px;" class="btn btn-sm btn-info" href="system/lib/exportar_excel_alumnos.php">
                            <span >Exportar EXCEL</span>
                        </a>
                        <a href="system/lib/generar-carnet.php?id=0" id="btn-exportar-carnet" style="float: right; margin-bottom: 10px;" class="btn btn-maroon btn-sm"><i class="fa fa-id-badge"></i> Imprimir Carnet</a>
                        <h5 class="">
                            <i class="fa fa-bars" aria-hidden="true"></i> Lista de Alumnos
                        </h5>
                        <small>
                            <i class="fa fa-edit"></i> Aquí podrá ver toda la información de todos los Alumnos
                        </small>
                        <hr>         
                        <div class="container" style="max-width: 100%;">
                            <div class="row">
                                <div class="table-responsive" >
                                    
                                    <table  class="datatable table dt-responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Id</th>
                                                <th>Habilitar</th>
                                                <th>Foto</th>
                                                <th>N° Doc.</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Correos</th>
                                                <th>Carrera</th>
                                                <th>Ciclo -<br> Grupo</th>
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
            <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label for="">Nombres</label>
                                    <input type="text" class="form-control" id="ins_nombres">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="">Apellidos</label>
                                    <input type="text" class="form-control" id="ins_apellidos">
                                </div>
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-md-6">
                                        <label for="">Número de Documento</label>
                                        <input type="text" class="form-control" id="ins_dni">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Celular</label>
                                        <input type="text" class="form-control" id="ins_celular">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="">Fecha de Nacimiento</label>
                                    <input type="text" class="form-control datepicker" id="ins_fec_nacimiento">
                                </div>
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-12 col-md-6">
                                        <label for="">Correo Electronico</label>
                                        <input type="text" class="form-control" id="ins_correo">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="">Correo Corporativo</label>
                                        <input type="text" class="form-control" id="ins_correo_corporativo">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="">Usuario (*)</label>
                                    <input type="text" class="form-control" id="ins_usuario">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="">Contraseña (*)</label>
                                    <input type="password" class="form-control" id="ins_pass">
                                </div>

                                <div class="col-12 mb-2 form-row">
                                    <div class="col-12 col-md-4">
                                        <label for="">Universidad</label>
                                        <select class="form-control" id="ins_universidad">
                                            <option value="-1">--SELECCIONA--</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="">Ciclo Academico</label>
                                        <select class="form-control" id="ins_ciclo">
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="bold">Grupo</label><br>
                                        <select class="form-control" id="ins_grupo">
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Carrera</label>
                                        <select class="form-control" id="ins_carrera">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-2 form-row">
                                    <div class="col-6 col-md-6">
                                        <label>Día de Pago de Mensualidad</label>
                                        <select class="form-control" id="fecha_pago" name="fecha_pago">
                                            <option value="01">01 de Cada Mes</option>
                                            <option value="02">02 de Cada Mes</option>
                                            <option value="03">03 de Cada Mes</option>
                                            <option value="04">04 de Cada Mes</option>
                                            <option value="05">05 de Cada Mes</option>
                                            <option value="06">06 de Cada Mes</option>
                                            <option value="07">07 de Cada Mes</option>
                                            <option value="08">08 de Cada Mes</option>
                                            <option value="09">09 de Cada Mes</option>
                                            <option value="10">10 de Cada Mes</option>
                                            <option value="11">11 de Cada Mes</option>
                                            <option value="12">12 de Cada Mes</option>
                                            <option value="13">13 de Cada Mes</option>
                                            <option value="14">14 de Cada Mes</option>
                                            <option value="15">15 de Cada Mes</option>
                                            <option value="16">16 de Cada Mes</option>
                                            <option value="17">17 de Cada Mes</option>
                                            <option value="18">18 de Cada Mes</option>
                                            <option value="19">19 de Cada Mes</option>
                                            <option value="20">20 de Cada Mes</option>
                                            <option value="21">21 de Cada Mes</option>
                                            <option value="22">22 de Cada Mes</option>
                                            <option value="23">23 de Cada Mes</option>
                                            <option value="24">24 de Cada Mes</option>
                                            <option value="25">25 de Cada Mes</option>
                                            <option value="26">26 de Cada Mes</option>
                                            <option value="27">27 de Cada Mes</option>
                                            <option value="28">28 de Cada Mes</option>
                                            <option value="29">29 de Cada Mes</option>
                                            <option value="30">30 de Cada Mes</option>
                                            <option value="31">31 de Cada Mes</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label>Monto Pago Pensión</label>
                                        <input type="text" class="form-control" id="pension" name="pension" placeholder="Ex: 500.00">
                                    </div>
                                </div>
                                <div class="col-md-12 form-row">
                                    <div class="col-md-6 text-center">    
                                        <label class="w-100">Foto</label>
                                        <label for="foto" style="font-weight: bold;">Seleccionar imagen
                                            <input id="foto" class="form-control" name="foto" type="file" style="display: none;"/>
                                        </label>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img class="mt-2" src="" id="profile-img-tag" width="200px" style="margin-left: auto;margin-right: auto;" />
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <progress id="progressBar" class="mt-2" value="0" max="100" style="width:100%;"></progress>
                                    <p id="status"></p>
                                    <p id="loaded_n_total"></p>
                                </div>
                                <div class="form-row">
                                    <button type="submit" class="btn btn-success pull-right" id="btn_finalizar">Guardar</button>
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

            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
            <script>
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
            </script>
            <script>
                function llenar_universidades(){
                    $.post("' . $this->baseurl . INDEX . 'universidades/loaduniversidades/", function(response){
                        var obj = JSON.parse(response);

                        $.each(obj, function(index, val){
                            $("#ins_universidad").append(`<option value="${val.id}">${val.universidad}</option>`);
                        });
                    });
                }
                function llenar_ciclos(id_universidad, id_ciclo){
                    $.post("' . $this->baseurl . INDEX . 'ciclos/by_universidad/", {
                        id_universidad: id_universidad
                    }, function(response){
                        var obj = JSON.parse(response);

                        $("#ins_ciclo").empty();
                        $("#ins_ciclo").append(`<option value="-1" >--SELECCIONA--</option>`);
                        $.each(obj.Records, function(index, val){
                            if(val.id == id_ciclo){
                                $("#ins_ciclo").append(`<option value="${val.id}" selected>${val.ciclo}</option>`);
                            }else{
                                $("#ins_ciclo").append(`<option value="${val.id}">${val.ciclo}</option>`);
                            }
                        });
                    });
                }
                function llenar_grupos(id_ciclo, id_grupo){
                    $.post("' . $this->baseurl . INDEX . 'grupos/loadgrupos/", {
                        id_ciclo: id_ciclo
                    }, function(data){
                        var obj = JSON.parse(data);

                        $("#ins_grupo").empty();
                        $.each(obj, function(index, val){
                            if(val.id == id_grupo){
                                $("#ins_grupo").append(`<option value="${val.id}" selected>${val.grupo}</option>`);
                            }else{
                                $("#ins_grupo").append(`<option value="${val.id}">${val.grupo}</option>`);
                            }
                        });
                    });
                }
                function llenar_carreras(id_universidad, id_carrera){
                    $.post("' . $this->baseurl . INDEX . 'carreras/by_universidad/", {
                        id_universidad: id_universidad
                    }, function(response){
                        var obj = JSON.parse(response);

                        $("#ins_carrera").empty();
                        $.each(obj.Records, function(index, val){
                            if(val.id == id_carrera){
                                $("#ins_carrera").append(`<option value="${val.id}" selected>${val.carrera}</option>`);
                            }else{
                                $("#ins_carrera").append(`<option value="${val.id}">${val.carrera}</option>`);
                            }
                        });
                    });
                }
                $(document).ready(function() {
                    var ids_alumnos = 0;
                    llenar_universidades();

                    $("#ins_universidad").on("change", function(){
                        if($(this).val() == -1 || $(this).val() == "-1"){
                        }else{
                            llenar_ciclos($(this).val(), 0);
                            llenar_carreras($(this).val(), 0);
                        }
                    });

                    $("#ins_ciclo").on("change", function(){
                        if($(this).val() == "-1" || $(this).val() == -1){
                        }else{
                            llenar_grupos($(this).val());
                        }
                    });

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
                    $(".js-example-basic-single").select2();
                    
                    $( ".datepicker" ).datetimepicker({
                        format: "Y-m-d",
                        timepicker:false
                    });
                    $("#ins_id_tipo_profesional").on("change", function () {
                        if ($(this).val() == -1 || $(this).val() == "-1") {
                            $("#ins_precio").val("");
                        } else {
                            if ($(this).val() == 5) {
                                $("#ins_cuotas").attr(\'disabled\', true);
                                $("#ins_precio").val(parseFloat(650.00).toFixed(2));
                                precio_cambiante = parseFloat(650.00).toFixed(2);

                                $("#imagen_tipo_estudiante").text("Adjuntar Certificado de Habilidad");

                            }else if($(this).val() == 6){
                                $("#ins_cuotas").attr(\'disabled\', true);
                                $("#ins_precio").val(parseFloat(400.00).toFixed(2));
                                precio_cambiante = parseFloat(400.00).toFixed(2);

                                $("#imagen_tipo_estudiante").text("Adjuntar Carnet de Identidad");
                            }else{
                                if($(this).val() == 1){
                                    $("#imagen_tipo_estudiante").text("Adjuntar Titulo");
                                }else if($(this).val() == 2){
                                    $("#imagen_tipo_estudiante").text("Adjuntar Carnet Universitario");
                                }else if($(this).val() == 3){
                                    $("#imagen_tipo_estudiante").text("Adjuntar Ficha Ruc");
                                }
                                $("#ins_cuotas").removeAttr(\'disabled\')
                                $.post("../logic/servicios.php?parAccion=get_prices", {
                                    id_tipo_estudiante: $(this).val()
                                }, function (response) {
                                    var obj = JSON.parse(response);

                                    $("#ins_precio").val(obj.precio);
                                    precio_cambiante = obj.precio;
                                });
                            }
                            
                        }
                    });
                    $.datetimepicker.setLocale(\'es\');
                    
                    var table = $(".datatable").DataTable({
                        "ajax": {
                            url: "' . $this->baseurl . INDEX . 'alumnos/loadalumnos/",
                            "dataSrc": ""
                        },
                        "columns": [{
                            "data": "id",
                            "className": "dt-selecciona",
                            "render": function (data, type, full, meta){
                                return `<input type="checkbox" class="cb-dt-selecciona" name="id-alumno" value="${data}">`;
                            },
                        }, {
                            "data": "id"
                        }, {
                            "data": "estado",
                            "render": function(data, a, b){
                                if(data == 1){
                                    return "<button id=\"btn_editar\" data-toggle=\"modal\" data-target=\"#formulario\" style=\"display: block;\" class=\"w-100 btn btn-warning btn-sm\" ><i class=\"fa fa-pencil\"></i></button><button id=\"btn_eliminar\"  style=\"display: block;\" class=\"w-100 mt-1 btn btn-danger btn-sm mb-1\"><i class=\"fa fa-trash\"></i></button>"+"<span id=\"btn_rem\" class=\"badge badge-danger\" style=\"cursor: pointer;\" title=\"Deshabilitar Acceso\">DESHABILITAR</span>"
                                }else{
                                    return "<button id=\"btn_editar\" data-toggle=\"modal\" data-target=\"#formulario\" style=\"display: block;\" class=\"w-100 btn btn-warning btn-sm\" ><i class=\"fa fa-pencil\"></i></button><button id=\"btn_eliminar\"  style=\"display: block;\" class=\"w-100 mt-1 btn btn-danger btn-sm mb-1\"><i class=\"fa fa-trash\"></i></button>"+"<span id=\"btn_add\" class=\"badge badge-success\" style=\"cursor: pointer;\" title=\"Habilitar Acceso\">HABILITAR</span>"
                                }
                            },
                        },  {
                            "data": "foto",
                            "render": function(data){
                                if(data == null || data == "null" || data == ""){
                                    return `Sin Foto`;
                                }else{
                                    return `<a href="system/controllers/photo/${data}" target="_blank"><img src="system/controllers/photo/${data}"></a>`;
                                }
                            }
                        },  {
                            "data": "dni"
                        }, {
                            "data": "nombres"
                        }, {
                            "data": "apellidos"
                        }, {
                            "data": "correo"
                        }, {
                            "data": "carrera"
                        }, {
                            "data": "ciclo"
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
                    $(".datatable tbody").on("click", ".cb-dt-selecciona", function(){
                        if($(this).is(":checked")){
                            $(this).parents("tr").css("background", "#bbbbbb");
                        }else{
                            $(this).parents("tr").css("background", "none");
                        }
                        ids_alumnos = 0;
                        $(\'input[name="id-alumno"]\').each(function(){
                            if($(this).is(":checked")){
                                ids_alumnos += ","+$(this).val();
                            }
                        });
                        $("#btn-exportar-carnet").prop("href", "system/lib/generar-carnet.php?id="+ids_alumnos);
                    });
                    $(".datatable tbody").on("click", "#btn_rem", function() {
                        var data = table.row($(this).parents("tr")).data();
                        if (data == undefined) {
                            var selected_row = $(this).parents("tr");
                            if (selected_row.hasClass("child")) {
                                selected_row = selected_row.prev();
                            }
                            var rowData = $(".datatable").DataTable().row(selected_row).data();
                            rem(rowData["id"]);
                        } else {
                            rem(data["id"]);
                        }
                    });
                    $(".datatable tbody").on("click", "#btn_add", function() {
                        var data = table.row($(this).parents("tr")).data();
                        if (data == undefined) {
                            var selected_row = $(this).parents("tr");
                            if (selected_row.hasClass("child")) {
                                selected_row = selected_row.prev();
                            }
                            var rowData = $(".datatable").DataTable().row(selected_row).data();
                            add(rowData["id"]);
                        } else {
                            add(data["id"]);
                        }
                    });
                });
                function add(id){
                    $.post("' . $this->baseurl . INDEX . 'alumnos/add_index", {
                        id: id
                    }, function(response){
                        var obj = JSON.parse(response);
                        if(obj.Result == "OK"){
                            table = $(".datatable").DataTable();
                            table.ajax.reload();    
                        }else{
                            alertify.notify("<strong>Algo ha salido terriblemente mal</strong>.", "custom-black", 3, function() {});
                        }
                    });
                }
                function rem(id){
                    $.post("' . $this->baseurl . INDEX . 'alumnos/rem_index", {
                        id: id
                    }, function(response){
                        var obj = JSON.parse(response);
                        if(obj.Result == "OK"){
                            table = $(".datatable").DataTable();
                            table.ajax.reload();    
                        }else{
                            alertify.notify("<strong>Algo ha salido terriblemente mal</strong>.", "custom-black", 3, function() {});
                        }
                    });
                }
                
                function nuevo_alumno(){
                    $("#exampleModalLabel").text("Nuevo Alumno");
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
                    $("#ins_correo_corporativo").val("");
                    $("#id_padre").val("");
                    $("#pension").val("");
                    $("#profile-img-tag").attr("src", "");
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

		                    $("#ins_nombres").val(data.nombres);
                            $("#ins_apellidos").val(data.apellidos);
                            $("#ins_celular").val(data.telefono);
                            $("#ins_fec_nacimiento").val(data.fecha_nacimiento);
                            $("#ins_correo").val(data.correo);
                            $("#ins_correo_corporativo").val(data.correo_corporativo);
                            $("#ins_usuario").val(data.usuario);
                            $("#ins_pass").val(data.pass);
                            $("#ins_dni").val(data.dni);
                            $("#ins_universidad").val(data.id_universidad);
                            
                            $("#pension").val(data.pension);

                            $("#fecha_pago").val(data.fecha_pago);

                            $("#profile-img-tag").attr("src", "system/controllers/photo/"+data.foto);

                            llenar_ciclos(data.id_universidad, data.id_ciclo);
                            llenar_carreras(data.id_universidad, data.id_carrera);
                            llenar_grupos(data.id_ciclo, data.id_grupo);
                            
                            $("#btn_finalizar").attr("onclick", "actualizar_alumno("+data.id+");");
                            $("#btn_finalizar").text("Actualizar");
                            $("#form_nuevo").attr("action", "' . $this->baseurl . INDEX . 'alumnos/editarBD");
                            $("#exampleModalLabel").text("Editar Alumno");
                        }
                    });
                }
                $("#cerrar_formulario_docente").click(function(){
                    limpiar_formulario();
                });
                function guardar_alumno(){
                    var formdata = new FormData();

                    if($("#ins_universidad").val() == -1 || $("#ins_universidad").val() == "-1"){
                        bootbox.alert("Se debe seleccionar una universidad");
                    }else if($("#ins_ciclo").val() == -1 || $("#ins_ciclo").val() == "-1"){
                        bootbox.alert("Se debe de seleccionar un ciclo academico");
                    }else if($("#ins_grupo").val() == -1 || $("#ins_grupo").val() == "-1"){
                        bootbox.alert("Se debe de seleccionar un grupo");
                    }else{
                        var file = _("foto").files[0];

                        formdata.append("foto", file);
                        formdata.append("nombres", $("#ins_nombres").val());
                        formdata.append("apellidos", $("#ins_apellidos").val());
                        formdata.append("telefono", $("#ins_celular").val());
                        formdata.append("fecha_nacimiento", $("#ins_fec_nacimiento").val());
                        formdata.append("correo", $("#ins_correo").val());
                        formdata.append("correo_corporativo", $("#ins_correo_corporativo").val());
                        formdata.append("usuario", $("#ins_usuario").val());
                        formdata.append("pass", $("#ins_pass").val());
                        formdata.append("dni", $("#ins_dni").val());
                        formdata.append("id_universidad", $("#ins_universidad").val());
                        formdata.append("id_ciclo", $("#ins_ciclo").val());
                        formdata.append("id_carrera", $("#ins_carrera").val());
                        formdata.append("id_grupo", $("#ins_grupo").val());

                        formdata.append("fecha_pago", $("#fecha_pago").val());
                        formdata.append("pension", $("#pension").val());
                        
                        var ajax = new XMLHttpRequest();
                        ajax.upload.addEventListener("progress", progressHandler, false);
                        ajax.addEventListener("load", completeHandler, false);
                        ajax.addEventListener("error", errorHandler, false);
                        ajax.addEventListener("abort", abortHandler, false);
                        ajax.open("POST", "' . $this->baseurl . INDEX . 'alumnos/save");
                        ajax.send(formdata);
                    }
                }
                
                function actualizar_alumno(id){

                    var formdata = new FormData();

                    if($("#ins_universidad").val() == -1 || $("#ins_universidad").val() == "-1"){
                        bootbox.alert("Se debe seleccionar una universidad");
                    }else if($("#ins_ciclo").val() == -1 || $("#ins_ciclo").val() == "-1"){
                        bootbox.alert("Se debe de seleccionar un ciclo academico");
                    }else {
                        var file = _("foto").files[0];

                        formdata.append("foto", file);
                        formdata.append("nombres", $("#ins_nombres").val());
                        formdata.append("apellidos", $("#ins_apellidos").val());
                        formdata.append("telefono", $("#ins_celular").val());
                        formdata.append("fecha_nacimiento", $("#ins_fec_nacimiento").val());
                        formdata.append("correo", $("#ins_correo").val());
                        formdata.append("correo_corporativo", $("#ins_correo_corporativo").val());
                        formdata.append("usuario", $("#ins_usuario").val());
                        formdata.append("pass", $("#ins_pass").val());
                        formdata.append("dni", $("#ins_dni").val());
                        formdata.append("id_universidad", $("#ins_universidad").val());
                        formdata.append("id_ciclo", $("#ins_ciclo").val());
                        formdata.append("id_carrera", $("#ins_carrera").val());
                        formdata.append("id_grupo", $("#ins_grupo").val());

                        formdata.append("fecha_pago", $("#fecha_pago").val());
                        formdata.append("pension", $("#pension").val());

                        formdata.append("id", id);
                        
                        var ajax = new XMLHttpRequest();
                        ajax.upload.addEventListener("progress", progressHandler, false);
                        ajax.addEventListener("load", completeHandler, false);
                        ajax.addEventListener("error", errorHandler, false);
                        ajax.addEventListener("abort", abortHandler, false);
                        ajax.open("POST", "' . $this->baseurl . INDEX . 'alumnos/editarBD");
                        ajax.send(formdata);
                    }
                }
            </script>';
        return $r;
    }
}

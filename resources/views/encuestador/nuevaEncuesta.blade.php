@extends('layouts.app')

@section('content')
<script>
 function changeEfectivo(t)
        {
            console.log(t.value)
            if(t.value == "efectivo")
            {
                $('.efectiva').show();
                $('.no-efectiva').hide();
                $("#componentes").prop('required',true);
                $("#motivo_rechazo").removeAttr('required');
                $("#no_efectiva_ausente").removeAttr('required');
                $("#no_efectiva_rechazo").removeAttr('required');;
                $("#no_efectiva_otros").removeAttr('required');;
                $("#submit").html("Guardar y cargar componentes")
            }
            else if (t.value == "no")
            {
                $('.no-efectiva').show();
                $('.efectiva').hide();
                $("#componentes").removeAttr('required');
                $("#motivo_rechazo").prop('required',true);
                 $("$submit").html("Guardar")
            }
            else
            {
                $('.no-efectiva').hide();
                $('.efectiva').hide();
                $("#componentes").removeAttr('required');
                $("#motivo_rechazo").removeAttr('required');
                  $("$submit").html("Guardar")
            }
        }

function changeRechazo(t)
        {
            val = (t.value)
            switch (val) {
                case 'ausente':
                    $('.no_efectiva_ausente').show()
                    $("#no_efectiva_ausente").prop('required',true);;
                    $('.no_efectiva_rechazo').hide()
                    $("#no_efectiva_rechazo").removeAttr('required');;
                    $('.no_efectiva_otros').hide()
                    $("#no_efectiva_otros").removeAttr('required');;
                break;
                case 'rechazo':
                    $('.no_efectiva_ausente').hide()
                    $("#no_efectiva_ausente").removeAttr('required');;
                    $('.no_efectiva_rechazo').show()
                    $("#no_efectiva_rechazo").prop('required',true);;
                    $('.no_efectiva_otros').hide()
                    $("#no_efectiva_otros").removeAttr('required');;
                break;
                case 'otros':
                    $('.no_efectiva_ausente').hide()
                    $("#no_efectiva_ausente").removeAttr('required');;
                    $('.no_efectiva_rechazo').hide()
                    $("#no_efectiva_rechazo").removeAttr('required');;
                    $('.no_efectiva_otros').show()
                    $("#no_efectiva_otros").prop('required',true);;
                break;
            }
        }


$(document).ready(function(){
    console.log("ready");
    $('.no-efectiva').hide();
    $('.efectiva').hide();
    $('.no_efectiva_ausente').hide();
    $('.no_efectiva_rechazo').hide();
    $('.no_efectiva_otros').hide();


});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Cargar Encuesta para Área {{$area->id }} </br> (Año:{{$area->anio}} Trimestre:{{$area->trimestre}} Semana:{{$area->semana}} Visita:{{$area->visita}})</div>

                <div class="card-body">
                <form class="form" method="POST" action="{{route('saveEncuesta')}}">
                        @csrf
                        <input type="hidden" name="area_id" value="{{$area->id}}">
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                          <label for="">Listado</label>
                          <input type="number" required
                            class="form-control" name="listado" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                          <label for="">Vivienda</label>
                          <input type="number" value="1" required
                            class="form-control" name="vivienda" id="" aria-describedby="helpId" placeholder="">
                             </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                          <label for="">Hogar</label>
                          <input type="number" value="1" required
                            class="form-control" name="hogar" id="" aria-describedby="helpId" placeholder="">
                             </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                             <label for="">Efectiva?</label>
                            <select name="efectiva" id="" class="form-control"
                            onchange="changeEfectivo(this)"
                            required>
                                <option value="">-</option>
                                <option value="efectivo">Efectiva</option>
                                <option value="no">No-Efectiva</option>
                            </select>
                            </div>
                            </div>
                        </div>

                        <div class="row efectiva" >
                          <div class="col-md-4">
                             <div class="form-group efectivo-cantidad">
                               <label for="">Cantidad de Componentes</label>
                               <input type="text"
                                 class="form-control" name="cantidad" id="componentes" aria-describedby="helpId" placeholder="">
                             </div>
                          </div>
                        </div>
                        <div class="row no-efectiva" >
                          <div class="col-md-4">
                                    <div class="form-group no-efectivo">
                                        <label for="">Motivo</label>
                                        <select class="form-control" name="tipo_no_efectiva" id="motivo_rechazo" onchange="changeRechazo(this)">
                                            <option value="">-</option>
                                            <option value="ausente">Ausencia</option>
                                            <option value="rechazo">Rechazo</option>
                                            <option value="otros">Otros Motivos</option>
                                        </select>
                                        </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group no_efectiva_ausente">
                              <label for="">Ausente</label>
                              <select class="form-control" name="no_efectiva_ausente" id="no_efectiva_ausente" value="-" >
                                  <option value="">-</option>
                                <option value="1">No se pudo contactar en 3 visitas</option>
                                <option value="2">Por causas Circunstanciales</option>
                                <option value="3">Viaje</option>
                                <option value="4">Vacaciones</option>
                              </select>
                            </div>

                            <div class="form-group no_efectiva_rechazo">
                              <label for="">Rechazo</label>
                              <select class="form-control" name="no_efectiva_rechazo" id="no_efectiva_rechazo" value="-" >
                                  <option value="">-</option>
                                <option value="1">Negativa Rotunda</option>
                                <option value="2">Rechazo por portero electrico</option>
                                <option value="3">Se acordaron entrevistas que no se concretaron</option>

                              </select>
                            </div>

                            <div class="form-group no_efectiva_otros">
                              <label for="">Otras Causas</label>
                              <select class="form-control" name="no_efectiva_otros" id="no_efectiva_otros" value="-">
                                  <option value="">-</option>
                                <option value="1">Duelo</option>
                                <option value="2">Alcoholismo, Discapacidad, Idioma Extranjero</option>
                                <option value="3">Problema de Seguridad</option>
                                <option value="4">inaccesible</option>
                              </select>
                            </div>
                        </div>
                           {{-- end no-efectiva --}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Comentarios</label>
                                  <input type="text"
                                    class="form-control" name="comentarios" id="" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                             <div class="form-group ">
                                <button type="submit" id="submit" class="btn btn-primary">Guardar</button>
                             </div>
                          </div>
                        </div>


                        {{--  --}}

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                $('.otro_caso').hide();
                $("#componentes").prop('required',true);

                $("#motivo_rechazo").removeAttr('required');
                $("#no_efectiva_ausente").removeAttr('required');
                $("#no_efectiva_rechazo").removeAttr('required');;
                $("#no_efectiva_otros").removeAttr('required');;
                $("#submit").html("Guardar y cargar componentes")
                $("#otro_detalle").removeAttr('required')
            }
            else if (t.value == "no")
            {
                $('.no-efectiva').show();
                $('.efectiva').hide();
                $('.otro_caso').hide();

                apagarTodos();

                $("#componentes").removeAttr('required');
                $("#motivo_rechazo").prop('required',true);
                $("$submit").html("Guardar")
                $("#otro_detalle").removeAttr('required')
            }
            else if (t.value == 'otro')
            {
                $('.no-efectiva').hide();
                $('.efectiva').hide();
                $('.otro_caso').show();

                $("#componentes").removeAttr('required');
                $("#motivo_rechazo").removeAttr('required');
                $("#otro_detalle").prop('required',true);

                $("#no_efectiva_ausente").removeAttr('required');
                $("#no_efectiva_rechazo").removeAttr('required');;
                $("#no_efectiva_otros").removeAttr('required');;
                $("$submit").html("Guardar")
            }
            else
            {
                $('.no-efectiva').hide();
                $('.efectiva').hide();
                $('.otro_caso').hide();

                $("#componentes").removeAttr('required');
                $("#motivo_rechazo").removeAttr('required');

                apagarTodos();
                $("#submit").html("Guardar")
                $("#otro_detalle").removeAttr('required');
            }
        }

function apagarTodos()
{
                    $('.no_efectiva_rechazo').hide()
                    $("#no_efectiva_rechazo").removeAttr('required');
                    $('.no_efectiva_otros').hide()
                    $("#no_efectiva_otros").removeAttr('required');
                    $('.no_efectiva_ausente').hide()
                    $("#no_efectiva_ausente").removeAttr('required');;
                    //
                    $('.no_efectiva_construccion').hide()
                    $("#no_efectiva_construccion").removeAttr('required');;
                    $('.no_efectiva_demolida').hide()
                    $("#no_efectiva_demolida").removeAttr('required');;
                    $('.no_efectiva_deshabitada').hide()
                    $("#no_efectiva_deshabitada").removeAttr('required');;
                    $('.no_efectiva_establecimiento').hide()
                    $("#no_efectiva_estableciemiento").removeAttr('required');;
                    $('.no_efectiva_finde').hide()
                    $("#no_efectiva_finde").removeAttr('required');;
                    $('.no_efectiva_listado').hide()
                    $("#no_efectiva_listado").removeAttr('required');;
}

function changeRechazo(t)
        {
            val = (t.value)
            console.log(t.value);
            switch (val) {
                case 'ausente':
                apagarTodos();
                    $('.no_efectiva_ausente').show()
                    $("#no_efectiva_ausente").prop('required',true);
                break;
                case 'rechazo':
                apagarTodos();
                    $('.no_efectiva_rechazo').show()
                    $("#no_efectiva_rechazo").prop('required',true);
                break;
                case 'otros':
                apagarTodos();
                    $('.no_efectiva_otros').show()
                    $("#no_efectiva_otros").prop('required',true);;
                break;
                case "deshabitada":
                    apagarTodos();
                     $('.no_efectiva_deshabitada').show()
                    $("#no_efectiva_deshabitada").prop('required',true);
                break;
                case "demolida":
                    apagarTodos();
                     $('.no_efectiva_demolida').show()
                    $("#no_efectiva_demolida").prop('required',true);
                break;
                case "fin_de_semana":
                    apagarTodos();
                     $('.no_efectiva_finde').show()
                    $("#no_efectiva_finde").prop('required',true);
                break;
                case "construccion":
                    apagarTodos();
                     $('.no_efectiva_construccion').show()
                    $("#no_efectiva_construccion").prop('required',true);
                break;
                case "establecimiento":
                    apagarTodos();
                     $('.no_efectiva_establecimiento').show()
                    $("#no_efectiva_establecimiento").prop('required',true);
                break;
                case "variacion_listado":
                    apagarTodos();
                     $('.no_efectiva_listado').show()
                    $("#no_efectiva_listado").prop('required',true);
                break;
                case "ausente":
                    apagarTodos();
                     $('.no_efectiva_ausente').show()
                    $("#no_efectiva_ausente").prop('required',true);
                break;
                case "rechazo":
                    apagarTodos();
                    $('.no_efectiva_rechazo').show()
                    $("#no_efectiva_rechazo").prop('required',true);
                break;
                                //

            }
        }


$(document).ready(function(){
    console.log("ready");
    $('.no-efectiva').hide();
    $('.efectiva').hide();
    $('.no_efectiva_ausente').hide();
    $('.no_efectiva_rechazo').hide();
    $('.no_efectiva_otros').hide();
    $('.otro_caso').hide();

    // bloque automatico para editar
                    @if($editar)

                    var efectivo = {{$encuesta->efectivo}}
                    $("#comentarios").val('{{$encuesta->comentarios}}')
                    switch (efectivo) {
                            case 0:
                            $("#opciones").val('no');
                            $("#motivo_rechazo").val('{{$encuesta->tipo_no_efectiva}}')
                            $("#no_efectiva_ausente").val('{{$encuesta->detalle_no_efectiva}}')
                            $("#no_efectiva_rechazo").val('{{$encuesta->detalle_no_efectiva}}')
                            $("#no_efectiva_otros").val('{{$encuesta->detalle_no_efectiva}}')
                            $("#motivo_rechazo").trigger('change');


                            break;
                            case 1:

                                    // $("#componentes").val('{{$encuesta->cantidad}}').prop('disabled',true)
                                    $("#opciones").val('efectivo');


                            break;
                            case 2:
                                $("#opciones").val('otro');


                            break;
                    }
                     $("#opciones").trigger('change');
                    @endif


});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Cargar Encuesta para Área {{$area->id }} </br> (Año:{{$area->anio}} Trimestre:{{$area->trimestre}} Semana:{{$area->semana}} Participación:{{$area->visita}})</div>

                <div class="card-body">
                <form class="form" method="POST"
                    @if($editar)
                    action="{{route('saveEditEncuesta')}}"
                    {{-- TODO --}}
                    @else
                    action="{{route('saveEncuesta')}}"
                    @endif
                >
                        @csrf
                        <input type="hidden" name="area_id"
                          @if($editar)
                                value="{{$encuesta->area_id}}"
                          @else
                          value="{{$area->id}}"
                          @endif

                        >

                        @if($editar)
                            <input type="hidden" name="encuesta_id" value="{{$encuesta->id}}">
                        @endif

                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                          <label for="">Listado</label>
                          <input type="number" required
                           @if($editar)
                            value="{{$encuesta->listado}}"
                          @else
                          value=""
                          @endif
                            class="form-control" name="listado"  aria-describedby="helpId" placeholder="" required>
                        </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                          <label for="">Vivienda</label>
                          <input type="number"  required
                          @if($editar)
                            value="{{$encuesta->vivienda}}"
                          @else
                          value="1"
                          @endif
                            class="form-control" name="vivienda"  aria-describedby="helpId" placeholder="">
                             </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                          <label for="">Hogar</label>
                          <input type="number"
                           @if($editar)
                            value="{{$encuesta->hogar}}"
                          @else
                          value="1"
                          @endif

                          required
                            class="form-control" name="hogar"  aria-describedby="helpId" placeholder="">
                             </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                             <label for="">Efectiva?</label>
                            <select name="efectiva"  class="form-control" id="opciones"
                            onchange="changeEfectivo(this)"
                            required>
                                <option value="">-</option>
                                <option value="efectivo">Efectiva</option>
                                <option value="no">No-Efectiva</option>
                                {{-- <option value="otro">Otros</option> --}}
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
                        {{-- row otros casos --}}
                        <div class="row otro_caso">
                            <div class="col-md-4">
                                <div class="form-group otro_caso">
                                  <label for="detalle">Detalle</label>
                                  <select class="form-control" name="otro_detalle" id="otro_detalle">
                                      <option value="">-</option>
                                      <option value="deshabitada">Deshabitada</option>
                                      <option value="variacion en el listado">Variación en el listado</option>
                                      <option value="otro caso">Otro Caso</option>
                                  </select>

                                </div>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="row no-efectiva" >
                          <div class="col-md-4">
                                    <div class="form-group no-efectivo">
                                        <label for="">Motivo</label>
                                        <select class="form-control" name="tipo_no_efectiva" id="motivo_rechazo" onchange="changeRechazo(this)">
                                            <option value="">-</option>
                                            {{-- 28-05 belen --}}
                                            <option value="deshabitada">Deshabitada</option>
                                            <option value="demolida">Demolida</option>
                                            <option value="fin_de_semana">Fin de Semana</option>
                                            <option value="construccion">Construccion</option>
                                            <option value="establecimiento">Vivienda Usada como Establecimiento</option>
                                            <option value="variacion_listado">Variación en el listado</option>
                                            <option value="ausente">Ausencia</option>
                                            <option value="rechazo">Rechazo</option>
                                            <option value="otros">Otros Motivos</option>
                                            {{--  --}}
                                        </select>
                                        </div>
                            </div>
{{-- Por Ausencua --}}
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
{{-- Por Rechazo --}}
                            <div class="form-group no_efectiva_rechazo">
                              <label for="">Rechazo</label>
                              <select class="form-control" name="no_efectiva_rechazo" id="no_efectiva_rechazo" value="-" >
                                  <option value="">-</option>
                                <option value="1">Negativa Rotunda</option>
                                <option value="2">Rechazo por portero electrico</option>
                                <option value="3">Se acordaron entrevistas que no se concretaron</option>
                              </select>
                            </div>
{{-- Otras Causas --}}

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
{{-- Deshabitada --}}

                            <div class="form-group no_efectiva_deshabitada">
                              <label for="">deshabitada</label>
                              <select class="form-control" name="no_efectiva_deshabitada" id="no_efectiva_deshabitada" value="-" >
                                  <option value="">-</option>
                                <option value="1">Venta o Alquiler</option>
                                <option value="2">Sucesión o Remate</option>
                                <option value="3">Deshabitada en la semana de referencia</option>
                                <option value="4">Sin Causa conocida</option>
                              </select>
                            </div>
{{-- Demolida --}}
                          <div class="form-group no_efectiva_demolida">
                              <label for="">demolida</label>
                              <select class="form-control" name="no_efectiva_demolida" id="no_efectiva_demolida" value="-" >
                                  <option value="">-</option>
                                <option value="1">Fue demolida</option>
                                <option value="2">en demolicion</option>
                                <option value="3">levantada</option>
                                <option value="4">trasladada</option>
                              </select>
                            </div>
{{-- Fin de Semana --}}
                            <div class="form-group no_efectiva_finde">
                              <label for="">Fin de Semana</label>
                              <select class="form-control" name="no_efectiva_finde" id="no_efectiva_finde" value="-" >
                                  <option value="">-</option>
                                <option value="1">Viven en otra vivienda la mayor parte de la Semana</option>
                                <option value="2">Viven en otra vivienda la mayor parte del mes</option>
                                <option value="3">Viven en otra vivienda la mayor parte del Año</option>
                                <option value="4">trasladada</option>
                              </select>
                            </div>
{{-- Construccion --}}
                            <div class="form-group no_efectiva_construccion">
                              <label for="">Construccion</label>
                              <select class="form-control" name="no_efectiva_construccion" id="no_efectiva_construccion" value="-" >
                                  <option value="">-</option>
                                <option value="1">Se esta construyendo</option>
                                <option value="2">Contrucción paralizada</option>
                                <option value="3">Refacción</option>
                                <option value="4">otros</option>
                              </select>
                            </div>
{{-- Vivienda Establecimiento --}}
                            <div class="form-group no_efectiva_establecimiento">
                              <label for="">establecimiento</label>
                              <select class="form-control" name="no_efectiva_establecimiento" id="no_efectiva_establecimiento">
                                <option value="1">Conserva Comodidad de vivienda</option>
                              </select>
                            </div>
{{-- Variación en el listado --}}
                            <div class="form-group no_efectiva_listado">
                              <label for="">listado</label>
                              <select class="form-control" name="no_efectiva_listado" id="no_efectiva_listado" value="-" >
                                  <option value="">-</option>
                                <option value="1">No existe lugar fisico</option>
                                <option value="2">No es Vivienda</option>
                                <option value="3">Otras</option>

                              </select>
                            </div>
{{--  --}}
                        </div>
                           {{-- end no-efectiva --}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Comentarios</label>
                                  <input type="text"
                                    class="form-control" name="comentarios" id="comentarios" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                             <div class="form-group ">
                                <button type="submit" id="submit" class="btn btn-primary">
                                    @if($editar)
                                    Guardar Cambios
                                    @else
                                    Guardar
                                    @endif
                                </button>
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

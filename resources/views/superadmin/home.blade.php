@extends('layouts.app')

@section('content')

<script>

$(document).ready(function(){

      $(".table").tablesorter();


      $(".btn-listo").click(function(){

        $id = $(this).data('id');
        console.log($id);

        $.get('{{route("ajaxListo")}}'+"/"+$id,{},function(data){
            $("#encuesta-"+$id).hide("fast");
            console.log("hidden "+"#encuesta-"+$id)
        })

      })




})

function mostrando(t)
{
    window.location = "{{route('homeSuperAdmin')}}"+"/"+t.value;
}
</script>
<div class="container-fluid">


                @if(Auth::user()->role != 3)
                No Autorizado
                @else
                <div class="card text-left">
                    <div class="card-header">
                        <h4 class="card-title">Panel de Administración</h4>

                    </div>

                  <div class="card-body">
                        <h3>Cálculo de estimación de pobreza</h3>
                        <div class="row">
                            <div class="col-md-4">
                                Mostrando
                            </div>
                            <div class="col-md-4">

                        <select name="trimestr" id="mostrando" class="form-control" onchange="mostrando(this)">
                            <option value="1" @if($selected == 1 ) selected @endif>2° Trimestre Año 2019</option>
                            <option value="2" @if($selected == 2 ) selected @endif>1° Trimestre Año 2019</option>
                            <option value="3" @if($selected == 3 ) selected @endif>4° Trimestre Año 2018</option>
                        </select>
                            </div>
                            <div class="col-md-2">
                                <a name="" id="" class="btn btn-primary" href="{{route('indicadores')}}" role="button">Ver Indicadores por Trimestre</a>
                            </div>
                        </div>
                           @include('superadmin.tablaIndicadores',['info'=>$indicadores])
                    <h3>Detalle de Hogares</h3>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="#finalizado" role="tab" aria-controls="home" aria-selected="true">Finalizado</a></li>

                        <li class="nav-item"><a class="nav-link" id="cargando-tab" data-toggle="tab" href="#cargando" role="tab" aria-controls="cargando" aria-selected="false">Cargando</a></li>
                        <li class="nav-item"><a class="nav-link" id="entregado-tab" data-toggle="tab" href="#entregado" role="tab" aria-controls="entregado" aria-selected="false">Entregados</a></li>
                        <li class="nav-item"><a class="nav-link" id="coord-tab" data-toggle="tab" href="#coord" role="tab" aria-controls="coord" aria-selected="false">En Coordinacion</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">En supervisión</a></li>
                        <li class="nav-item"><a class="nav-link" id="listo-tab" data-toggle="tab" href="#listo" role="tab" aria-controls="listo" aria-selected="false">Listo para Carga</a></li>

                        {{-- <li class="nav-item"><a class="nav-link" id="histo-tab" data-toggle="tab" href="#histo" role="tab" aria-controls="histo" aria-selected="false">Cargado en INDEC</a></li> --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="finalizado" role="tabpanel" aria-labelledby="home-tab">
                        @include('superadmin.tablaadmin',['efectivos'=>$efectivos,'flag'=>'finalizado'])
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @include('superadmin.tabla-supervisor',['efectivos'=>$efectivos,'flag'=>'en supervision'])
                    </div>
                    <div class="tab-pane fade" id="cargando" role="tabpanel" aria-labelledby="cargando-tab">
                        @include('superadmin.tablaadmin',['efectivos'=>$efectivos,'flag'=>'cargando'])
                    </div>
                    <div class="tab-pane fade" id="listo" role="tabpanel" aria-labelledby="listo-tab">

                          @include('superadmin.tabla-listos',['efectivos'=>$efectivos])
                    </div>

                    {{-- <div class="tab-pane fade" id="histo" role="tabpanel" aria-labelledby="profile-tab">

                        @include('superadmin.tabla-historico',['efectivos'=>$efectivos])
                    </div> --}}
                    <div class="tab-pane fade" id="entregado" role="tabpanel" aria-labelledby="profile-tab">
                        {{-- Entregado --}}
                         @include('superadmin.tablaadmin',['efectivos'=>$efectivos,'flag'=>'entregado'])
                    </div>
                    <div class="tab-pane fade" id="coord" role="tabpanel" aria-labelledby="profile-tab">
                        {{-- En Coordinación --}}
                        @include('superadmin.tablaadmin',['efectivos'=>$efectivos,'flag'=>'recibido'])
                    </div>
                    </div>



                    </div>
                    {{-- eend body --}}
                </div>

                @endif

</div>
@endsection

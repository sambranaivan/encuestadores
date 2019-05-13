@extends('layouts.app')

@section('content')

<script>

$(document).ready(function(){

      $("#table").tablesorter();
})
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
                   <h3>Resumen de Carga</h3>
                   <table class="table table-sm table-stripped table-dark">
                       <thead>
                           <tr>
                               <th>Areas en Carga</th>
                               <th>Areas en Coordinación</th>
                               <th>Areas en Supervición</th>
                               <th>Areas en Dirección</th>
                               <th>Areas Autorizadas</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td scope="row">{{$counts['cargando']}}</td>
                               <td scope="row">{{$counts['recibido'] + $counts['entregado']}}</td>
                               <td scope="row">{{$counts['en supervision']}}</td>
                               <td scope="row">{{$counts['en direccion']}}</td>
                               <td scope="row">{{$counts['con autorizacion']}}</td>
                           </tr>
                       </tbody>
                   </table>
                  </div>
                  <div class="card-body">
                        <h3>Cálculo de estimación de pobreza</h3>
                        <table class="table table-sm table-stripped table-dark">
                            <thead>
                                <tr>
                                    <th>Total de Hogares</th>
                                    <th>Pobres</th>
                                    <th>No Pobres</th>
                                    <th>Incompletos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$detalles['totales']}}</td>
                                    <td>{{$detalles['pobres']}}</td>
                                    <td>{{$detalles['no-pobres']}}</td>
                                    <td>{{$detalles['incompletos']}}</td>
                                </tr>
                               <tr>
                                    <th>Porcentajes</th>
                                    <td>{{ceil($detalles['pobres']/$detalles['completos']*100)}}%</td>
                                    <td>{{ceil($detalles['no-pobres']/$detalles['completos']*100)}}%</td>
                                    <td>{{ceil($detalles['incompletos']/$detalles['totales']*100)}}%</td>
                                </tr>
                            </tbody>
                        </table>
                    <h3>Detalle de Hogares</h3>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#finalizado" role="tab" aria-controls="home" aria-selected="true">Finalizado</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="listo-tab" data-toggle="tab" href="#listo" role="tab" aria-controls="listo" aria-selected="false">Listo para Carga</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">En supervisión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cargando-tab" data-toggle="tab" href="#cargando" role="tab" aria-controls="cargando" aria-selected="false">Cargando</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="histo-tab" data-toggle="tab" href="#histo" role="tab" aria-controls="histo" aria-selected="false">Historico</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="finalizado" role="tabpanel" aria-labelledby="home-tab">
                        @include('superadmin.tablaadmin',['efectivos'=>$efectivos,'flag'=>'finalizado'])
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @include('superadmin.tablaadmin',['efectivos'=>$efectivos,'flag'=>'en supervision'])
                    </div>
                    <div class="tab-pane fade" id="cargando" role="tabpanel" aria-labelledby="cargando-tab">
                        @include('superadmin.tablaadmin',['efectivos'=>$efectivos,'flag'=>'cargando'])
                    </div>
                    <div class="tab-pane fade" id="listo" role="tabpanel" aria-labelledby="listo-tab">

                          @include('superadmin.tabla-listos',['efectivos'=>$efectivos])
                    </div>

                    <div class="tab-pane fade" id="histo" role="tabpanel" aria-labelledby="profile-tab">
                        Historicos
                        {{-- @include('superadmin.tablaadmin',['efectivos'=>$efectivos,'flag'=>'en supervision']) --}}
                    </div>
                    </div>



                    </div>
                    {{-- eend body --}}
                </div>

                @endif

</div>
@endsection

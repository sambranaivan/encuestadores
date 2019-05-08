@extends('layouts.app')

@section('content')


<div class="container">


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
                        <table class="table table-sm table-tripped text-center" id="table">
                            <thead>
                                <tr  class="bg-dark text-light">
                                    <th>AREA</th>
                                    {{-- <th>estado</th> --}}
                                     <th>listado</th>
                                      <th>hogar</th>
                                    <th>Situacion</th>
                                    <th>Ingreso Total</th>
                                    <th>Componentes</th>
                                    <th>Ponderador</th>
                                    <th>Ingreso Necesario </br> $7723 CBT NEA</th>
                                    <th>Estimación</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($efectivos as $item)
                                <tr

                                @if($item->estado())
                                            @if($item->esPobre())
                                            class="table-success"
                                            @else
                                            class="table-danger"
                                         @endif
                                         @else
                                          class="table-warning"
                                        
                                         @endif

                                >
                                    <td>
                                        {{$item->area->area}}
                                    </td>
                                    <td>
                                        {{$item->listado}}
                                    </td>
                                    <td>
                                        {{$item->hogar}}
                                    </td>
                                <td>{{$item->status()}}</td>
                                <td>{{$item->getMonts()}}</td>
                                <td>
                                    {{$item->componentes->count()}}
                                </td>
                                    <td>
                                       {{$item->getPonds()}}
                                    </td>
                                     <td>
                                       $ {{$item->getMinimo()}}
                                    </td>

                                    <td>
                                         @if($item->estado())
                                           {{$item->diff()}}
                                           @else
                                           No declaro montos
                                         @endif
                                    </td>
                                <td>
                                <a name="" id="" class="btn btn-primary btn-sm" href="{{route('superVerEncuesta',['id'=>$item->id])}}" role="button">Ver detalle</a>
                                </td>




                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{-- eend body --}}
                </div>

                @endif

</div>
@endsection

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
                                    <td>{{$detalles['pobres']/$detalles['totales']*100}}%</td>
                                    <td>{{$detalles['no-pobres']/$detalles['totales']*100}}%</td>
                                    <td>{{$detalles['incompletos']/$detalles['totales']*100}}%</td>
                                </tr>
                            </tbody>
                        </table>
                    <h3>Detalle de Hogares</h3>
                        <table class="table table-sm table-tripped text-center">
                            <thead>
                                <tr  class="bg-dark text-light">
                                    <th>#</th>
                                    <th>Ingreso Total</th>
                                    <th>Componentes</th>
                                    <th>Ponderador</th>
                                    <th>Ingreso Necesario </br> $7405 CBT NEA</th>
                                    <th>Estimación</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($efectivos as $item)
                                <tr
                                @if($item->getMonts() == -9)
                                class="table-warning"
                                @endif
                                    @if($item->esPobre())
                                    class="table-danger"
                                    @else
                                    class="table-success"
                                    @endif
                                >
                                    <td>
                                        {{$item->id}}
                                    </td>
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
                                        @if($item->getMonts() == -9)

                                            Falta Levantar montos
                                        @else
                                        @if($item->esPobre())
                                    {{-- <td class="text-danger "> --}}

                                        Es Pobre ($
                                            {{$item->getMonts() - $item->getMinimo()}})
                                    {{-- </td> --}}
                                        @else
                                    {{-- <td class="text-success"> --}}
                                        No es Pobre
                                        ($ +{{$item->getMonts() - $item->getMinimo()}})
                                        @endif
                                    {{-- </td> --}}
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

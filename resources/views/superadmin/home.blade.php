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
                   <h3>Resumen</h3>
                   <table class="table">
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
                </div>

                @endif

</div>
@endsection

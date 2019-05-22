@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header  bg-dark text-light">
                    <div class="card-title">
                        <h4>Detalle Encuesta<h4>
                    </div>
                </div>

                <div class="card-body">

                    <h4>Detalle Hogar</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                              <strong>Area:</strong>{{$encuesta->area->area}}
                                <strong>Año:</strong>{{$encuesta->area->anio}}
                                  <strong>Trimestre:</strong>{{$encuesta->area->trimestre}}
                                    <strong>Semana:</strong>{{$encuesta->area->semana}}
                                      <strong>Encuestador:</strong>{{$encuesta->area->encuestador->name}}
                            </li>
                        <li class="list-group-item"><strong>Listado: </strong>{{$encuesta->listado}}</li>
                        <li class="list-group-item"><strong>Vivienda/Hogar:</strong> {{$encuesta->vivienda}}/{{$encuesta->hogar}}</li>
                            <li class="list-group-item"><strong>Participación: </strong>{{$encuesta->area->visita}}</li>
                        @if($encuesta->efectivo == 0)
                        <li class="list-group-item"><strong>Condición: </strong>{{$encuesta->condicion()}}/ {{$encuesta->tipo_no_efectiva}}/{{$encuesta->detalle_no_efectiva}}</li>
                        @endif
                         @if($encuesta->efectivo == 1)
                         <li class="list-group-item"><strong>Condición: </strong>{{$encuesta->condicion()}}</li>
                        @endif
                         @if($encuesta->efectivo == 2)
                         <li class="list-group-item"><strong>Condición: </strong>{{$encuesta->condicion()}}/ {{$encuesta->otros_motivos}}</li>

                        @endif

                        <li class="list-group-item"><strong>Estado: </strong>{{$encuesta->area->status}}</li>
                        <li class="list-group-item"><strong>Comentarios Encuestador: </strong>{{$encuesta->comentarios}}</li>
                        <li class="list-group-item"><strong>Comentarios Supervisor: </strong>{{$encuesta->comentario_supervisor}}</li>
                        <li class="list-group-item"><strong>Comentarios Dirección: </strong>{{$encuesta->comentario_admin}}</li>
                    </ul>
                    {{-- detalle componentes --}}
                     @if($encuesta->componentes->count() != $encuesta->cantidad)
                        <a name="" id="" class="btn btn-warning" href="/supervisor/individual/{{$encuesta->id}}" role="button">Cargar Componentes</a>
                    @endif
                    @if($encuesta->componentes->count())
                    <h4>Componentes del Hogar</h4>
                    <table class="table table-sm table-striped">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Condición Laboral</th>
                                <th>Ingreso no Laboral</th>
                                <th>Ingreso Laboral</th>
                                <th>Pobreza Individual</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($encuesta->componentes as $item)
                               <tr>
                                    <td>{{$item->edad}}</td>
                                    <td>{{$item->sexo}}</td>
                                    <td>{{$item->laboral}} </td>
                                    <td>{{$item->ingreso_no_laboral}}</td>
                                    <td>{{$item->ingreso_laboral}}</td>
                                    <td>
                                        @if($item->esPobre())
                                            Es Pobre
                                        @endif
                                    </td>
                                     <td>
                                <a class="btn btn-primary btn-sm" href="{{route('AdminEditarIndividual',['id'=>$item->id])}}" role="button">Editar</a>
                                <a class="btn btn-danger btn-sm" href="{{route('AdminBorrarIndividual',['id'=>$item->id])}}" role="button">Borrar</a>
                                </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                    @else
                    @endif
                </div>
                <div class="card-body">
                  <div class="row">
                        <div class="col-md-2">
                            <a name="" id="" class="btn btn-primary btn-sm" href="{{route('homeSuperAdmin')}}" role="button">Volver</a>
                        </div>
                        @if($encuesta->area->status == 'finalizado')
                        <div class="col-md-2 offset-md-3">

                            <a name="" id="" class="btn btn-primary btn-sm" href="{{route('AdminEditEncuesta',['id'=>$encuesta->id])}}" role="button">Modificar</a>
                        </div>
                        <div class="col-md-2 offset-md-2">

                            @if($encuesta->listo)
                            <a href="#" class="btn btn-sm  btn-primary active" role="button">Marcado como listo</a>
                            @else
                            <a name="" id="" class="btn btn-success btn-sm" href="{{route('listo',['id'=>$encuesta->id])}}" role="button">Listo para Cargar</a>
                            @endif
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

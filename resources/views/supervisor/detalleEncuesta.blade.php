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

                        @if($encuesta->efectivo == 0)
                        <li class="list-group-item"><strong>Condición: </strong>{{$encuesta->condicion()}}/ {{$encuesta->tipo_no_efectiva}}/{{$encuesta->detalle_no_efectiva}}</li>
                        @endif
                         @if($encuesta->efectivo == 1)
                         <li class="list-group-item"><strong>Condición: </strong>{{$encuesta->condicion()}}</li>
                        @endif
                         @if($encuesta->efectivo == 2)
                         <li class="list-group-item"><strong>Condición: </strong>{{$encuesta->condicion()}}/ {{$encuesta->otros_motivos}}</li>

                        @endif
                        <li class="list-group-item"><strong>Comentarios: </strong>{{$encuesta->comentarios}}</li>
                    </ul>
                    {{-- detalle componentes --}}
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
                                <a class="btn btn-primary btn-sm" href="{{route('editarIndividual',['id'=>$item->id])}}" role="button">Editar</a>
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
                        <a name="" id="" class="btn btn-primary btn-sm" href="javascript:history.back(1)" role="button">Volver</a>
                    </div>
                    <div class="col-md-2 offset-md-3">
                    <form method="POST" action="{{route('modificarEncuesta')}}">
                            @csrf
                        <input type="hidden" value="{{$encuesta->id}}" name="encuesta_id">
                        <button type="submit" class="btn btn-sm btn-primary btn-warning text-dark">Modificar</button>
                        </form>
                    </div>

                    <div class="col-md-2 offset-md-3">
                    <form method="POST" action="{{route('eliminarEncuesta')}}">
                            @csrf
                        <input type="hidden" value="{{$encuesta->id}}" name="encuesta_id">
                        <button type="submit" class="btn btn-sm btn-primary btn-danger">Eliminar</button>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

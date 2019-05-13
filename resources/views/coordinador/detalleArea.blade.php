@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-10">
                                <h4>Detalle Área</h4>
                            </div>
                            <div class="col-md-2">
                                <a name="" id="" class="btn btn-primary" href="{{route('homeCoordinador')}}" role="button">Volver</a>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="card-body">
                    <table class="table table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>Área</th>
                                <th>Año</th>
                                <th>Trimestre</th>
                                <th>Semana</th>
                                <th>Participación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{$area->area}}</th>
                                <th>{{$area->anio}}</th>
                                <th>{{$area->trimestre}}</th>
                                <th>{{$area->semana}}</th>
                                <th>{{$area->visita}}</th>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table">
                         <thead class="bg-dark text-light">
                            <tr>
                                <th>Listado</th>
                                <th>Vivienda/Hogar</th>

                                <th>Condición</th>
                                <th>Componentes</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($area->encuestas as $item)
                                <tr>
                                    <td>{{$item->listado}}</td>
                                    <td>{{$item->vivienda}}/{{$item->hogar}}</td>
                                    <td>{{$item->condicion()}}</td>
                                    <td>{{$item->componentes->count()}}</td>
                                    <td>
                                        <div class="btn-group">

                                            {{-- Ver Detalle --}}
                                                <a name="" id="" class="btn btn-primary btn-sm" href="{{route('coordinadorDetalleEncuesta',['id'=>$item->id])}}" role="button">Ver Detalle</a>
                                                {{--  --}}


                                                {{-- <form method="POST" action="{{route('modificarEncuesta')}}">
                            @csrf
                        <input type="hidden" value="{{$item->id}}" name="encuesta_id">
                        <button type="submit" class="btn btn-sm btn-primary btn-warning text-dark">Modificar</button>
                        </form>
                                                <form method="POST" action="{{route('eliminarEncuesta')}}">
                            @csrf
                        <input type="hidden" value="{{$item->id}}" name="encuesta_id">
                        <button type="submit" class="btn btn-sm btn-primary btn-danger">Eliminar</button>
                        </form> --}}
                                            </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="card-body text-center">
                  <form method="POST" action="{{route('confirmarArea')}}">
                                                @csrf
                                            <input type="hidden" name="area_id" value="{{$area->id}}">
                                            <button type="submit" class="btn btn-success btn-lg">Confirmar Entrega</button>
                                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

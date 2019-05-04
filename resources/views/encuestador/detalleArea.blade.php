@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><h4>Detalle Área</h4></div>
                </div>


                <div class="card-body">
                    <table class="table table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>Área</th>
                                <th>Año</th>
                                <th>Trimestre</th>
                                <th>Semana</th>
                                <th>Visita</th>
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
                                    <td>{{$item->cantidad.'/'.$item->componentes->count()}}</td>
                                    <td>
                                        <div class="btn-group">

                                            {{-- Ver Detalle --}}
                                            <form method="POST" action="{{route('detalleEncuesta')}}">
                                                    @csrf
                                                    <input type="hidden" name="encuesta_id" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-primary btn-sm">Ver  Detalle</button>
                                                </form>
                                                {{--  --}}


                                                <a name="" id="" class="btn btn-primary btn-sm" href="#" role="button">Modificar</a>
                                                <a name="" id="" class="btn btn-sm btn-danger" href="#" role="button">Borrar</a>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

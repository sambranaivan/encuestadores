@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">  <div class="card-title"><h4>Cargar Áreas</h4></div></div>
                        <div class="col-md-2">
                        <a name="" id="" class="btn btn-success" href="{{route('nuevaArea')}}" role="button">Nueva Area</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($areas->count())
                    <table class="table table-striped table-sm text-center" >
                                <tr class="bg-dark text-white">
                                    {{-- <th>°</th> --}}
                                    <th>Area</th>
                                    <th>Año</th>
                                    <th>Trimestre</th>
                                    <th>Semana</th>
                                    <th>Visita n°</th>
                                    <th>Estado</th>
                                    <th>Encuestas Cargadas </br>(Efectivas/No Efectivas)</th>
                                    <th>Acciones</th>

                                </tr>
                        @foreach ($areas as $item)
                                @if($item->status == 'cargando' || $item->status == 'rechazado')
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->area}}</td>
                                    <td>{{$item->anio}}</td>
                                    <td>{{$item->trimestre}}</td>
                                    <td>{{$item->semana}}</td>
                                    <td>{{$item->visita}}</td>
                                    <td>{{$item->status}}</td>
                                    <th>{{$item->encuestas->count()}}
                                    ({{$item->getEfectiva()}}/{{$item->getNoEfectiva()}})</th>

                                            <td>
                                                <div class="btn-group">

                                                    <form method="POST" action="{{route('nuevaEncuesta')}}">
                                                            @csrf
                                                            <input type="hidden" name="area_id" value="{{$item->id}}">
                                                        <button type="submit" class="btn btn-primary btn-sm">Cargar</br> Encuesta</button>
                                                    </form>
                                                    <form method="POST" action="{{route('detalleArea')}}">
                                                            @csrf
                                                            <input type="hidden" name="area_id" value="{{$item->id}}">
                                                            <button type="submit" class="btn btn-info text-white btn-sm">Ver/Editar </br>encuestas</button>
                                                        </form>

                                                <form method="POST" action="{{route('entregarArea')}}">
                                                        @csrf
                                                        <input type="hidden" name="area_id" value="{{$item->id}}">
                                                        <button type="submit" class="btn btn-success btn-sm">Entregar</br> Área</button>
                                                    </form>
                                                </div>
                                            </td>
                                </tr>
                                @endif
                        @endforeach
                    </table>
                    @else
                         No Hay Areas Cargadas
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

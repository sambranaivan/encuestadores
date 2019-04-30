@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    .<div class="row">
                        <div class="col-md-10">Listado de Areas</div>
                        <div class="col-md-2">
                        <a name="" id="" class="btn btn-success" href="{{route('nuevaArea')}}" role="button">Nueva Area</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($areas->count())
                    <table class="table">
                                <tr>
                                    {{-- <th>°</th> --}}
                                    <th>Area</th>
                                    <th>Año</th>
                                    <th>Trimestre</th>
                                    <th>Semana</th>
                                    <th>Visita n°</th>
                                    <th>Estado</th>
                                    <th>Encuestas Cargadas </br>(Efectivas/No Efectivas)</th>
                                    <th></th>
                                    {{-- <th></th> --}}
                                    <th></th>
                                </tr>
                        @foreach ($areas as $item)
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->area}}</td>
                                    <td>{{$item->anio}}</td>
                                    <td>{{$item->trimestre}}</td>
                                    <td>{{$item->semana}}</td>
                                    <td>{{$item->visita}}</td>
                                    <td>{{$item->status}}</td>
                                    {{-- <th>{{$item->encuestas->count()}}
                                    ({{$item->getEfectiva()}}/{{$item->getNoEfectiva()}})</th> --}}

                                        @if($item->status == 'cargando' || $item->status == "rechazado")
                                            <td>
                                                <form method="POST" action="{{route('nuevaEncuesta')}}">
                                                @csrf
                                            <input type="hidden" name="area_id" value="{{$item->id}}">
                                            <button type="submit" class="btn btn-primary btn-sm">Cargar Encuesta</button>
                                            </form>
                                            </td>
                                            {{-- <td>
                                            <a name="" id="" class="btn btn-primary btn-sm btn-block" href="#" role="button">Editar Area</a>
                                            </td> --}}
                                            <td>
                                            <form method="POST" action="{{route('entregarArea')}}">
                                                @csrf
                                            <input type="hidden" name="area_id" value="{{$item->id}}">
                                            <button type="submit" class="btn btn-success btn-sm">Entregar Área</button>
                                            </form>
                                            </td>
                                            @else
                                            <td></td>
                                            <td></td>

                                        @endif

                                </tr>
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

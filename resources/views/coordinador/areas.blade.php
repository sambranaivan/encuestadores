@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    .<div class="row">
                        <div class="col-md-10">Listado de Areas</div>
                        <div class="col-md-2">
                        {{-- <a name="" id="" class="btn btn-success" href="{{route('nuevaArea')}}" role="button">Nueva Area</a> --}}
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
                                    <th>Encuestas Cargadas</th>
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
                                    <th>{{$item->encuestas->count()}}</th>



                                           @if($item->status !== 'recibido')
                                             <td>
                                                <form method="POST" action="{{route('confirmarArea')}}">
                                                @csrf
                                            <input type="hidden" name="area_id" value="{{$item->id}}">
                                            <button type="submit" class="btn btn-success btn-sm">Confirmar Recepción</button>
                                            </form>
                                            </td>

                                             <td>
                                                <form method="POST" action="{{route('rechazarArea')}}">
                                                @csrf
                                            <input type="hidden" name="area_id" value="{{$item->id}}">
                                            <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                                            </form>
                                            </td>
                                            @else
                                             <td>
                                                    <form method="POST" action="{{route('asignarSupervisor')}}">
                                                        @csrf
                                                    <input type="hidden" name="area_id" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-success btn-sm">Asignar Supervisor</button>
                                                    </form>
                                            </td>
                                            @endif





                                </tr>
                        @endforeach
                    </table>
                    @else
                         No hay áreas en espera.
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

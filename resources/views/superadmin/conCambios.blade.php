@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th><th>
                    <th>Trimestre/Año</th>
                    <th>Listado</th>
                    <th>Vivienda/Hogar</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- {!$i = 0} --}}
                @foreach ($individuales as $index=>$item)
                {{-- {!$i+1} --}}

                <tr>
                <td>{{$index+1}}<td>
                <td scope="row">{{$item->encuesta->area->trimestre}}/{{$item->encuesta->area->anio}}</td>
                <td>{{$item->encuesta->listado}}</td>
                <td>{{$item->encuesta->vivienda}}/{{$item->encuesta->hogar}}</td>
                <td>
                    <a class="btn btn-primary"  href="{{route('historicoIndividual',['id'=>$item->id])}}">
                            Ver Correcciones <span class="badge badge-dark">{{sizeof($item->cambiosNoSuper())}}</span>
                    </a>
                </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
@endsection

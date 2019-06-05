@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <table class="table">
            <thead>
                <tr>
                    <th>Encuesta_Id</th>
                    <th>Area</th>
                    <th>Listado</th>
                    <th>hogar</th>
                    <th>Individuos</th>
                    <th>Adulto Equivalente</th>
                    <th>Ingreso Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completos as $item)
                <tr>
                    <td scope="row">{{$item->id}}</td>
                    <td scope="row">{{$item->area->area}}</td>
                    <td scope="row">{{$item->listado}}</td>
                    <td scope="row">{{$item->vivienda}}</td>
                    <td scope="row">{{$item->componentes->count()}}</td>
                    <td>{{$item->getPonds()}}</td>
                    <td>{{$item->getMonts()}}</td>
                    <td></td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>
@endsection

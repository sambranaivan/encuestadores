@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Historico de Cambios - Individual</div>

                <div class="card-body">

                    <table class="table table-sm">

                        <thead>
                            <tr><th>#</th>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Laboral</th>
                                <th>No Laboral</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                <tr>
                                    <td>Actual</td>
                                    <td>
                                        {{$individual->edad}}
                                    </td>
                                    <td>
                                        {{$individual->sexo}}
                                    </td>
                                    <td>
                                        {{$individual->ingreso_laboral}}
                                    </td>
                                    <td>
                                        {{$individual->ingreso_no_laboral}}
                                    </td>
                                </tr>
                                @foreach ($individual->historico as $item)
                                <tr>
                                    <td>Anterior</td>
                                    <td>
                                        {{$item->edad}}
                                    </td>
                                    <td>
                                        {{$item->sexo}}
                                    </td>
                                    <td>
                                        {{$item->ingreso_laboral}}
                                    </td>
                                    <td>
                                        {{$item->ingreso_no_laboral}}
                                    </td>
                                    <td>
                                        @if($item->esSuper())
                                            Super Super

                                        @else

                                            Corregido por</br>
                                            <strong>{{$item->who->name}}</strong>
                                    </br>
                                    @if(Auth::user()->name == "ivan")
                                                <a name="" id="" class="btn btn-primary" href="{{route('hyper',['historico_id'=>$item->id])}}" role="button">Marcar como Super</a>
                                            @endif
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                        </tbody>
                        </tbody>
                    </table>


                    Actual
                        {{$individual->id}}
                    Modificaciones
                    @foreach ($individual->historico as $modificacion)
                        {{$modificacion->id}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

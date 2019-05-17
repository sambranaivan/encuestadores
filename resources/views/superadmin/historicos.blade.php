@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Historico de Cambios</div>

                <div class="card-body">
                    <table class="table table-sm table-stripped">

                        <thead>
                            <tr>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Laboral</th>
                                <th>No Laboral</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($encuesta->componentes as $item)
                            <tr>
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
                                    @if($item->fueSuper())
                                <a name="" id="" class="btn btn-primary" href="{{route('historicoIndividual',['id'=>$item->id])}}" role="button">
                                            Ver Modificaciones
                                        </a>
                                    @endif
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

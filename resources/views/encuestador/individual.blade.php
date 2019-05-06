@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Carga de Individuales</div>

                <div class="card-body">

                <form class="form" method="POST" action="{{route('saveIndividuals')}}">
                        @csrf
                        <input type="hidden" name="encuesta_id" value={{$encuesta->id}}>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>°</th>
                                    <th>Edad</th>
                                    <th>Sexo</th>
                                    <th>Situación Laboral</th>
                                    <th>Ingreso no laboral</th>
                                    <th>Ingreso Laboral</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= $encuesta->cantidad; $i++)
                                    <tr>
                                    <td scope="row">{{$i}}</td>
                                    <td>
                                        <input type="number" name="edad_{{$i}}" min=0 step=1 max=99 class="form-control" required>
                                    </td>
                                    <td>
                                    <select name="sexo_{{$i}}" class="form-control" required>
                                        <option value="">-</option>
                                        <option value="Hombre">H</option>
                                        <option value="Mujer">M</option>
                                    </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="laboral_{{$i}}" required>
                                            <option value="">-</option>
                                            <option value="Trabaja">Trabaja</option>
                                            <option value="No Trabaja">No Trabaja</option>
                                            {{-- <option value="No Trabaja y Busca">No Trabaja y Busca</option>
                                            <option value="No Trabaja y No Busca">No Trabaja y No Busca</option> --}}
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ingreso_laboral_{{$i}}" step="1" >
                                        <small class="text-muted">sin punto de mil</small>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ingreso_no_laboral_{{$i}}"  step="1">
                                        <small class="text-muted">sin punto de mil</small>
                                    </td>

                                </tr>
                                @endfor
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary text">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

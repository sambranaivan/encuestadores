@extends('layouts.app')

@section('content')

<script>
$(document).ready(function(){


    $("#sexo").val('{{$individual->sexo}}')
    $("#trabaja").val('{{$individual->laboral}}')

})
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Individual</div>

                <div class="card-body">
                    <form method="POST" action="{{route('AdminupdateIndividual')}}" class="form">
                        @csrf
                    <input type="hidden" value="{{$individual->id}}" name="id">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Edad</th>
                                    <th>Sexo</th>
                                    <th>Situación Laboral</th>
                                    <th>Ingreso Laboral</th>
                                    <th>Ingreso no laboral</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>
                                        <input type="number" name="edad" value="{{$individual->edad}}" min=0 step=1 max=99 class="form-control" required>
                                    </td>
                                    <td>
                                    <select name="sexo" id="sexo" value="{{$individual->sexo}}" class="form-control" required>
                                        <option value="">-</option>
                                        <option value="Hombre">H</option>
                                        <option value="Mujer">M</option>
                                    </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="laboral" id="trabaja" value="{{$individual->laboral}}" required>
                                            <option value="">-</option>
                                            <option value="Trabaja">Trabaja</option>
                                            <option value="No Trabaja">No Trabaja</option>
                                            <option value="No Responde">No Responde</option>
                                            {{-- <option value="No Trabaja y Busca">No Trabaja y Busca</option>
                                            <option value="No Trabaja y No Busca">No Trabaja y No Busca</option> --}}
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ingreso_laboral" value="{{$individual->ingreso_laboral}}" step="1" >
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ingreso_no_laboral" value="{{$individual->ingreso_no_laboral}}"  step="1">
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="super" >
                                            <label class="form-check-label" for="exampleCheck1">Super Super</label>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                          <label for="">Comentarios Super Admin</label>
                          <input type="text" name="cometarios" id="" class="form-control" placeholder="" aria-describedby="helpId">

                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

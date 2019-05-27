@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cargar nueva Area</div>

                <div class="card-body">
                <form class="form" method="POST" action="{{route('saveArea')}}">
                       @csrf
                       <div class="row">
                           <div class="col-md-6">


                           <div class="form-group">
                               <label for="">Encuestador que realizo la encuesta</label>
                        <select name="encuestador_id" id="" class="form-control" required>
                            <option value="">-</option>
                            @foreach ($encuestadores as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                           </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-4">

                               <div class="form-group">
                                 <label for="">Area</label>
                                 <input type="number" name="area"
                                   class="form-control" min="0" step=1 max=9999 id="" value="" aria-describedby="helpId" placeholder="" required>

                               </div>
                           </div>
                           <div class="col-md-4"><div class="form-group">
                         <label for="">Año</label>
                         <input type="number" name="anio"
                           class="form-control" min="0" step=1 max=2019 value="" id="" aria-describedby="helpId" placeholder="" required>

                       </div></div>
                       <div class="col-md-4">

                                <div class="form-group">
                                    <label for="">Trimestre</label>
                                    <input type="number" name="trimestre"
                                    class="form-control" min="0" step=1 max=4 id="" aria-describedby="helpId" placeholder="" required>
                                </div>
                            </div>


                        </div>
                        {{-- end row --}}
                       <div class="row">
                       <div class="col-md-4">

                               <div class="form-group">
                                   <label for="">Semana</label>
                                   <input type="number" name="semana"
                                   class="form-control" min="0" step=1 max=99 id="" aria-describedby="helpId" placeholder="" required>

                                </div>
                            </div>
                       <div class="col-md-4"><div class="form-group">
                         <label for="">Participación</label>
                         <input type="number" name="visita"
                           class="form-control" min="0" step=1 max=9 id="" aria-describedby="helpId" placeholder="" required>

                       </div></div></div>
                       <div class="row">
                       <div class="col-md-4 offset-md-8"><button type="submit" class="btn btn-primary form-control my-1">Guardar</button></div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

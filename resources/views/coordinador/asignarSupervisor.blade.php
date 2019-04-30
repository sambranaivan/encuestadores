@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Asignar Supervisor para el Area {{$area->id}}</div>

                <div class="card-body">
                <form method="POST" action="{{route('saveAsignacion')}}" class="form">
                    @csrf
                    <input type="hidden" name="area_id" value={{$area->id}}>
                    <div class="form-group">
                      <label for="supervisor_id">Supervisor</label>
                      <select name="supervisor_id" class="form-control" required>
                        <option value="">-</option>
                        @foreach ($supervisores as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary form-control">Asignar Supervisor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

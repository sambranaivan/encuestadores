@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">  <div class="card-title"><h4>Áreas Asignadas</h4></div></div>
                        <div class="col-md-2">
                        {{-- <a name="" id="" class="btn btn-success" href="{{route('nuevaArea')}}" role="button">Nueva Area</a> --}}
                        </div>
                    </div>
                </div>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Supervisar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Finalizadas</a>
                                </li>

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        @include('supervisor.areas',['areas'=>$areas])
                                    </div>

                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        @include('supervisor.areas',['areas'=>$finalizados])
                                    </div>
                                </div>


            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">Listado de Areas</div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">


                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="t2_2019-tab" data-toggle="tab" href="#t2_2019" role="tab" aria-controls="t2_2019" aria-selected="true">2° Trimestre 2019</a></li>
                        <li class="nav-item"><a class="nav-link" id="t1_2019-tab" data-toggle="tab" href="#t1_2019" role="tab" aria-controls="t1_2019" aria-selected="false">1° Trimestre 2019</a></li>
                        <li class="nav-item"><a class="nav-link" id="t4_2018-tab" data-toggle="tab" href="#t4_2018" role="tab" aria-controls="t4_2018" aria-selected="false">4° Trimestre 2018</a></li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="t2_2019" role="tabpanel" aria-labelledby="dos-tab">
                                @include('coordinador.areas',['areas'=>$areas,'anio'=>2019,'trimestre'=>2])
                            </div>
                            <div class="tab-pane fade show " id="t1_2019" role="tabpanel" aria-labelledby="uno-tab">
                                @include('coordinador.areas',['areas'=>$areas,'anio'=>2019,'trimestre'=>1])
                            </div>
                            <div class="tab-pane fade show " id="t4_2018" role="tabpanel" aria-labelledby="cuatro-tab">
                                @include('coordinador.areas',['areas'=>$areas,'anio'=>2018,'trimestre'=>4])
                            </div>
                    </div>
            </div>

    </div>
</div>
@endsection

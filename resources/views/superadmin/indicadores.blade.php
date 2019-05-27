@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('superadmin.tablaIndicadores',['info'=>$a2018t4])
            @include('superadmin.tablaIndicadores',['info'=>$a2019t1])
            @include('superadmin.tablaIndicadores',['info'=>$a2019t2])
        </div>
    </div>
</div>
@endsection

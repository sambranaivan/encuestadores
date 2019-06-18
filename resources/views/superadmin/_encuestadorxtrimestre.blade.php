<table class="table" id="indextable">
        <thead>
            <tr>
                <th><a href="javascript:SortTable(0,'T');">Encuestador</a></th>
                {{-- <th><a href="javascript:SortTable(0,'T');">Encuestador</a></th> --}}
                <th><a href="javascript:SortTable(1,'N');">Correcciones</a></th>
                <th>Totales (Individuales)<th>
                <th>%<th>
                    <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($encuestadores as $e)
               <tr>
               <td>{{$e->name}}</td>
               <td>{{$e->getCorreccionesT($a,$t)}}</td>
               <td>{{$e->getIndividualesT($a,$t)}}</td>
               <td>{{round($e->getCorreccionesT($a,$t)/$e->getIndividualesT($a,$t) * 100 ,2)}}%</td>
               <td><a name="" id="" class="btn btn-primary btn-disabled" href="{{route('correccionesEncuestador',['encuestador_id'=>$e->id])}}" role="button">Ver</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

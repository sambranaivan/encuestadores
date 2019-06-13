            @if ($areas->count())
                    <table class="table table-striped table-sm text-center" >
                                <tr class="bg-dark text-white">
                                    {{-- <th>°</th> --}}
                                    <th>Area</th>
                                    <th>Año</th>
                                    <th>Trimestre</th>
                                    <th>Semana</th>
                                    <th>Participación n°</th>
                                    <th>Estado</th>
                                    <th>Encuestas Cargadas </br>(Efectivas/No Efectivas)</th>
                                    <th>Acciones</th>

                                </tr>
                        @foreach ($areas as $item)

                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->area}}</td>
                                    <td>{{$item->anio}}</td>
                                    <td>{{$item->trimestre}}</td>
                                    <td>{{$item->semana}}</td>
                                    <td>{{$item->visita}}</td>
                                    <td>{{$item->status}}</td>
                                    <th>{{$item->encuestas->count()}}</th>
                                    {{-- ({{$item->getEfectiva()}}/{{$item->getNoEfectiva()}})</th> --}}

                                            <td>
                                                <div class="btn-group">

                                                    @if($item->status !== 'finalizado')

                                                <a name="" id="" class="btn btn-primary btn-sm " href="{{route('supervisarArea',['id'=>$item->id])}}" role="button">Supervisar</a>
                                                 <a name="" id="" class="btn btn-success btn-sm " href="{{route('finalizarArea',['id'=>$item->id])}}" role="button">Finalizar Supervision</a>



                                                    @endif

                                                {{-- <form method="POST" action="{{route('entregarArea')}}">
                                                        @csrf
                                                        <input type="hidden" name="area_id" value="{{$item->id}}">
                                                        <button type="submit" class="btn btn-success btn-sm">Entregar</br> Área</button>
                                                    </form> --}}
                                                </div>
                                            </td>
                                </tr>

                        @endforeach
                    </table>
                    @else
                         No Hay Areas Cargadas
                    @endif

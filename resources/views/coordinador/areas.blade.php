<div class="card-body">
                    @if ($areas->count())
                    <table class="table">
                                <tr>
                                    {{-- <th>°</th> --}}
                                    <th>Area</th>
                                    <th>Año</th>
                                    <th>Trimestre</th>
                                    <th>Semana</th>
                                    <th>Participación n°</th>
                                    <th>Encuestador</th>
                                    <th>Estado</th>
                                      <th>Encuestas Cargadas </br>(Efectivas/No Efectivas)</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                        @foreach ($areas as $item)
                        @if($item->anio == $anio && $item->trimestre == $trimestre)
                                <tr>
                                    {{-- <td>{{$item->id}}</td> --}}
                                    <td>{{$item->area}}</td>
                                    <td>{{$item->anio}}</td>
                                    <td>{{$item->trimestre}}</td>
                                    <td>{{$item->semana}}</td>
                                    <td>{{$item->visita}}</td>
                                    <td>{{$item->encuestador->name}}</td>
                                <td>{{$item->status}}

                                </td>
                                    <th>{{$item->encuestas->count()}}
                                        ({{$item->getEfectiva()}}/{{$item->getNoEfectiva()}})</th>



                                           @if($item->status == "entregado")
                                             <td>
                                             <a name="" id="" class="btn btn-primary btn-sm" href="{{route('coordinadorDetalleArea',['id'=>$item->id])}}" role="button">Controlar Area</a>
                                            </td>

                                             <td>
                                                        <form method="POST" action="{{route('rechazarArea')}}">
                                                        @csrf
                                                    <input type="hidden" name="area_id" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                                                    </form>
                                            </td>
                                            @elseif($item->status == "en supervision")
                                            <td>
                                                <a name="" id="" class="btn btn-danger btn-sm" href="{{route('desasginar',['id'=>$item->id])}}" role="button">DesAsignar</a>
                                            </td>

                                            @if($item->supervisor->name)

                                            <td>asignado a </br>{{$item->supervisor->name}}</td>
                                            @else
                                            <td>
                                                asignado a
                                            </td>
                                            @endif
                                             @elseif($item->status == "finalizado")
                                           <td>
                                                <a name="" id="" class="btn btn-danger btn-sm" href="{{route('desasginar',['id'=>$item->id])}}" role="button">DesAsignar</a>
                                            </td>

                                            @if($item->supervisor->name)

                                            <td>asignado a </br>{{$item->supervisor->name}}</td>
                                            @else
                                            <td>
                                                asignado a
                                            </td>
                                            @endif

                                             @elseif($item->status == "recibido")
                                             <td>
                                                    <form method="POST" action="{{route('asignarSupervisor')}}">
                                                        @csrf
                                                    <input type="hidden" name="area_id" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-success btn-sm">Asignar Supervisor</button>
                                                    </form>
                                            </td>
                                            <td></td>
                                            @endif
                                </tr>
                                @endif
                        @endforeach
                    </table>
                    @else
                         No hay áreas en espera.
                    @endif

                </div>

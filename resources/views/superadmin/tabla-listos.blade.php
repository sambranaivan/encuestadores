 <table class="table table-sm table-tripped text-center" id="table">
                            <thead>
                                <tr  class="bg-dark text-light">
                                    <th>AREA</th>
                                    {{-- <th>estado</th> --}}
                                     <th>listado</th>
                                      <th>hogar</th>
                                    <th>Situacion</th>
                                    <th>Ingreso Total</th>
                                    <th>Componentes</th>
                                    <th>Adulto Equivalente</th>
                                    <th>Ingreso Necesario </br>CBT NEA</th>
                                    <th>Estimación</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($efectivos as $item)
                                @if($item->listo && !($item->isHistorico()))
                                <tr

                                @if($item->estado())

                                            @if($item->esPobre())
                                            class="table-success"
                                            @else
                                            class="table-danger"
                                         @endif
                                         @else
                                          class="table-warning"

                                         @endif

                                >
                                    <td>
                                        {{$item->area->area}}
                                    </td>
                                    <td>
                                        {{$item->listado}}
                                    </td>
                                    <td>
                                        {{$item->hogar}}
                                    </td>
                                <td>Año:{{$item->area->anio}} Tri:{{$item->area->trimestre}} Sem:{{$item->area->semana}}</td>
                                <td>{{$item->getMonts()}}</td>
                                <td>
                                    {{$item->componentes->count()}}
                                </td>
                                    <td>
                                       {{$item->getPonds()}}
                                    </td>
                                     <td>
                                       $ {{$item->getMinimo()}}
                                    </td>

                                    <td>
                                         @if($item->estado())
                                           {{$item->diff()}}

                                           @else
                                           No declaro montos
                                         @endif
                                    </td>
                                    <td>
                                        @if(!$item->esPobre() && $item->estado())
                                            ( {{$item->pordiff()}} %)
                                           @endif
                                    </td>
                                <td>


                                            <a name="" id="" class="btn btn-primary btn-sm" href="{{route('superVerEncuesta',['id'=>$item->id])}}" role="button">Ver detalle</a>





                                </td>
                                <td>
                                       <a name="" id="" class="btn btn-primary btn-sm" href="{{route('AdminEditEncuesta',['id'=>$item->id])}}" role="button">Modificar</a>

                                </td>

                                <td>
                                     @if($item->listo)
                                    <a href="#" class="btn btn-sm  btn-primary active" role="button">Marcado como listo</a>
                                    @else
                                    <a name="" id="" class="btn btn-success btn-sm" href="{{route('listoHome',['id'=>$item->id])}}" role="button">Listo para Cargar</a>
                                    @endif
                                </td>




                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>

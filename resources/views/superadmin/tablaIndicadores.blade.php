<div class="card">
<div class="card-header">Año: {{$info['anio']}} - Trimestre: {{$info['trimestre']}}</div>

                <div class="card-body">

                    <table class="table table-sm table-stripped text-center">
                        <thead>
                            <tr>
                            <th >
                            Total de Hogares
                        </th>
                        <th >
                            Efectivas
                        </th>
                        <th >
                            No Efectivas
                        </th>
                        <th >
                            Completas
                        </th>
                        <th >
                            Falta monto en ingreso
                        </th>
                         <th >
                            Pobreza Hogares
                        </th>
                        <th >
                            No pobres Hogares
                        </th>
                        <th >
                            Pobreza (Individual)
                        </th>
                        <th >
                            No pobres (Individual)
                        </th>
                        <th>
                            Total Individuales
                        </th>
                    </tr>
                        </thead>
                        <td >
                            {{$info['totales']}}
                        </td>
                        <td >
                            {{$info['efectivas']}}/{{$info['totales']}}
                        </br>({{round($info['efectivas']*100/$info['totales'],2)}}%)
                        </td>
                        <td >
                            {{$info['noefectivas']}}/{{$info['totales']}}
                        </br>({{round($info['noefectivas']*100/$info['totales'],2)}}%)
                        </td>
                        <td >
                            {{$info['completos']}}/{{$info['efectivas']}}
                        </br>({{round($info['completos']*100/$info['efectivas'],2)}}%)
                        </td>
                        <td >
                            {{$info['incompletos']}}/{{$info['efectivas']}}
                        </br>({{round($info['incompletos']*100/$info['efectivas'],2)}}%)
                        </td>
                         <td >
                            {{$info['pobre']}}/{{$info['efectivas']}}
                         </br>({{round($info['pobre']*100/$info['efectivas'],2)}}%)
                        </td>
                        <td >
                            {{$info['nopobre']}}/{{$info['efectivas']}}
                        </br>({{round($info['nopobre']*100/$info['efectivas'],2)}}%)
                        </td>
                          <td >
                            {{$info['individualpobre']}}/{{$info['totalesi']}}
                          </br>({{round($info['individualpobre']*100/$info['totalesi'],2)}}%)
                        </td>
                        <td >
                            {{$info['individualnopobre']}}/{{$info['totalesi']}}
                        </br>({{round($info['individualnopobre']*100/$info['totalesi'],2)}}%)
                        </td>
                         <td >
                            {{$info['totalesi']}}
                        </td>
                    </table>
                </div>
            </div>

<table class="table table-responsive" id="estanqueEspecies-table">
        <div class="box-header">
            <h3 class="box-title">Estanque Número: {{$numeroEstanque}}</h3>
        </div>
        <!-- /.box-header -->
                    <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">

                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">Especie</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Estanque</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Cantidad</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Acción</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Movimiento</th>

                            </tr>
                            </thead>
                            <div class="mailbox-messages">
                                <tbody>

                                @foreach($estanqueEspecies as $estanqueEspecie)

                                    <tr role="row" class="odd">
                                        {{--{!! $estanqueEspecie->especie->nombre_comun !!}--}}
                                        <td class="sorting_1">{!! $estanqueEspecie->especie->nombre_comun !!}</td>
                                        <td>{!! $estanqueEspecie->estanque->num_estanque!!}</td>
                                        <td>{!! $estanqueEspecie->cantidad !!}</td>
                                        <td>
                                            {!! Form::open(['route' => ['estanqueEspecies.destroy', $estanqueEspecie->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                                {{--<a href="{!! route('estanqueEspecies.show', [$estanqueEspecie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                                                <a href="{!! route('estanqueEspecies.edit', [$estanqueEspecie->id]) !!}" title="Editar" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

                                                <a href="#ModalEliminar-{{$estanqueEspecie->id}}" data-toggle="modal" title="Eliminar" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                                                @include('estanque_especies.ModalEliminar')
                                            </div>
                                            {!! Form::close() !!}
                                        </td>


                                        {{--columana de movientos--}}
                                        <td>
                                            <div class='btn-group'>

                                                {{--etiquetas--}}
                                                <span class="" title="Traslado">
                                                    <a class='btn btn-default btn-xs' href="#ModalTraslado-{{$estanqueEspecie->id}}"  data-toggle="modal" title="Traslado" >
                                                        Traslado
                                                        <i class="glyphicon glyphicon-transfer"></i>
                                                    </a>
                                                </span>

                                                <span class="" title="Defunción">
                                                    <a class='btn btn-default btn-xs' href="#ModalDefuncion-{{$estanqueEspecie->id}}"  data-toggle="modal" title="Defunción" >
                                                        Defunción
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                    </a>
                                                </span>


                                                {{--formularios--}}

                                                {{--defuncion--}}
                                                {!! Form::open(['route' => ['estanqueEspecies.defuncionEspecie', $estanqueEspecie->id], 'method' => 'post']) !!}
                                                @include('estanque_especies.ModalDefuncion')
                                                {!! Form::close() !!}

                                                {{--traslado--}}
                                                {!! Form::open(['route' => ['estanqueEspecies.trasladarEspecie', $estanqueEspecie->id], 'method' => 'post']) !!}
                                                @include('estanque_especies.ModalTraslado')
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                        {{--fin columna de movimientos--}}

                                    </tr>
                                @endforeach
                                </tbody>
                            </div>
                        </table>
                    </div>
        <!-- /.box-body -->
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-formhelpers.js') }}"></script>

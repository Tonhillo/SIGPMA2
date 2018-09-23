<div class="table-responsive">
    <table class="table" id="estanqueFamilias-table">
        <thead>
            <tr>
                <th>Nombre común de la especie</th>
                <th>Número del estanque</th>
                <th>Número de machos</th>
                <th>Número de hembras</th>
                <th>Numero de indefinidos</th>
                <th>Fecha de inicio de la familia</th>
                <th>Estado del estanque</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>

        @foreach($estanqueFamilias as $estanqueFamilia)
            <tr>
                <td>{!! $estanqueFamilia->especie->nombre_comun !!}</td>
                <td>{!! $estanqueFamilia->estanque->num_estanque !!}</td>
                <td>{!! $estanqueFamilia->numero_de_machos !!}</td>
                <td>{!! $estanqueFamilia->numero_de_hembras !!}</td>
                <td>{!! $estanqueFamilia->numero_de_indefinidos !!}</td>
                <td>{!! $estanqueFamilia->fecha_inicio_familia->format('d / M / Y') !!}</td>
                <td>{!! $estanqueFamilia->estado !!}</td>
                <td>
                    {!! Form::open(['route' => ['estanqueFamilias.destroy', $estanqueFamilia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('estanqueFamilias.show', [$estanqueFamilia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('estanqueFamilias.edit', [$estanqueFamilia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

                        <!-- La siguiente linea, se eliminó el boton que crea Laravel por defecto, y se agrega la etiqueta -->
                        <!-- 'a'  de HTML, sustituyendo el boton. -->
                        <a href="#modalEliminar-{{$estanqueFamilia->id}}" data-toggle="modal" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>

                        <!-- Se incluye el modal en el form, que fue creado en una vista aparte. -->
                        @include('estanque_familias.modal_eliminar')

                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
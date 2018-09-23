<table class="table table-responsive" id="oxigenos-table">
    <thead>
        <tr>
            <th>Número del Estanque</th>
        <th>Valor</th>
        <th>Fecha</th>
        <th>Hora</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($oxigenos as $oxigeno)
        <tr>
            <tr>
                @for($i=0;$i<count($estanques);$i++)
                    @if($estanques[$i]->id == $oxigeno->id_estanque)
                        <td>{!! $estanques[$i]->num_estanque !!}</td>
                    @endif
                @endfor
            <td>{!! $oxigeno->valor !!}</td>
            <td>{!! $oxigeno->fecha->format('Y-m-d') !!}</td>
            <td>{!! $oxigeno->hora !!}</td>
            <td>
                {!! Form::open(['route' => ['oxigenos.destroy', $oxigeno->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('oxigenos.show', [$oxigeno->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('oxigenos.edit', [$oxigeno->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Está seguro de querer eliminar?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
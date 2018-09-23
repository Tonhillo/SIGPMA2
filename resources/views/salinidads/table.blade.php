<table class="table table-responsive" id="salinidads-table">
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
    @foreach($salinidades as $salinidad)
        <tr>
            @for($i=0;$i<count($estanques);$i++)
                @if($estanques[$i]->id == $salinidad->id_estanque)
                    <td>{!! $estanques[$i]->num_estanque !!}</td>
                @endif
            @endfor
            <td>{!! $salinidad->valor !!}</td>
            <td>{!! $salinidad->fecha->format('Y-m-d') !!}</td>
            <td>{!! $salinidad->hora !!}</td>
            <td>
                {!! Form::open(['route' => ['salinidads.destroy', $salinidad->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('salinidads.show', [$salinidad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('salinidads.edit', [$salinidad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Está seguro de querer eliminar?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
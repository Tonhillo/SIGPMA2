<table class="table table-responsive" id="nitratos-table">
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
    @foreach($nitratos as $nitratos)
        <tr>
            @for($i=0;$i<count($estanques);$i++)
                @if($estanques[$i]->id == $nitratos->id_estanque)
                    <td>{!! $estanques[$i]->num_estanque !!}</td>
                @endif
            @endfor
            <td>{!! $nitratos->valor !!}</td>
            <td>{!! $nitratos->fecha->format('Y-m-d') !!}</td>
            <td>{!! $nitratos->hora !!}</td>
            <td>
                {!! Form::open(['route' => ['nitratos.destroy', $nitratos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('nitratos.show', [$nitratos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('nitratos.edit', [$nitratos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Está seguro de querer eliminar?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-responsive" id="temperaturas-table">
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
    @foreach($temperaturas as $temperatura)
        <tr>
            @for($i=0;$i<count($estanques);$i++)
                @if($estanques[$i]->id == $temperatura->id_estanque)
                    <td>{!! $estanques[$i]->num_estanque !!}</td>
                    @endif
                @endfor
            <td>{!! $temperatura->valor !!}</td>
            <td>{!! $temperatura->fecha->format('Y-m-d') !!}</td>
            <td>{!! $temperatura->hora !!}</td>
            <td>
                {!! Form::open(['route' => ['temperaturas.destroy', $temperatura->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('temperaturas.show', [$temperatura->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('temperaturas.edit', [$temperatura->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Está seguro de querer eliminar?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
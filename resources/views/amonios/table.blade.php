<table class="table table-responsive" id="amonios-table">
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
    @foreach($amonios as $amonio)
        <tr>
            @for($i=0;$i<count($estanques);$i++)
                @if($estanques[$i]->id == $amonio->id_estanque)
                    <td>{!! $estanques[$i]->num_estanque !!}</td>
                @endif
            @endfor
            <td>{!! $amonio->valor !!}</td>
            <td>{!! $amonio->fecha->format('Y-m-d') !!}</td>
            <td>{!! $amonio->hora !!}</td>
            <td>
                {!! Form::open(['route' => ['amonios.destroy', $amonio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('amonios.show', [$amonio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('amonios.edit', [$amonio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Está seguro de querer eliminar?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
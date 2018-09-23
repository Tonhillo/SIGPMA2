<table class="table table-responsive" id="estanqueAlimentacions-table">
    <thead>
        <tr>
            <th>Id Estanque</th>
        <th>Id Alimento</th>
        <th>Fecha Alimentacion</th>
        <th>Hora Alimentacion</th>
        <th>Peso</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($estanqueAlimentacions as $estanqueAlimentacion)
        <tr>
            @for($i=0;$i<count($estanques);$i++)
                @if($estanques[$i]->id == $estanqueAlimentacion->id_estanque)
                    <td>{!! $estanques[$i]->num_estanque !!}</td>
                @endif
            @endfor
            <td>{!! $estanqueAlimentacion->id_alimento !!}</td>
            <td>{!! $estanqueAlimentacion->fecha_alimentacion->format('Y-m-d') !!}</td>
            <td>{!! $estanqueAlimentacion->hora_alimentacion !!}</td>
            <td>{!! $estanqueAlimentacion->peso !!}</td>
            <td>
                {!! Form::open(['route' => ['estanqueAlimentacions.destroy', $estanqueAlimentacion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('estanqueAlimentacions.show', [$estanqueAlimentacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('estanqueAlimentacions.edit', [$estanqueAlimentacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
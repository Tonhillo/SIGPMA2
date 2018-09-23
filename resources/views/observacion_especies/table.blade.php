<table class="table table-responsive" id="observacionEspecies-table">
    <thead>
        <tr>
            <th>Id Especie</th>
        <th>Id Observacion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($observacionEspecies as $observacionEspecie)
        <tr>
            <td>{!! $observacionEspecie->id_especie !!}</td>
            <td>{!! $observacionEspecie->id_observacion !!}</td>
            <td>
                {!! Form::open(['route' => ['observacionEspecies.destroy', $observacionEspecie->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('observacionEspecies.show', [$observacionEspecie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('observacionEspecies.edit', [$observacionEspecie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
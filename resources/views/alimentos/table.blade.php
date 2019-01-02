<table class="table table-responsive" id="alimentos-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Tipo</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($alimentos as $alimentos)
        <tr>
            <td>{!! $alimentos->nombre !!}</td>
            <td>{!! $alimentos->tipo !!}</td>
            <td>
                {!! Form::open(['route' => ['alimentos.destroy', $alimentos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('alimentos.show', [$alimentos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('alimentos.edit', [$alimentos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
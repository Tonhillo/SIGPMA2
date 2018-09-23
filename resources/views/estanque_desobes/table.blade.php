<table class="table table-responsive" id="estanqueDesobes-table">
    <thead>
        <tr>
            <th>Id Estanque</th>
        <th>Id Desobe</th>
        <th>Fecha</th>
        <th>Descripcion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($estanqueDesobes as $estanqueDesobe)
        <tr>
            <td>{!! $estanqueDesobe->id_estanque !!}</td>
            <td>{!! $estanqueDesobe->id_desobe !!}</td>
            <td>{!! $estanqueDesobe->fecha !!}</td>
            <td>{!! $estanqueDesobe->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['estanqueDesobes.destroy', $estanqueDesobe->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('estanqueDesobes.show', [$estanqueDesobe->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('estanqueDesobes.edit', [$estanqueDesobe->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
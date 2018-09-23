
<table class="table table-responsive" id="fisicoQuimicos-table">
    <thead>
        <tr>
            <th>Temperatura</th>
        <th>Ph</th>
        <th>Nitritos</th>
        <th>Nitratos</th>
        <th>Salinidad</th>
        <th>Amonio</th>
        <th>Oxigeno</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($fisicoQuimicos as $fisicoQuimico)
        <tr>
            <td>{!! $fisicoQuimico->temperatura !!}</td>
            <td>{!! $fisicoQuimico->pH !!}</td>
            <td>{!! $fisicoQuimico->nitritos !!}</td>
            <td>{!! $fisicoQuimico->nitratos !!}</td>
            <td>{!! $fisicoQuimico->salinidad !!}</td>
            <td>{!! $fisicoQuimico->amonio !!}</td>
            <td>{!! $fisicoQuimico->oxigeno !!}</td>
            <td>
                {!! Form::open(['route' => ['fisicoQuimicos.destroy', $fisicoQuimico->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('fisicoQuimicos.show', [$fisicoQuimico->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('fisicoQuimicos.edit', [$fisicoQuimico->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

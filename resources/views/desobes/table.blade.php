<table class="table table-responsive" id="desobes-table">
    <thead>
        <tr>
           <th>Num Estanque</th>
            <th>Num Huevos Total</th>
            <th>Num Huevos No Viables</th>
            <th>Num Huevos Viables</th>
            <th>Porcentaje Viabilidad</th>
            <th>Diametro Huevo</th>
            <th>Diametro Gota</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($desobes as $desobe)
        <tr>
            <td>{!! $desobe->id !!}</td>
            <td>{!! $desobe->num_huevos_total !!}</td>
            <td>{!! $desobe->num_huevos_no_viables !!}</td>
            <td>{!! $desobe->num_huevos_viables !!}</td>
            <td>{!! $desobe->porcentaje_viabilidad !!}</td>
            <td>{!! $desobe->diametro_huevo !!}</td>
            <td>{!! $desobe->diametro_gota !!}</td>
            <td>
                {!! Form::open(['route' => ['desobes.destroy', $desobe->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('desobes.show', [$desobe->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('desobes.edit', [$desobe->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
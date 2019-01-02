<div class="table-responsive">
    <table class="table" id="especies-table">
        <thead>
            <tr>
            <th>Familia</th>
            <th>Nombre Cientifico</th>
            <th>Nombre Comun</th>
            <th>Nombre Comun En</th>
            <th>Descripcion Es</th>
            <th>Descripcion En</th>
            <th>Imagen</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($especies as $especie)
            <tr>
                <td>{!! $especie->familia !!}</td>
                <td>{!! $especie->nombre_cientifico !!}</td>
                <td>{!! $especie->nombre_comun !!}</td>
                <td>{!! $especie->nombre_comun_en !!}</td>
                <td>{!! $especie->descripcion_es !!}</td>
                <td>{!! $especie->descripcion_en !!}</td>
                <td><img class="especieImage" style="width: 75px" src="{!! $especie->imagen_url !!}" alt=""></td>
                <td>
                    {{-- {!! Form::open(['route' => ['especies.destroy', $especie->id], 'method' => 'delete']) !!} --}}
                    <div class='btn-group'>
                        <a href="{!! route('especies.show', [$especie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('especies.edit', [$especie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

                        <!-- La siguiente linea, se eliminó el boton que crea Laravel por defecto, y se agrega la etiqueta -->
                        <!-- 'a'  de HTML, sustituyendo el boton. -->
                        {{-- <a href="#modalEliminar-{{$especie->id}}" data-toggle="modal" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a> --}}

                        <!-- Se incluye el modal en el form, que fue creado en una vista aparte. -->
                        {{-- @include('especies.modal_eliminar') --}}

                    </div>
                    {{-- {!! Form::close() !!} --}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

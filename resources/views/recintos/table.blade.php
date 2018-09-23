
<table class="table table-responsive" id="recintos-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($recintos as $recinto)
        <tr>
            <td>{!! $recinto->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['recintos.destroy', $recinto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('recintos.show', [$recinto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    @if(Auth::user()->id_recinto==$recinto->id)
                        <a href="{!! route('recintos.edit', [$recinto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    @endif


                    {{--<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-danger">--}}
                      {{--<i class="glyphicon glyphicon-trash"></i>--}}
                    {{--</button>--}}
                </div>
                <div class="modal modal-danger fade" id="modal-danger">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h4 class="modal-title">Desea completar la acción</h4>
                      </div>
                      <div class="modal-body">
                        <p>Al aceptar estará eliminando no solamente los recintos</p>
                        <p>sino tambien los estanques inscritos en este recinto.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-outline">Eliminar</button>

                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="table-responsive">
        <table class="table" id="alimentos-table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Email</th>
                    <th colspan="3">Action</th>
                </tr>
                </thead>
                <tbody>
            
                @foreach($users as $user)
                    @if(Auth::user() != $user)
                    <tr>
                        <td>{!! $user->name !!}</td>
                        <td>{!! $user->getRoleNames()[0]!!}</td>
                        <td>{!! $user->email !!}</td>
                        <td>
                            {!! Form::open(['route' => ['usuarios.destroy', $user->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                {{--<a href="{!! route('alimentos.show', [$alimentos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                                <a href="{!! route('usuarios.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#ModalEliminar-{{$user->id}}" data-toggle="modal" class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i></a>

                                @include('usuarios.ModalEliminar')
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
</div>
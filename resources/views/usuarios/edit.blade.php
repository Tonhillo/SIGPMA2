@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Usuario
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
                   {!! Form::model($user, ['route' => ['usuarios.update', $user->id], 'files' => false, 'method' => 'patch']) !!}

                        @include('usuarios.fields')

                   {!! Form::close() !!}
   </div>
@endsection

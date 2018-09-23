@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Crear Usuario
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')

                    {!! Form::open(['route' => 'usuarios.store']) !!}

                        @include('usuarios.fields')

                    {!! Form::close() !!}
    </div>
@endsection

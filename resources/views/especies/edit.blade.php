@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Especie
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($especie, ['route' => ['especies.update', $especie->id], 'files' => true, 'method' => 'patch']) !!}

                        @include('especies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

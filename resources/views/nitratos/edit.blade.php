@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Nitratos
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($nitratos, ['route' => ['nitratos.update', $nitratos->id], 'method' => 'patch']) !!}

                        @include('nitratos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
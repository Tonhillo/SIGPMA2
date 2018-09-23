@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Temperatura
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($temperatura, ['route' => ['temperaturas.update', $temperatura->id], 'method' => 'patch']) !!}

                        @include('temperaturas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
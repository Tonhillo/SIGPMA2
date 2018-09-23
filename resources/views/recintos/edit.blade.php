@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Recinto
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($recinto, ['route' => ['recintos.update', $recinto->id], 'method' => 'patch']) !!}

                        @include('recintos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
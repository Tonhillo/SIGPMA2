@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Estanque
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estanque, ['route' => ['estanques.update', $estanque->id], 'method' => 'patch']) !!}

                        @include('estanques.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
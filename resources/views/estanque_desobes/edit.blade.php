@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Estanque Desobe
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estanqueDesobe, ['route' => ['estanqueDesobes.update', $estanqueDesobe->id], 'method' => 'patch']) !!}

                        @include('estanque_desobes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Estanque Alimentacion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estanqueAlimentacion, ['route' => ['estanqueAlimentacions.update', $estanqueAlimentacion->id], 'method' => 'patch']) !!}

                        @include('estanque_alimentacions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
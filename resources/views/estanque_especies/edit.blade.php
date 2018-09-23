@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Estanque Especie
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estanqueEspecie, ['route' => ['estanqueEspecies.update', $estanqueEspecie->id], 'method' => 'patch']) !!}

                        @include('estanque_especies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
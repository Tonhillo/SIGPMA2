@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Desobe
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($desobe, ['route' => ['desobes.update', $desobe->id], 'method' => 'patch']) !!}

                        @include('desobes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
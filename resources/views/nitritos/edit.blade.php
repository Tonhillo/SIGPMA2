@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Nitritos
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($nitritos, ['route' => ['nitritos.update', $nitritos->id], 'method' => 'patch']) !!}

                        @include('nitritos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
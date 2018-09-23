@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            P H
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pH, ['route' => ['pHs.update', $pH->id], 'method' => 'patch']) !!}

                        @include('p_hs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
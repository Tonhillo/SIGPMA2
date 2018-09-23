@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Estanque Familias</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('estanqueFamilias.create') !!}"><i class="glyphicon glyphicon-plus"></i> Agregar nuevo</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message') 

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('estanque_familias.table')
           
                    <!-- se carga la clase de css de paginación -->
                <div class="pagination"> 
                     <!--Se referencia a la variable $estanqueFamilias que es la 
                    que contiene el listado de todos los usuarios y además se muestra la paginación-->
                    {!!$estanqueFamilias->render() !!}
                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>

       <!-- div.row>div.col*3-->

    </div>

    




   

@endsection


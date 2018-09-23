{{--<!-- Id Field -->--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('id', 'Id:') !!}--}}
    {{--<p>{!! $estanqueEspecie->id !!}</p>--}}
{{--</div>--}}

<!-- Id Especie Field -->
<div class="form-group">
    {!! Form::label('id_especie', 'Id Especie:') !!}
    <p>{!! $estanqueEspecie->id_especie !!}</p>
</div>

<!-- Id Estanque Field -->
<div class="form-group">
    {!! Form::label('id_estanque', 'Id Estanque:') !!}
    <p>{!! $estanqueEspecie->id_estanque !!}</p>
</div>

<!-- Cantidad Field -->
<div class="form-group">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <p>{!! $estanqueEspecie->cantidad !!}</p>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado el:') !!}
    <p>{!! $estanqueEspecie->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Modificado el:') !!}
    <p>{!! $estanqueEspecie->updated_at !!}</p>
</div>


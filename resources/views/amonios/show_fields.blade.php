<!-- Id Field -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('id', 'Id:') !!}--}}
    {{--<p>{!! $amonio->id !!}</p>--}}
{{--</div>--}}

{{--<!-- Id Estanque Field -->--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('id_estanque', 'Id Estanque:') !!}--}}
    {{--<p>{!! $amonio->id_estanque !!}</p>--}}
{{--</div>--}}

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{!! $amonio->valor !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! $amonio->fecha !!}</p>
</div>

<!-- Hora Field -->
<div class="form-group">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{!! $amonio->hora !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado en:') !!}
    <p>{!! $amonio->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Modificado en:') !!}
    <p>{!! $amonio->updated_at !!}</p>
</div>


<!-- Id Field -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('id', 'Id:') !!}--}}
    {{--<p>{!! $oxigeno->id !!}</p>--}}
{{--</div>--}}

{{--<!-- Id Estanque Field -->--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('id_estanque', 'Id Estanque:') !!}--}}
    {{--<p>{!! $oxigeno->id_estanque !!}</p>--}}
{{--</div>--}}

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{!! $oxigeno->valor !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! $oxigeno->fecha !!}</p>
</div>

<!-- Hora Field -->
<div class="form-group">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{!! $oxigeno->hora !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado en:') !!}
    <p>{!! $oxigeno->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Modificado en:') !!}
    <p>{!! $oxigeno->updated_at !!}</p>
</div>


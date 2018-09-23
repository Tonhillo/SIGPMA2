{{--<!-- Id Field -->--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('id', 'Id:') !!}--}}
    {{--<p>{!! $temperatura->id !!}</p>--}}
{{--</div>--}}

{{--<!-- Id Estanque Field -->--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('id_estanque', 'Id Estanque:') !!}--}}
    {{--<p>{!! $temperatura->id_estanque !!}</p>--}}
{{--</div>--}}

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{!! $temperatura->valor !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! $temperatura->fecha !!}</p>
</div>

<!-- Hora Field -->
<div class="form-group">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{!! $temperatura->hora !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado en:') !!}
    <p>{!! $temperatura->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Modificado en:') !!}
    <p>{!! $temperatura->updated_at !!}</p>
</div>


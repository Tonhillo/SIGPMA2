{{--<!-- Id Field -->--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('id', 'Id:') !!}--}}
    {{--<p>{!! $salinidad->id !!}</p>--}}
{{--</div>--}}

{{--<!-- Id Estanque Field -->--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('id_estanque', 'Id Estanque:') !!}--}}
    {{--<p>{!! $salinidad->id_estanque !!}</p>--}}
{{--</div>--}}

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{!! $salinidad->valor !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! $salinidad->fecha !!}</p>
</div>

<!-- Hora Field -->
<div class="form-group">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{!! $salinidad->hora !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado en:') !!}
    <p>{!! $salinidad->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Modificado en:') !!}
    <p>{!! $salinidad->updated_at !!}</p>
</div>


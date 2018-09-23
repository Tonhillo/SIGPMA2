<!-- Id Field -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('id', 'Id:') !!}--}}
    {{--<p>{!! $pH->id !!}</p>--}}
{{--</div>--}}

{{--<!-- Id Estanque Field -->--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('id_estanque', 'Id Estanque:') !!}--}}
    {{--<p>{!! $pH->id_estanque !!}</p>--}}
{{--</div>--}}

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{!! $pH->valor !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! $pH->fecha !!}</p>
</div>

<!-- Hora Field -->
<div class="form-group">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{!! $pH->hora !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado el:') !!}
    <p>{!! $pH->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Modificado el:') !!}
    <p>{!! $pH->updated_at !!}</p>
</div>


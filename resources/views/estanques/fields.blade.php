<!-- Num Estanque Field -->
<!-- Id Recinto Field -->

<div class="form-group col-sm-6">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input step="any"  name="id_recinto" value="{{Auth::user()->id_recinto}}" class="form-control" readonly type="hidden"/>
    {!! Form::label('num_estanque', 'Num Estanque:') !!}
    {!! Form::text('num_estanque', null, ['class' => 'form-control']) !!}
</div>

<!-- Volumen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('volumen', 'Volumen:') !!}
    {!! Form::number('volumen', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Agua Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_agua', 'Tipo Agua:') !!}
    {!! Form::text('tipo_agua', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('estanques.index') !!}" class="btn btn-default">Cancelar</a>
</div>

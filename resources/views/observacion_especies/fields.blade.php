<!-- Id Especie Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_especie', 'Id Especie:') !!}
    {!! Form::text('id_especie', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Observacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_observacion', 'Id Observacion:') !!}
    {!! Form::text('id_observacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('observacionEspecies.index') !!}" class="btn btn-default">Cancel</a>
</div>

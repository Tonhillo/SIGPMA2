<!-- Nombre Field -->
<div class="form-group col-sm-6">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('recintos.index') !!}" class="btn btn-default">Cancelar</a>
</div>

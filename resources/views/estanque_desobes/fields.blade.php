<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-formhelpers.js') }}"></script>
<!-- Id Estanque Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_estanque', 'Id Estanque:') !!}
    {!! Form::text('id_estanque', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Desobe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_desobe', 'Id Desobe:') !!}
    {!! Form::text('id_desobe', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    <!-- {!! Form::text('fecha', null, ['class' => 'form-control']) !!} -->
    <div class="bfh-datepicker" data-name="fecha" data-format	="y-m-d" data-max="today"></div>
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('estanqueDesobes.index') !!}" class="btn btn-default">Cancel</a>
</div>

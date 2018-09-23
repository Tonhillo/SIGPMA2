<div class="form-group col-sm-12">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id_estanque" value="{{ $idEstanque }}">
    {!! Form::label('id_estanque', 'Estanque:') !!}
    <input step="any"  name="idEstanque" value="{{ $idEstanque }}" class="form-control" readonly/>
</div>

<!-- Id Especie Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_especie', 'Nombre de la especie:') !!}
    {!! Form::select('id_especie', $especies, null, ['class' => 'form-control']) !!}
</div>

<!-- Numero De Machos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_de_machos', 'Número de machos:') !!}
    {!! Form::number('numero_de_machos', null, ['class' => 'form-control']) !!}
</div>

<!-- Numero De Hembras Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_de_hembras', 'Número de hembras:') !!}
    {!! Form::number('numero_de_hembras', null, ['class' => 'form-control']) !!}
</div>

<!-- Numero De Indefinidos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_de_indefinidos', 'Número de indefinidos:') !!}
    {!! Form::number('numero_de_indefinidos', null, ['class' => 'form-control']) !!}
</div>


<!--  Creado por Jeniffer Hernández.
 El objetivo de la comparación es que, si estanque familia se encuentra vacío, es por que
 apenas se va a crear, por lo tanto la fecha deberá aparecer de la manera predeterminada (dd/mm/aa)
 de lo contrario, si trae los datos de un estanque familia, deberá mostrar la fecha que le pertenece.
-->
<!-- Fecha Inicio Familia Field -->

@if (empty($estanqueFamilia))

<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio_familia', 'Fecha de inicio de la familia:') !!}
    {!! Form::date('fecha_inicio_familia', null, ['class' => 'form-control']) !!}
</div>

@else 

<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicio_familia', 'Fecha de inicio de la familia:') !!}
    {!! Form::date('fecha_inicio_familia', $estanqueFamilia->fecha_inicio_familia, ['class' => 'form-control']) !!}
</div>

@endif

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado del estanque:') !!}
    {!! Form::text('estado', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('estanques.index') !!}" class="btn btn-default">Cancelar</a>
</div>

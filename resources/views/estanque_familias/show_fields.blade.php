<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'ID de estanque familia:') !!}
    <p>{!! $estanqueFamilia->id !!}</p>
</div>

<!-- Id Especie Field -->
<div class="form-group">
    {!! Form::label('id_especie', 'Nombre de la especie:') !!}
    <p>{!! $nombre_especie->nombre_comun !!}</p>
</div>

<!-- Id Estanque Field -->
<div class="form-group">
    {!! Form::label('id_estanque', 'Número de estanque / recinto:') !!}
    <p>{!! $numero_estanque->nombre !!}</p>
</div>

<!-- Numero De Machos Field -->
<div class="form-group">
    {!! Form::label('numero_de_machos', 'Número de machos:') !!}
    <p>{!! $estanqueFamilia->numero_de_machos !!}</p>
</div>

<!-- Numero De Hembras Field -->
<div class="form-group">
    {!! Form::label('numero_de_hembras', 'Número de hembras:') !!}
    <p>{!! $estanqueFamilia->numero_de_hembras !!}</p>
</div>

<!-- Numero De Indefinidos Field -->
<div class="form-group">
    {!! Form::label('numero_de_indefinidos', 'Número de indefinidos:') !!}
    <p>{!! $estanqueFamilia->numero_de_indefinidos !!}</p>
</div>

<!-- Fecha Inicio Familia Field -->
<div class="form-group">
    {!! Form::label('fecha_inicio_familia', 'Fecha de inicio de la familia:') !!}
    <p>{!! $estanqueFamilia->fecha_inicio_familia->format('d / M / Y') !!}</p>
</div>

<!-- Estado Field -->
<div class="form-group">
    {!! Form::label('estado', 'Estado del estanque:') !!}
    <p>{!! $estanqueFamilia->estado !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado en:') !!}
    <p>{!! $estanqueFamilia->created_at->format('d / M / Y') !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Modificado en:') !!}
    <p>{!! $estanqueFamilia->updated_at->format('d / M / Y') !!}</p>
</div>


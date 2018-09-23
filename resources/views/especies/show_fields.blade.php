<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $especie->id !!}</p>
</div>

<!-- Nombre Comun Field -->
<div class="form-group">
    {!! Form::label('nombre_comun', 'Nombre Comun:') !!}
    <p>{!! $especie->nombre_comun !!}</p>
</div>

<!-- Nombre Cientifico Field -->
<div class="form-group">
    {!! Form::label('nombre_cientifico', 'Nombre Cientifico:') !!}
    <p>{!! $especie->nombre_cientifico !!}</p>
</div>

<!-- Familia Field -->
<div class="form-group">
    {!! Form::label('familia', 'Familia:') !!}
    <p>{!! $especie->familia !!}</p>
</div>

<!-- Nombre Comun En Field -->
<div class="form-group">
    {!! Form::label('nombre_comun_en', 'Nombre Comun En:') !!}
    <p>{!! $especie->nombre_comun_en !!}</p>
</div>

<!-- Descripcion Es Field -->
<div class="form-group">
    {!! Form::label('descripcion_es', 'Descripcion Es:') !!}
    <p>{!! $especie->descripcion_es !!}</p>
</div>

<!-- Descripcion En Field -->
<div class="form-group">
    {!! Form::label('descripcion_en', 'Descripcion En:') !!}
    <p>{!! $especie->descripcion_en !!}</p>
</div>

<!-- Imagen Url Field -->
<div class="form-group">
    {!! Form::label('imagen_url', 'Imagen:') !!}
    <div><img class="img-responsive especieImageEdit" id="imagen_url" style="width: 355px" src="{!! '../../' . $especie->imagen_url !!}" alt=""></div>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado el:') !!}
    <p>{!! $especie->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Modificado el:') !!}
    <p>{!! $especie->updated_at !!}</p>
</div>

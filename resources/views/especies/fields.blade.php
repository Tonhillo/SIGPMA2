<!-- Nombre Comun Field -->
<div class="form-group col-sm-6">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {!! Form::label('nombre_comun', 'Nombre Comun:') !!}
    {!! Form::text('nombre_comun', null, ['class' => 'form-control', 'maxlength' => '100']) !!}
</div>

<!-- Nombre Cientifico Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_cientifico', 'Nombre Cientifico:') !!}
    {!! Form::text('nombre_cientifico', null, ['class' => 'form-control', 'maxlength' => '150']) !!}
</div>

<!-- Familia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('familia', 'Familia:') !!}
    {!! Form::text('familia', null, ['class' => 'form-control', 'maxlength' => '150']) !!}
</div>

<!-- Nombre Comun  ingles Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_comun_en', 'Nombre Común ingles:') !!}
    {!! Form::text('nombre_comun_en', null, ['class' => 'form-control', 'maxlength' => '100']) !!}
</div>

<!-- Descripcion Es Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion_es', 'Descripcion Es:') !!}
    {!! Form::textarea('descripcion_es', null, ['class' => 'form-control', 'maxlength' => '550']) !!}
</div>

<!-- Descripcion En Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion_en', 'Descripcion En:') !!}
    {!! Form::textarea('descripcion_en', null, ['class' => 'form-control', 'maxlength' => '550']) !!}
</div>

<!-- Imagen Url Field -->
<div class="form-group col-sm-6 DivespecieImageEdit">
  @if( ! empty($especie['imagen_url']))
    <div><img class="img-responsive especieImageEdit" id="imagen_url" style="width: 355px" src="{!! '../../' . $especie->imagen_url !!}" alt=""></div>
    <input type="file" name="imagen_url" accept="image/x-png,image/gif,image/jpeg" value="">

  @else
  {!! Form::label('imagen_url', 'Imagen:') !!}
  <input type="file" name="imagen_url" accept="image/x-png,image/gif,image/jpeg" value="">
  @endif



</div>


<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('especies.index') !!}" class="btn btn-default">Cancelar</a>
</div>

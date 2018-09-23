<!-- Id Especie Field -->


   <div class="form-group  col-sm-6">
    {!! Form::label('id_especie', 'Nombre de la especie:') !!}
    {!! Form::select('id_especie', $especies, null, ['class' => 'form-control']) !!}
  </div>

<!-- Id Estanque Field -->
<div class="form-group col-sm-6">
    <label for="Estanque">Estanque</label>
    {{--{!! Form::text('id_estanque', null, ['class' => 'form-control', 'value' => $idEstanque]) !!}--}}
    <input type="hidden" step="any"  name="id_estanque" value="{{$idEstanque}}" class="form-control" readonly/>
    <input type="number" step="any"  name="numEstanque" value="{{$numeroEstanque}}" class="form-control" readonly/>
    {{--<select name="id_estanque" id="id_estanque" class="form-control">--}}
       {{--@foreach($estanques as $estanque )--}}
       {{--<option value="{{$estanque['id']}}">{{$estanque ['num_estanque']}}</option >--}}
       {{--@endforeach--}}
    {{--</select>--}}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    <input type="number" step="any" min="1" name="cantidad" class="form-control"/>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="/estanqueEspecies/estanque/{{$idEstanque}}" class="btn btn-default">Cancelar</a>
</div>

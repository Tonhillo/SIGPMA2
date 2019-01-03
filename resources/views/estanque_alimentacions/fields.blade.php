<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-formhelpers.js') }}"></script>
<!-- Id Estanque Field -->
<div class="form-group col-sm-12">
    {!! Form::label('id_estanque', 'Número Estanque:') !!}
    <input type="hidden" step="any"  name="id_estanque" value="{{$idEstanque}}" class="form-control" readonly/>
    <input type="number" step="any"  name="numEstanque" value="{{$numeroEstanque}}" class="form-control" readonly/>
</div>



<!-- Fecha Alimentacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_alimentacion', 'Fecha Alimentacion:') !!}
    <!-- {!! Form::text('fecha_alimentacion', null, ['class' => 'form-control']) !!} -->
    <div class="bfh-datepicker" data-name="fecha_alimentacion" data-format	="y-m-d" data-max="today"></div>

</div>

<!-- Hora Alimentacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora_alimentacion', 'Hora Alimentacion:') !!}
    <!-- {!! Form::text('hora_alimentacion', null, ['class' => 'form-control']) !!} -->
    <div class="bfh-timepicker" data-name="hora_alimentacion">
    </div>
</div>

<!-- Id Alimento Field -->
<div class="form-group col-sm-6">
    <label for="Alimento">Alimento</label>
    <select name="id_alimento" id="id_alimento" class="form-control">
        @foreach($alimentos as $alimento )
            <option value="{{$alimento['id']}}">{{$alimento['nombre']}}</option>
        @endforeach
    </select>
</div>

<!-- Peso Field -->
<div class="form-group col-sm-6">
    {!! Form::label('peso', 'Peso en kg:') !!}
    {!! Form::number('peso', null, ['class' => 'form-control', 'min' => '0']) !!}
</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="/estanques" class="btn btn-default">Cancelar</a>
</div>



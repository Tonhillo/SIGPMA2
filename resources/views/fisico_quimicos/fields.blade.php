<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-formhelpers.js') }}"></script>
<div class="form-group col-sm-12">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {!! Form::label('id_estanque', 'Estanque:') !!}
    <input type="number" step="any"  name="numEstanque" value="{{$estanque->num_estanque}}" class="form-control" readonly/>
    <input type="hidden" step="any"  name="idEstanque" value="{{$estanque->id}}" class="form-control" readonly/>
</div>
{{-- <!— Fecha  —> --}}
<div class="form-group col-sm-12">
    {!! Form::label('fecha', 'Fecha de la medición:') !!}

    <div class="bfh-datepicker" data-name="fecha" data-format  ="y-m-d" data-max="today"></div>
</div>

{{-- <!— Temperatura Field —> --}}
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('temperatura', 'Temperatura C°:') !!}

        <input type="number" step="any" min="0"  name="temperatura" class="form-control"/>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('hora', 'Hora de la medición:') !!}

        <div class="bfh-timepicker" data-name="horaTemperatura">
        </div>
    </div>

</div>

{{--<!— Ph Field —>--}}
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('pH', 'pH:') !!}

        <input type="number" step="any" min="0" max="14"  name="pH" class="form-control"/>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('hora', 'Hora de la medición:') !!}

        <div class="bfh-timepicker" data-name="horaph">
        </div>

    </div>
</div>

{{--<!— Nitritos Field —>--}}
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('nitritos', 'Nitritos:') !!}

        <input type="number" step="any" min="0" name="nitritos" class="form-control"/>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('hora', 'Hora de la medición:') !!}

        <div class="bfh-timepicker" data-name="horanitritos"></div>
    </div>
</div>

{{--<!— Salinidad Field —>--}}
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('salinidad', 'Salinidad:') !!}

        <input type="number" step="any" min="0" name="salinidad" class="form-control"/>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('hora', 'Hora de la medición:') !!}

        <div class="bfh-timepicker" data-name="horasalinidad"></div>
    </div>
</div>

{{--<!— Nitratos Field —>--}}
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('nitratos', 'Nitratos:') !!}

        <input type="number" step="any" min="0" name="nitratos" class="form-control"/>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('hora', 'Hora de la medición:') !!}

        <div class="bfh-timepicker" data-name="horanitratos"></div>
    </div>
</div>

{{--<!— Amonio Field —>--}}
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('amonio', 'Amonio:') !!}

        <input type="number" step="any" min="0" name="amonio" class="form-control"/>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('hora', 'Hora de la medición:') !!}

        <div class="bfh-timepicker" data-name="horaamonio"></div>
    </div>
</div>

<!— Oxigeno Field —>
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('oxigeno', 'Oxigeno:') !!}

        <input type="number" step="any" min="0" name="oxigeno" class="form-control"/>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('hora', 'Hora de la medición:') !!}

        <div class="bfh-timepicker" data-name="horaoxigeno"></div>
    </div>
</div>

<!— Observacion Field —>
<div class="form-group col-sm-12">
    {!! Form::label('observacion', 'Observacion:') !!}
    {!! Form::textarea('observacion', null, ['class' => 'form-control', 'maxlength' => '375']) !!}
</div>
<!-- Submit Field -->
 <table class="table table-bordered" id="dynamic_field"></table>
<div class="form-group col-sm-12">

    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('estanques.index') !!}" class="btn btn-default">Cancelar</a>
</div>

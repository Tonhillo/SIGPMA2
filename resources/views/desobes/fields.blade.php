<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-formhelpers.js') }}"></script>
<div class="form-group col-sm-12">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {!! Form::label('id_estanque', 'Estanque:') !!}
    <input type="number" step="any"  name="id_estanque" value="{{$id_estanque}}" class="form-control" readonly/>
</div>
<!-- Fecha  -->
<div class="form-group col-sm-6">
{!! Form::label('fecha', 'Fecha de la medición:') !!}
<!-- {!! Form::date('fecha', null, ['class' => 'form-control']) !!} -->
    <div class="bfh-datepicker" data-name="fecha" data-format	="y-m-d" data-max="today"></div>
</div>
<!-- Hora  -->
<div class="form-group col-sm-6">
{!! Form::label('hora', 'Hora de la medición:') !!}
<!-- {!! Form::time('hora', null, ['class' => 'form-control']) !!} -->
    <div class="bfh-timepicker" data-name="hora">
    </div>
</div>
<!-- Num Huevos Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('num_huevos_total', 'Num Huevos Total:') !!}
    {!! Form::number('num_huevos_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Num Huevos Viables Field -->
<div class="form-group col-sm-6">
    {!! Form::label('num_huevos_viables', 'Num Huevos Viables:') !!}
    {!! Form::number('num_huevos_viables', null, ['class' => 'form-control']) !!}
</div>

<!-- Num Huevos No Viables Field -->
<div class="form-group col-sm-6">
    {!! Form::label('num_huevos_no_viables', 'Num Huevos No Viables:') !!}
    {!! Form::number('num_huevos_no_viables', null, ['class' => 'form-control']) !!}
</div>

<!-- Porcentaje Viabilidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('porcentaje_viabilidad', 'Porcentaje Viabilidad:') !!}
    {!! Form::number('porcentaje_viabilidad', null, ['class' => 'form-control','tabindex' => '-1', 'readonly']) !!}
</div>

<!-- Diametro Huevo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diametro_huevo', 'Diametro Huevo:') !!}
    {!! Form::number('diametro_huevo', null, ['class' => 'form-control', 'min' => '0']) !!}
</div>

<!-- Diametro Gota Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diametro_gota', 'Diametro Gota:') !!}
    {!! Form::number('diametro_gota', null, ['class' => 'form-control', 'min' => '0']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('estanques.index') !!}" class="btn btn-default">Cancelar</a>
</div>
<script>

    $( "#num_huevos_total" ).change(function() {
        var total=parseInt($( "#num_huevos_total" ).val());
        var viables=parseInt($( "#num_huevos_viables" ).val());
        $("#num_huevos_viables").val(null);
        $("#num_huevos_no_viables").val(null);
        $("#porcentaje_viabilidad").val(null);
        $("#num_huevos_viables").attr({
            "max" : $( "#num_huevos_total" ).val()
        });

        if($("#num_huevos_viables").val()){
            $("#num_huevos_viables").attr({
                "max" : $( "#num_huevos_total" ).val()
            });
            if($( "#num_huevos_total" ).val()>=$("#num_huevos_viables").val()){
                $("#porcentaje_viabilidad").val((viables*100)/total);
            }

        }
    });
    $( "#num_huevos_viables" ).change(function() {
        var total=parseInt($( "#num_huevos_total" ).val());
        var viables=parseInt($( "#num_huevos_viables" ).val());
        if($("#num_huevos_total").val()){
            if(total >= viables){

                $( "#num_huevos_no_viables" ).val($( "#num_huevos_total" ).val()-$("#num_huevos_viables").val());
                $("#porcentaje_viabilidad").val((viables*100)/total);
                console.log("1");
                //Formula Aqui
            }else{
                console.log("2");
                $("#num_huevos_viables").val($( "#num_huevos_total" ).val());
                $("#num_huevos_no_viables").val(0);
                $("#porcentaje_viabilidad").val(100);
            }
        }
    });
    $( "#num_huevos_no_viables" ).change(function() {
        var total=parseInt($( "#num_huevos_total" ).val());
        var noViables=parseInt($( "#num_huevos_no_viables" ).val());
        if($("#num_huevos_total").val()){
            if(total >= noViables){
                $( "#num_huevos_viables" ).val($( "#num_huevos_total" ).val()-$("#num_huevos_no_viables").val());
                $("#porcentaje_viabilidad").val((100-(noViables*100)/total));
            }else{
                $("#num_huevos_viables").val($( "#num_huevos_no_viables" ).val());
                $("#num_huevos_viables").val(0);
                $("#porcentaje_viabilidad").val(0);
            }
        }
    });
    $( "#diametro_huevo" ).change(function() {
        var diaHuevo=parseInt($( "#diametro_huevo" ).val());
        if(diaHuevo<0){
            $( "#diametro_huevo" ).val(null);
        }
    });
    $( "#diametro_gota" ).change(function() {
        var diaHuevo=parseInt($( "#diametro_gota" ).val());
        if(diaHuevo<0){
            $( "#diametro_gota" ).val(null);
        }
    });
</script>
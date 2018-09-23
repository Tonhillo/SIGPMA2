@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-formhelpers.js') }}"></script>

    {{--<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>--}}
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />--}}

    <section class="content-header">
        <form method="POST" action="/charts">

            <div class="col-md-12" style="paddin-top:10px;">
                <!-- AREA CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="text-center">
                            <input type="hidden" name="idEstanque" value="{{ $idEstanque }}">
                            {!! Form::label('id_estanque', 'Estanque:') !!}
                            <h3 class="box-title"><input type="number" step="any"  name="numeroEstanque" value="{{$numeroEstanque}}" class="form-control" readonly/></h3>
                        </div>



                    </div>

                    <div class="box-body">
                        <div class="text-center">
                            {{-- <!— Fecha  —> --}}
                            <div class="form-group col-sm-6">
                                {!! Form::label('fecha', 'Fecha Inicial:') !!}

                                <div class="bfh-datepicker" data-name="fechaInicial" data-format="y-m-d" data-max="today"></div>
                            </div>



                             <!— Fecha  —>
                            <div class="form-group col-sm-6">
                                {!! Form::label('fecha', 'Fecha de final:') !!}

                                <div class="bfh-datepicker" data-name="fechaFinal" data-format  ="y-m-d" data-max="today"></div>
                            </div>
                            {{--<div class="input-group bfh-datepicker-toggle">--}}
                                {{--<span class="input-group-addon">--}}
                                    {{--<i class="glyphicon glyphicon-calendar"></i></span>--}}
                                {{--<input type="text" name="dates" class="form-control" placeholder="" readonly="">--}}
                            {{--</div>--}}
                            {{--<div class="text-center" id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">--}}
                                {{--<span class="input-group-addon" style="width: 1%"><i class="glyphicon glyphicon-calendar"></i></span><input class="form-control" style="border: none;" type="text" name="dates" value="" />--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-sm-12" id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">--}}
                                {{--<input type="text" name="dates" value="" />--}}
                            {{--</div>--}}


                            {{--<script>--}}
                                {{--$('input[name="dates"]').daterangepicker({--}}
                                    {{--startDate: moment().format,--}}
                                    {{--endDate: moment(),--}}
                                    {{--"opens": "center",--}}
                                    {{--"maxSpan": {--}}
                                        {{--"days": 30--}}
                                    {{--}--}}
                                {{--});--}}
                            {{--</script>--}}
                        </div>
                        <hr>
                        <div class="text-center">
                            {{--<a class="btn btn-success" href="estanques/grafico/{{}}/fechaInicio/{{}}/fechaFinal/{{}}" ><i class="glyphicon glyphicon-ok"></i> Aceptar</a>--}}
                            {{--<a class="btn btn-success" href="" ><i class="glyphicon glyphicon-ok"></i> Aceptar</a>--}}
                            <button type="submit" class="btn btn-success btn-social"><i class="fa fa-gears"></i> Generar Gráficos.</button>
                        </div>
                    </div>

                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- DONUT CHART -->
            </div>
        </form>
    </section>



@endsection
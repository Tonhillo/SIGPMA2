@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:700,900|Fira+Sans:400,400italic' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="{{ asset('js/Chart.js') }}"></script>
    <link rel="stylesheet" src="{{ asset('css/reset.css') }}"> <!-- CSS reset -->


    <section class="content-header">
            <div class="row" style="paddin-top:10px;">
                <!-- AREA CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <script type="text/javascript">
                            // var alimentacion = <?php //echo json_encode($arrayAlimentacion['datos_alimentacion']) ?>;
                            // var fechas_alimentacion = <?php //echo json_encode($arrayAlimentacion['fechas_alimentacion']) ?>;

                            var temperaturas = <?php echo json_encode($arrayTemperaturas['datos_temperaturas']) ?>;
                            var fechas_temperaturas = <?php echo json_encode($arrayTemperaturas['fechas_temperaturas']) ?>;

                            var ph = <?php echo json_encode($arrayPh['datos_ph']) ?>;
                            var fechas_ph = <?php echo json_encode($arrayPh['fechas_ph']) ?>;

                            var nitritos = <?php echo json_encode($arrayNitritos['datos_nitritos']) ?>;
                            var fechas_nitritos = <?php echo json_encode($arrayNitritos['fechas_nitritos']) ?>;

                            var nitratos = <?php echo json_encode($arrayNitratos['datos_nitratos']) ?>;
                            var fechas_nitratos = <?php echo json_encode($arrayNitratos['fechas_nitratos']) ?>;

                            var salinidad = <?php echo json_encode($arraySalinidad['datos_salinidad']) ?>;
                            var fechas_salinidad = <?php echo json_encode($arraySalinidad['fechas_salinidad']) ?>;

                            var amonio = <?php echo json_encode($arrayAmonio['datos_amonio']) ?>;
                            var fechas_amonio = <?php echo json_encode($arrayAmonio['fechas_amonio']) ?>;

                            var oxigeno = <?php echo json_encode($arrayOxigeno['datos_oxigeno']) ?>;
                            var fechas_oxigeno = <?php echo json_encode($arrayOxigeno['fechas_oxigeno']) ?>;

                            var mortalidades = <?php echo json_encode($arrayMortalidad['datos_mortalidad']) ?>;
                            var fechas_mortalidades = <?php echo json_encode($arrayMortalidad['fechas_mortalidad']) ?>;

                            // Variables para los desobes
                            var desoves_totales = <?php echo json_encode($desoves['total'])?>;
                            var desoves_viables = <?php echo json_encode($desoves['viables']) ?>;
                            var desoves_no_viables = <?php echo json_encode($desoves['no_viables']) ?>;
                            var desoves_porcentaje_viabilidad= <?php echo json_encode($desoves['porcentaje_viabilidad']) ?>;
                            var desoves_diametro_huevo = <?php echo json_encode($desoves['diam_huevo']) ?>;
                            var desoves_diametro_gota = <?php echo json_encode($desoves['diam_gota']) ?>;
                            var desoves_fechas= <?php echo json_encode($desoves['fechas']) ?>;
                        </script>


                        <div class="col-md-12">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-blue" >
                                    {{--style="background: url('{{ asset('img/puntarenas.jpg') }}');"--}}
                                    <h3 class="widget-user-username">Estanque N°{{$estanque -> num_estanque}}</h3>
                                    <h5 class="widget-user-desc">SIGPMA-GRÁFICOS.</h5>
                                </div>

                                <div class="widget-user-image">

                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">Volumen</h5>
                                                <span class="description-text">{{$estanque -> volumen}} Litros</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">Agua</h5>
                                                <span class="description-text">{{$estanque -> tipo_agua}}</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header">Gráficos desde</h5>
                                                <span class="description-text">{{$fechaInicio}}</span>
                                                <h5 class="description-header">Hasta</h5>
                                                <span class="description-text">{{$fechaFinal}}</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#graOne" data-toggle="tab" aria-expanded="true">Físico-Químicos</a></li>
                        @if(Auth::user()->id_recinto==2)
                          <li class=""><a href="#graTwo" data-toggle="tab" aria-expanded="false">Desoves</a></li>
                        @else
                          <li class=""><a href="#graTwo" data-toggle="tab" aria-expanded="false">Defunciones</a></li>
                        @endif

                        <li class=""><a href="#alimentacion" data-toggle="tab" aria-expanded="false">Alimentación</a></li>
                        <li class=""><a href="#observaciones" data-toggle="tab" aria-expanded="false">Observaciones</a></li>
                    </ul>

                    <!-- PANELES PARA LOS GRAFICOS, EN FORMA DE PESTAÑAS -->
                    <div class="tab-content">

                        <!-- PESTAÑA PATA LAS VARIABLES FISICO-QUIMICAS -->
                        <div class="tab-pane active" id="graOne">
                                <!-- CAJA DONDE SE COLOCAN LOS 7 GRAFICOS DE LAS VARIABLES FISICO QUIMICAS -->
                                <div class="row">

                                    <!-- CAJA CON LOS GRAFICOS A LA IZQUIERDA -->
                                    <div class="col-md-6">

                                        <!-- LINE CHART PARA LAS TEMPERATURAS-->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Temperaturas</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                    </button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="descargarPNG(this,'graficoTemperatura',getFechaString())">Transparente</a></li>
                                                            <li><a href="#" onclick="descargarJPG(this,'graficoTemperatura',getFechaString())">Fondo Blanco</a></li>
                                                        </ul>
                                                    </div>
                                                    {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="chart">
                                                    <canvas id="graficoTemperatura" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->

                                        <!-- LINE CHART PARA EL Salinidad-->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Salinidad</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                    </button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="descargarPNG(this,'graficoSalinidad',getFechaString())">Transparente</a></li>
                                                            <li><a href="#" onclick="descargarJPG(this,'graficoSalinidad',getFechaString())">Fondo Blanco</a></li>
                                                        </ul>
                                                    </div>
                                                    {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="chart">
                                                    <canvas id="graficoSalinidad" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->

                                        <!-- LINE CHART PARA EL Oxigeno-->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Oxígeno</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                    </button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="descargarPNG(this,'graficoOxigeno',getFechaString())">Transparente</a></li>
                                                            <li><a href="#" onclick="descargarJPG(this,'graficoOxigeno',getFechaString())">Fondo Blanco</a></li>
                                                        </ul>
                                                    </div>
                                                    {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="chart">
                                                    <canvas id="graficoOxigeno" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->

                                        <!-- LINE CHART PARA EL PH-->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">pH</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                    </button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="descargarPNG(this,'graficoPh',getFechaString())">Transparente</a></li>
                                                            <li><a href="#" onclick="descargarJPG(this,'graficoPh',getFechaString())">Fondo Blanco</a></li>
                                                        </ul>
                                                    </div>
                                                    {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="chart">
                                                    <canvas id="graficoPh" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                         <!-- /.box -->
                                    </div>
                                    <!-- /.col (LEFT) -->

                                    <!-- CAJA CON LOS GRAFICOS A LA DERECHA -->
                                    <div class="col-md-6">
                                        <!-- LINE CHART PARA EL Amonio-->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Amonio</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                    </button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="descargarPNG(this,'graficoAmonio',getFechaString())">Transparente</a></li>
                                                            <li><a href="#" onclick="descargarJPG(this,'graficoAmonio',getFechaString())">Fondo Blanco</a></li>
                                                        </ul>
                                                    </div>
                                                    {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="chart">
                                                    <canvas id="graficoAmonio" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->

                                        <!-- LINE CHART Nitritos -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Nitritos</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                    </button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="descargarPNG(this,'graficoNitritos',getFechaString())">Transparente</a></li>
                                                            <li><a href="#" onclick="descargarJPG(this,'graficoNitritos',getFechaString())">Fondo Blanco</a></li>
                                                        </ul>
                                                    </div>
                                                    {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="chart">
                                                    <canvas id="graficoNitritos" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->

                                        <!-- LINE CHART Nitratos-->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Nitratos</h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                    </button>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="descargarPNG(this,'graficoNitratos',getFechaString())">Transparente</a></li>
                                                            <li><a href="#" onclick="descargarJPG(this,'graficoNitratos',getFechaString())">Fondo Blanco</a></li>
                                                        </ul>
                                                    </div>
                                                    {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="chart">
                                                    <canvas id="graficoNitratos" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    <!-- /.col (RIGHT) -->
                                </div>
                                <!-- aca cierra la caja para los graficos -->
                        </div>
                        <!-- /.tab-pane -->

                        <!-- PESTAÑA PARA LOS DESOVES -->
                        <div class="tab-pane" id="graTwo">
                          @if(Auth::user()->id_recinto==1)
                            <div class="row">


                            <div class="col-md-6">
                              <div class="box box-info">
                                  <div class="box-header with-border">
                                      <h3 class="box-title">Mortalidad</h3>

                                      <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                          </button>
                                          <div class="btn-group">
                                              <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                  <span class="caret"></span>
                                                  <span class="sr-only">Toggle Dropdown</span>
                                              </button>
                                              <ul class="dropdown-menu" role="menu">
                                                  <li><a href="#" onclick="descargarPNG(this,'graficoTemperatura',getFechaString())">Transparente</a></li>
                                                  <li><a href="#" onclick="descargarJPG(this,'graficoTemperatura',getFechaString())">Fondo Blanco</a></li>
                                              </ul>
                                          </div>
                                          {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                          {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                      </div>
                                  </div>
                                  <div class="box-body">
                                      <div class="chart">
                                          <canvas id="graficoMortalidad" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                      </div>
                                  </div>
                                  <!-- /.box-body -->
                              </div>
                            </div>
                            </div>
                          @else
                            <!-- CAJA DONDE SE COLOCAN LOS GRAFICOS DE LOS DESOVES -->
                            <div class="row">
                                <!-- CAJA CON LOS GRAFICOS A LA IZQUIERDA -->
                                <div class="col-md-6">
                                    <!-- BAR CHART PARA LOS HUEVOS TOTALES -->
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Huevos totales</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                </button>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" onclick="descargarPNG(this,'graficoHuevosTotales',getFechaString())">PNG</a></li>
                                                        <li><a href="#" onclick="descargarJPG(this,'graficoHuevosTotales',getFechaString())">JPG</a></li>
                                                    </ul>
                                                </div>
                                                {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="chart">
                                                <canvas id="graficoHuevosTotales" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                                    <!-- BAR CHART PARA LOS HUEVOS VIABLES -->
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Huevos viables</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                </button>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" onclick="descargarPNG(this,'graficoHuevosViables',getFechaString())">PNG</a></li>
                                                        <li><a href="#" onclick="descargarJPG(this,'graficoHuevosViables',getFechaString())">JPG</a></li>
                                                    </ul>
                                                </div>
                                                {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="chart">
                                                <canvas id="graficoHuevosViables" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                                    <!-- BAR CHART PARA LOS HUEVOS NO VIABLES -->
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Huevos no viables</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                </button>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" onclick="descargarPNG(this,'graficoHuevosNoViables',getFechaString())">PNG</a></li>
                                                        <li><a href="#" onclick="descargarJPG(this,'graficoHuevosNoViables',getFechaString())">JPG</a></li>
                                                    </ul>
                                                </div>
                                                {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="chart">
                                                <canvas id="graficoHuevosNoViables" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>

                                <!-- CAJA CON LOS GRAFICOS A LA DERECHA -->
                                <div class="col-md-6">
                                    <!-- BAR CHART PARA LOS PORCENTAJES DE VIABILIDAD -->
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Porcentaje de viabilidad</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                </button>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" onclick="descargarPNG(this,'graficoPorcViabilidad',getFechaString())">PNG</a></li>
                                                        <li><a href="#" onclick="descargarJPG(this,'graficoPorcViabilidad',getFechaString())">JPG</a></li>
                                                    </ul>
                                                </div>
                                                {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="chart">
                                                <canvas id="graficoPorcViabilidad" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                                    <!-- BAR CHART PARA LOS DIAMETROS DEL HUEVO -->
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Diametro del huevo</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                </button>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" onclick="descargarPNG(this,'graficoDiametroHuevo',getFechaString())">PNG</a></li>
                                                        <li><a href="#" onclick="descargarJPG(this,'graficoDiametroHuevo',getFechaString())">JPG</a></li>
                                                    </ul>
                                                </div>
                                                {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="chart">
                                                <canvas id="graficoDiametroHuevo" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                                    <!-- BAR CHART PARA LOS DIAMETROS DE LA GOTA -->
                                    <div class="box box-info">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Diametros de gota</h3>

                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                                </button>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" onclick="descargarPNG(this,'graficoDiametroGota',getFechaString())">PNG</a></li>
                                                        <li><a href="#" onclick="descargarJPG(this,'graficoDiametroGota',getFechaString())">JPG</a></li>
                                                    </ul>
                                                </div>
                                                {{--<a id="descargaJPG" class="btn btn-success"><i class="fa fa-download"></i> Descargar</a>--}}
                                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="chart">
                                                <canvas id="graficoDiametroGota" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                          @endif
                        </div>
                        <!-- /.tab-pane -->

                        <!-- PESTAÑA PARA LAS OBSERVACIONES -->
                        <div class="tab-pane" id="observaciones" style="min-height: 400px;">
                                <div class="row" style="padding-left: 15px; padding-right: 15px; padding-top: 15px;">
                                    @foreach($observaciones as $observacion)
                                        <div class="col-md-3">
                                            <div class="box box-default collapsed-box">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">{{$observacion->fecha->format('d/m/Y')}}</h3>

                                                    <div class="box-tools pull-right">
                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <!-- /.box-tools -->
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body" style="display: none;">
                                                    {{$observacion->descripcion}}
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>

                                    @endforeach

                                </div>

                        </div>
                        {{-- <div class="tab-pane" id="alimentacion" style="min-height: 400px;">
                          <div class="row">


                          <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Alimentación</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" title='Minimizar'></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info no-click btn-social"><i class="fa fa-download"></i>Descarga</button>
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#" onclick="descargarPNG(this,'graficoAlimentacion',getFechaString())">Transparente</a></li>
                                                <li><a href="#" onclick="descargarJPG(this,'graficoAlimentacion',getFechaString())">Fondo Blanco</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                        <canvas id="graficoAlimentacion" style="height: 300px; width: 613px;" width="613" height="300"></canvas>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                          </div>
                          </div>
                        </div> --}}
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>

    </section>


    <script type="text/javascript" src="{{ asset('js/chartGenerator.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chartDescarga.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script> <!-- Resource jQuery -->

@endsection

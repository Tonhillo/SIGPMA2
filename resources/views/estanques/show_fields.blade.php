<!-- Id Field -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('id', 'Id:') !!}--}}
    {{--<p>{!! $estanque->id !!}</p>--}}
{{--</div>--}}
<div class="row" style="paddin-top:10px;">
    <!-- AREA CHART -->
        <div class="box-header with-border">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">



            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-blue">
                        <h3 class="widget-user-username">Estanque N°{{$estanque -> num_estanque}}</h3>
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
                                    <h5 class="description-header">Fecha Creación</h5>
                                    <span class="description-text">{{$estanque->created_at}}</span>
                                    <h5 class="description-header">Actualizado en</h5>
                                    <span class="description-text">{{$estanque->updated_at}}</span>
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
</div>
<!-- Num Estanque Field -->



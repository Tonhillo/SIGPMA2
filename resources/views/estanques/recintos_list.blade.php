<section class="content">
  <div class="row">
    <div class="col-md-6">
      <!-- AREA CHART -->
        @foreach($recinto as $recinto)
    <a href="{!! route('fisicoQuimicos.list', [ 'id' => $recinto->id]) !!}">
      <div class="box box-primary" >
        <div class="box-header with-border">
          <h3 class="box-title">{!! $recinto->nombre !!}</h3>

          <div class="box-tools pull-right">


          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            //CONTENT
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      @endforeach
      <!-- /.box -->

      <!-- DONUT CHART -->


    </div>
  </div>
</section>

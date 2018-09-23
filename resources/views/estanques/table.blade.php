<section class="content">
  <div class="row">
@foreach($estanques as $estanque)
    <div class="col-md-6">
      <!-- AREA CHART -->
      <div class="box box-primary" >
        <div class="box-header with-border">

          <h3 class="box-title">Número estanque: {!! $estanque->num_estanque !!}</h3>
            {{--<div class="col-md-6">--}}
                {{--<button type="button" class="btn btn-default btn-block no-click ">Número estanque: {!! $estanque->num_estanque !!}</button>--}}
            {{--</div>--}}

          <div class="box-tools pull-right">
            {!! Form::open(['route' => ['estanques.destroy', $estanque->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{!! route('estanques.show', [$estanque->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>

                @if (Auth::user()->hasRole('Administrador'))
                    <a href="{!! route('estanques.edit', [$estanque->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','onclick' => "return confirm('¿Está seguro de querer eliminar?')", 'data-toggle' => 'modal', 'data-target' => '#modal-danger']) !!}
                @endif
                <button type="button" class="btn btn-info btn-xs" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

                </div>
            {!! Form::close() !!}

          </div>
        </div>
          <div class="box-body">
              <div class="col-md-12">

                  <img class="card-img-top" data-src="img/estanquesFondo.png" alt="Image cap [100%x180]" style="height: 100%; width: 100%; display: block;" src="img/estanquesFondo.png" data-holder-rendered="true">
              </div>
          </div>
        <div class="box-body">

          <div class="btn-group col-md-12">
              @if (Auth::user()->id_recinto!=1)

              <a href="/estanques/desove/{{$estanque->id}}" class="btn btn-info btn-social btn-primary btn-xs col-md-6">
                  <i class="fa fa-plus-square"></i> Desove
              </a>
              <a href="estanques/familias/{{$estanque->id}}" class="btn btn-info btn-social btn-primary btn-xs col-md-6">
                  <i class="fa fa-venus-mars"></i> Familias
              </a>
              <a href="/estanques/fisico_quimicos/{{$estanque->id}}" class="btn btn-info btn-social btn-primary btn-xs col-md-6">
                  <i class="fa fa-eyedropper"></i> Físico-Químico
              </a>
              <a href="estanqueEspecies/alimentacion/{{$estanque->id}}" class="btn btn-info btn-social btn-primary btn-xs col-md-6">
                  <i class="fa fa-spoon"></i> Alimentación del estanque
              </a>
                 @if (Auth::user()->hasRole('Administrador'))
                  <a href="estanques/grafico/{{$estanque->id}}" style="text-align: center" class="btn btn-info btn-social btn-primary btn-xs col-md-12">
                      <i class="fa fa-area-chart"></i> Gráficos
                  </a>

                 @endif
              @else
                  <a href="estanqueEspecies/estanque/{{$estanque->id}}" class="btn btn-info btn-social btn-primary btn-xs col-md-6">
                      <i class="fa fa-plus-square"></i> Especies en el estanque
                  </a>
                  <a href="estanqueEspecies/alimentacion/{{$estanque->id}}" class="btn btn-info btn-social btn-primary btn-xs col-md-6">
                      <i class="fa fa-spoon"></i> Alimentación del estanque
                  </a>
                  <a href="/estanques/fisico_quimicos/{{$estanque->id}}" class="btn btn-info btn-social btn-primary btn-xs col-md-6">
                      <i class="fa fa-eyedropper"></i> Físico-Químico
                  </a>
                  @if (Auth::user()->hasRole('Administrador'))
                      <a href="estanques/grafico/{{$estanque->id}}" class="btn btn-info btn-social btn-primary btn-xs col-md-6">
                          <i class="fa fa-area-chart"></i> Gráficos
                      </a>

                  @endif
              @endif

          </div>
        </div>

        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- DONUT CHART -->
    </div>
    @endforeach
  </div>
</section>

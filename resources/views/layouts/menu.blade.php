<ul class="sidebar-menu" data-widget="tree">
  <li class="header">NAVEGACIÓN PRINCIPAL</li>
    @if (Auth::user()->hasRole('Administrador'))
        <li class="{{ Request::is('recintos*') ? 'active' : '' }}">
            <a href="{!! route('recintos.index') !!}"><i class="fa fa-university"></i><span>Recintos</span></a>
        </li>

        <li class="{{ Request::is('Usuarios*') ? 'active' : '' }}">
            <a href="/usuarios"><i class="fa fa-users"></i><span>Usuarios</span></a>
        </li>



    @endif
    <li class="{{ Request::is('estanques*') ? 'active' : '' }}">
        <a href="{!! route('estanques.index') !!}"><i class="fa fa fa-bitbucket"></i><span>Estanques</span></a>
    </li>
    <li class="{{ Request::is('especies*') ? 'active' : '' }}">
        <a href="{!! route('especies.index') !!}"><i class="fa fa-edit"></i><span>Especies</span></a>
    </li>

        <li class="{{ Request::is('alimentos*') ? 'active' : '' }}">
            <a href="{!! route('alimentos.index') !!}"><i class="fa fa-spoon"></i><span>Alimentos</span></a>
        </li>

  <li class="treeview">
  <a href="#">
  <i class="fa  fa-list"></i> <span>Gestión de datos</span>
  <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span>
  </a>
  <ul class="treeview-menu">
  <!--Menu Peces  -->
      <li class="{{ Request::is('temperaturas*') ? 'active' : '' }}">
          <a href="{!! route('temperaturas.index') !!}"><i class="fa fa-edit"></i><span>Temperaturas</span></a>
      </li>
      <li class="{{ Request::is('pHs*') ? 'active' : '' }}">
          <a href="{!! route('pHs.index') !!}"><i class="fa fa-edit"></i><span>pH</span></a>
      </li>
      <li class="{{ Request::is('nitritos*') ? 'active' : '' }}">
          <a href="{!! route('nitritos.index') !!}"><i class="fa fa-edit"></i><span>Nitritos</span></a>
      </li>
      <li class="{{ Request::is('salinidads*') ? 'active' : '' }}">
      <a href="{!! route('salinidads.index') !!}"><i class="fa fa-edit"></i><span>Salinidades</span></a>
      </li>
      <li class="{{ Request::is('nitratos*') ? 'active' : '' }}">
      <a href="{!! route('nitratos.index') !!}"><i class="fa fa-edit"></i><span>Nitratos</span></a>
      </li>
      <li class="{{ Request::is('amonios*') ? 'active' : '' }}">
      <a href="{!! route('amonios.index') !!}"><i class="fa fa-edit"></i><span>Amonios</span></a>
      </li>
      <li class="{{ Request::is('oxigenos*') ? 'active' : '' }}">
          <a href="{!! route('oxigenos.index') !!}"><i class="fa fa-edit"></i><span>Oxigeno</span></a>
      </li>
      @if(Auth::user()->id_recinto==2)
<li class="{{ Request::is('desobes*') ? 'active' : '' }}">
    <a href="{!! route('desobes.index') !!}"><i class="fa fa-edit"></i><span>Desoves</span></a>
</li>
@endif

      @if(Auth::user()->id_recinto==1)
          <li class="{{ Request::is('estanqueAlimentacions*') ? 'active' : '' }}">
              <a href="{!! route('estanqueAlimentacions.index') !!}"><i class="fa fa-edit"></i><span>Alimentaciones</span></a>
          </li>
      @endif
      {{--<li class="{{ Request::is('observacionEspecies*') ? 'active' : '' }}">--}}
      {{--<a href="{!! route('observacionEspecies.index') !!}"><i class="fa fa-edit"></i><span>Observacion Especies</span></a>--}}
      {{--</li>--}}
  </ul>
  </li>
    {{--
    <li class="{{ Request::is('estanqueEspecies*') ? 'active' : '' }}">
        <a href="{!! route('estanqueEspecies.index') !!}"><i class="fa fa-edit"></i><span>Estanque Especies</span></a>
    </li>
<li class="{{ Request::is('fisicoQuimicos*') ? 'active' : '' }}">
            <a href="{!! route('fisicoQuimicos.index') !!}"><i class="fa fa-area-chart"></i><span>Fisico Quimicos</span></a>
        </li>
  <!--Gestion Recintos  -->
  <li class="treeview">
  <a href="#">
    <i class="fa fa-building-o"></i> <span>Gestión Recintos</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="{{ Request::is('recintos*') ? 'active' : '' }}">
        <a href="{!! route('recintos.index') !!}"><i class="fa fa-edit"></i><span>Recintos</span></a>
    </li>
  </ul>
</li>

<li class="{{ Request::is('estanques*') ? 'active' : '' }}">
    <a href="{!! route('estanques.index') !!}"><i class="fa fa fa-bitbucket"></i><span>Estanques</span></a>
</li>
<!--Gestion Peceras  -->
<li class="treeview">
  <a href="#">
    <i class="fa fa fa-bitbucket"></i> <span>Gestión Estanques</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="{{ Request::is('estanques*') ? 'active' : '' }}">
        <a href="{!! route('estanques.index') !!}"><i class="fa fa-edit"></i><span>Estanques</span></a>
    </li>

    <li class="{{ Request::is('desobes*') ? 'active' : '' }}">
        <a href="{!! route('desobes.index') !!}"><i class="fa fa-edit"></i><span>Desobes</span></a>
    </li>

    --}}

    {{--
        <li class="{{ Request::is('estanqueAlimentacions*') ? 'active' : '' }}">
            <a href="{!! route('estanqueAlimentacions.index') !!}"><i class="fa fa-edit"></i><span>Estanque Alimentacions</span></a>
        </li>

        <li class="{{ Request::is('estanqueFamilias*') ? 'active' : '' }}">
            <a href="{!! route('estanqueFamilias.index') !!}"><i class="fa fa-edit"></i><span>Estanque Familias</span></a>
        </li>



        <li class="{{ Request::is('estanqueDesobes*') ? 'active' : '' }}">
            <a href="{!! route('estanqueDesobes.index') !!}"><i class="fa fa-edit"></i><span>Estanque Desobes</span></a>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-bar-chart"></i> Estadisticas
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa  fa-pie-chart"></i> Estadisticas Categoria</a></li>
            <li><a href="#"><i class="fa  fa-pie-chart"></i> Estadisticas Categoria</a></li>
          </ul>
        </li>
        <li><a href="#"><i class="fa fa-circle-o"></i> Item</a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i> Item</a></li>
      </ul>
    </li>
    <!-- Gestion Peceras fin  --> --}}

</ul>
{{--<li class="{{ Request::is('$temperaturas*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('$temperaturas.index') !!}"><i class="fa fa-edit"></i><span>$Temperaturas</span></a>--}}
{{--</li>--}}





{{--<li class="{{ Request::is('nitratos*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('nitratos.index') !!}"><i class="fa fa-edit"></i><span>Nitratos</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('salinidads*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('salinidads.index') !!}"><i class="fa fa-edit"></i><span>Salinidads</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('amonios*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('amonios.index') !!}"><i class="fa fa-edit"></i><span>Amonios</span></a>--}}
{{--</li>--}}

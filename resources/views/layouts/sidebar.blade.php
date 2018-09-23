<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/userDefault.png') }}" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                @if (Auth::guest())
                <p>SIGPMA</p>
                @else
                    <p>{{ Auth::user()->name}}</p>
                @endif
                <!-- Status -->
                <a href="#"><i class="fa fa-key"></i> {!! Auth::user()->getRoleNames()[0]!!}</a>
            </div>
        </div>

        <!-- MENU  -->
          @include('layouts.menu')

        
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

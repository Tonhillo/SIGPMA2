<div class="register-box">
    <div class="register-logo">
        <a><b>SIGPMA</b></a>
    </div>

    <div class="register-box-body">

        <form action="../../index.html" method="post">
            @if(empty($user))
                <div class="form-group has-feedback">
                    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Email']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
            @else
                <div class="form-group has-feedback">
                    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
            @endif
            <div class="form-group has-feedback">
                {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Nombre Completo']) !!}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
                {{--<div class="form-group has-feedback">--}}
                    {{--{!! Form::select('role', $roles) !!}--}}
                    {{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
                {{--</div>--}}
                <div class="form-group has-feedback input-group date col-md-12">
                    <div class="input-group-addon">
                        {!! Form::select('role', $roles, ['class' => 'form-control']) !!}
                        <i class="fa fa-key"></i>
                    </div>

                </div>




            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Guardar</button>
                </div>
                <div class="col-xs-4">
                    <a href="{!! route('usuarios.index') !!}" class="btn btn-default">Cancel</a>
                </div>
                <!-- /.col -->
            </div>
        </form>
    <!-- /.form-box -->
    </div>
</div>
{{--<div class="form-group col-md-12">--}}
  {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    {{--{!! Form::label('name', 'Nombre Completo:') !!}--}}
    {{--{!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => '100']) !!}--}}
{{--</div>--}}

{{--@if(empty($user))--}}
{{--<div class="form-group col-md-12">--}}
    {{--{!! Form::label('email', 'Email:') !!}--}}
    {{--{!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => '100']) !!}--}}
{{--</div>--}}
{{--@endif--}}
{{--<div class="form-group col-md-12">--}}
    {{--{!! Form::label('password', 'Password:') !!}--}}
    {{--{!! Form::password('password', null, ['class' => 'form-control', 'maxlength' => '20']) !!}--}}
{{--</div>--}}

{{--<div class="form-group col-md-12">--}}
    {{--{!! Form::label('role', 'Role:') !!}--}}
    {{--{!! Form::select('role', $roles) !!}--}}
{{--</div>--}}

{{--<div class="form-group col-md-12">--}}
    {{--{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}--}}
    {{--<a href="{!! route('usuarios.index') !!}" class="btn btn-default">Cancel</a>--}}
{{--</div>--}}

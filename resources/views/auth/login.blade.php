@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{trans('auth.login_title')}}</h3></div>
                <div class="panel-body">
                    @include('partials/errors')
                    @include('partials/succes')
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <!--<label class="col-md-4 control-label">{{ trans('validation.attributes.email') }}</label>-->
                            <label class="col-md-4 control-label">{{ trans('validation.attributes.username') }}</label>
                            <div class="col-md-6">
                                <!--<input type="email" name="email" value="{{ old('email') }}" class="form-control">-->
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('validation.attributes.password') }}</label>
                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> @lang('auth.remember_login')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                    @lang('auth.login_action')
                                </button>

                                <a href="/password/email">@lang('auth.forgot_link')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
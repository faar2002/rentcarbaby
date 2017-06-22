@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('auth.change_password')}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('account/password') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="form-group">
                           <label class="col-md-4 control-label">@lang('validation.attributes.current_password')</label>
                           <div class="col-md-6">
                               <input type="password" name="current_password">
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('validation.attributes.new_password')</label>
                            <div class="col-md-6">
                                <input type="password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('validation.attributes.confirm_password')</label>
                            <div class="col-md-6">
                                <input type="password" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.change_password_button')
                                </button>
                                <a id="regresar" name="regresar" class="btn btn-danger" href="{{ url('account') }}">@lang('auth.return_button')</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
            </div>
    </div>
</div>
@endsection
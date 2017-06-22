@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('auth.edit_profile')</div>
                <div class="panel-body">
                    @include('partials/errors')
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('account/edit-profile') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('validation.attributes.name')</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('validation.attributes.username')</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" readonly="true" value="{{ old('username', $user->username) }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('validation.attributes.email')</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" readonly="true" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Rol</label>
                            <div class="col-md-6">
                                <select name="role">
                                    <option selected> ---</option>
                                    <option value="user">Usuario</option>
                                    <option value="supevisor">Supervisor</option>
                                    <option value="admin">Administrador</option>
                                    <option value="superadmin">Super Admin</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                       <input type="checkbox" name="active" value="{{ old('active', $user->active) }}">@lang('validation.attributes.user_active')
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.update_button')
                                </button>
                                <a id="regresar" name="regresar" class="btn btn-danger" href="{{ url('account/list-user') }}">Regresar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('auth.my_account')}}</div>

                <div class="panel-body">
                    @include('partials/succes')
                    <ul>
                        <!--<li><a href="{{ url('account/edit-profile') }}">@lang('auth.edit_profile')</a></li>-->
                        <li><a href="{{ url('account/edit-profile') }}">Edit profile</a></li>
                        <li><a href="{{ url('account/password') }}">@lang('auth.change_password')</a></li>
                        @if (Auth::check() && Access::check(Auth::user()->role,'superadmin'))
                            <li><a href="{{ url('account/list-user') }}">@lang('auth.list_user')</a></li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
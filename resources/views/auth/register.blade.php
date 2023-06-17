@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                Sisfo MBKM Politeknik TEDC Bandung
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ trans('global.register') }}</p>
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required placeholder="Username" value="{{ old('username', null) }}">
                        @if($errors->has('username'))
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('global.register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('auth.master')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please Sign In</h3>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" action="/auth/login" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group">
                            <label>Email address</label>
                            <input class="form-control" placeholder="Email address" name="email" type="email" value="{{ old('email') }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" placeholder="Password" name="password" type="password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <button type="submit" id="loadingButton" data-loading-text="Logging  in..." class="btn btn-primary" autocomplete="off">
                            Login to account
                        </button>
                    </fieldset>
                </form>
                <hr>

                Not yet registered? <a href="/auth/register">Click here</a>
            </div>
        </div>
    </div>
</div>
@stop
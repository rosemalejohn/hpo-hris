@extends('auth.master')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create new account</h3>
            </div>
            <div class="panel-body">
                <form role="form" action="/auth/register" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" placeholder="ex. John Smith" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" placeholder="ex. john_smith@example.com" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" placeholder="Create password" name="password">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Re-type your password" name="password_confirmation">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-default">Create account</button>
                    <span class="pull-right"> or <a href="/auth/login">Login to your account</a></span>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

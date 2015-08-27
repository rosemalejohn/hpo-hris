@extends('auth.master')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create new account</h3>
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
                <form role="form" action="/auth/register" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" placeholder="ex. Rosemale-John II C. Villacorta" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" placeholder="ex. rosemalejohn" name="username" value="{{ old('username') }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="ex. rosemalejohn@gmail.com" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" placeholder="Create password" name="password">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Re-type your password" name="password_confirmation">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcXgAsTAAAAAICAHP0Dy7l4OzpeHbiefBGairZ7"></div>
                    <hr>
                    <button type="submit" class="btn btn-default">Create account</button>
                    <span class="pull-right"> or <a href="/auth/login">Login to your account</a></span>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop

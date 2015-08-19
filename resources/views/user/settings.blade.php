@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-user"></i>
        Account Settings
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" action="/user/{{ $user->id }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="PUT"/>

                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Full name</label>
                        <input class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                    <hr>
                    <button type="submit" id="loadingButton" data-loading-text="Updating user..." class="btn btn-primary"><i class="fa fa-edit"></i> Update account</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
            <!-- /.col-lg-6 (nested) -->
        </div>
        <!-- /.row (nested) -->
    </div>
    <!-- /.panel-body -->
</div>

<div class="panel panel-danger">
    <div class="panel-heading">
        <i class="fa fa-warning"></i>
        Danger zone
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-8">
                <strong>Delete Account</strong>
                <p>You are going to delete your account. All your personal information will be taken out in the database. </p>
            </div>
            <div class="col-lg-4">
                <form method="POST" action="/user/{{ $user->id }}">
                    <input type="hidden" name="_method" value="DELETE"/>
                    {!! csrf_field() !!}
                    <button class="btn btn-danger btn-block">Delete account</button>
                </form>
            </div>
            <!-- /.col-lg-6 (nested) -->
        </div>
        <!-- /.row (nested) -->
    </div>
    <!-- /.panel-body -->
</div>
@stop

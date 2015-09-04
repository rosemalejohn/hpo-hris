<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">HPO Human Resource Information System</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> New Comment
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-alerts -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
			<li><a href="/user/my-account"><i class="fa fa-user fa-fw"></i> Logged in as <strong>{{ auth()->user()->username }}</strong></a>
            </li>
            <li><a href="/user/settings"><i class="fa fa-gear fa-fw"></i> Account Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Daily Time Record<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="" href="/dtr/import">Import from Facetime</a>
                    </li>
                    <li>
                        <a class="" href="/dtr">Employee DTR</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li class="">
                <a href="#"><i class="fa fa-users fa-fw"></i> Employee<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="" href="/employees">View all employee</a>
                    </li>
                    <li>
                        <a class="" href="/employees/create">Add new employee</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li class="">
                <a href="#"><i class="fa fa-building fa-fw"></i> Department<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="" href="/departments">View all departments</a>
                    </li>
                    <li>
                        <a class="" href="/departments/create">Add new department</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li class="">
                <a href="#"><i class="fa fa-clock-o fa-fw"></i> Shift<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="" href="/shifts">View all available shifts</a>
                    </li>
                    <li>
                        <a class="" href="/shifts/create">Add new shift</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li class="">
                <a href="#"><i class="fa fa-calendar fa-fw"></i> Holidays<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="" href="/holidays">View all listed holidays</a>
                    </li>
                    <li>
                        <a class="" href="/holidays/create">Add holidays</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->

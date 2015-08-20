<?php

Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', '/');
});

//DTR

Breadcrumbs::register('dtr', function($breadcrumbs)
{
    $breadcrumbs->push('Daily Time Record', '/dtr');
});

Breadcrumbs::register('dtr-import', function($breadcrumbs)
{
	$breadcrumbs->parent('dtr');
    $breadcrumbs->push('Import DTR', '/dtr/import');
});

//Employee breadcrumbs

Breadcrumbs::register('employees', function($breadcrumbs)
{
	$breadcrumbs->push('Employees', '/employees');
});

Breadcrumbs::register('employee', function($breadcrumbs, $employee)
{
    $breadcrumbs->parent('employees');
    $breadcrumbs->push($employee->first_name.' '.$employee->last_name, '/employees/'.$employee->employee_id);
});

Breadcrumbs::register('employee-create', function($breadcrumbs)
{
    $breadcrumbs->parent('employees');
    $breadcrumbs->push('Add new employee', '/employees/create');
});

Breadcrumbs::register('employee-edit', function($breadcrumbs, $employee)
{
    $breadcrumbs->parent('employee', $employee);
    $breadcrumbs->push('Update info', '/employees/'.$employee->employee_id.'/edit');
});

Breadcrumbs::register('employee-shift-edit', function($breadcrumbs, $employee_shift)
{
    $breadcrumbs->parent('employee', $employee_shift->employee);
    $breadcrumbs->push($employee_shift->shift->description, 'employees/shift/'.$employee_shift->id.'/edit');
});

//Departments breadcrumb

Breadcrumbs::register('departments', function($breadcrumbs)
{
	$breadcrumbs->push('HPO Departments', '/departments');
});

Breadcrumbs::register('department', function($breadcrumbs, $department)
{
	$breadcrumbs->parent('departments');
	$breadcrumbs->push($department->name, '/departments/'.$department->code);
});

Breadcrumbs::register('department-edit', function($breadcrumbs, $department)
{
	$breadcrumbs->parent('department', $department);
	$breadcrumbs->push('Update information', '/departments/'.$department->code.'/edit');
});

Breadcrumbs::register('department-create', function($breadcrumbs)
{
	$breadcrumbs->parent('departments');
	$breadcrumbs->push('New department', '/departments/create');
});

//Shifts breadcrumb

Breadcrumbs::register('shifts', function($breadcrumbs)
{
	$breadcrumbs->push('HPO Available Shift', '/shifts');
});

Breadcrumbs::register('shift', function($breadcrumbs, $shift)
{
	$breadcrumbs->parent('shifts');
	$breadcrumbs->push($shift->description, '/shift/'.$shift->id);
});

Breadcrumbs::register('shift-create', function($breadcrumbs)
{
	$breadcrumbs->parent('shifts');
	$breadcrumbs->push('Add new shift', '/shifts/create');
});

//User

Breadcrumbs::register('profile', function($breadcrumbs)
{
	$breadcrumbs->push(auth()->user()->name, '/user/my-account');
});

Breadcrumbs::register('settings', function($breadcrumbs, $user)
{
	$breadcrumbs->parent('profile');
	$breadcrumbs->push('Settings', '/user/my-account');
});
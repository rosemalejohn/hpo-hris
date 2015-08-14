<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Employee;
use Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page_title = 'Employees';
        return view('employee.all')->with(compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page_title = 'New employee';
        return view('employee.create')->with(compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if($this->validator($request->all())->fails()){
            flash()->error("Ooppss! You've got an error. Check the fields below.");
        } else{
            Employee::create($request->all());
            flash()->success("Employee successfully added!");
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($employee)
    {
        $employee = Employee::where('employee_id', $employee)->first();
        if(empty($employee)){
            flash()->error("Employee not found on database.");
            return redirect()->back();
        }
        $page_title = $employee->name;
        return view('employee.show')->with(compact('page_title', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $employee = Employee::where('employee_id', $id)->first();
        if(empty($employee)){
            flash()->error('Employee not found!');
            return redirect()->back();
        }
        $page_title = $employee->name.' - Edit';
        return view('employee.edit')->with(compact('page_title', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    protected function validator($data){
        return Validator::make($data, [
                'employee_id' => 'required',
                'name' => 'required|min:6|max:75',
                'department_id' => 'required'
            ]);
    }

    public function importEmployees(){
        $path = storage_path('files/employees.xls');

        Excel::selectSheets('Sheet1')->load($path, function($reader){
            $rows = $reader->all();

            foreach($rows as $row){

                Employee::create([
                    'employee_id' => $row->facetime,
                    'first_name' => $row->firstname,
                    'middle_name' => $row->middlename,
                    'last_name' => $row->lastname,
                    'department_id' => 1
                ]);

            }
        });
    }
}

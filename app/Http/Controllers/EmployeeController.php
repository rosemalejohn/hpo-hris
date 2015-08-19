<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Employee;
use Excel;
use App\EmployeeShift;
use App\EmployeeShiftDay;

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
        $page_title = $employee->first_name.' '.$employee->last_name;
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
        $page_title = $employee->first_name.' '.$employee->last_name.' - Edit';
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
        if($this->validator($request->all())->fails()){
            flash()->error('You have missing fields');
        }

        $employee = Employee::where('employee_id', $id)->first();
        if(empty($employee)){
            flash()->error('Employee not found!');
            return redirect()->to('/employees');
        }
        $employee->employee_id = $request->input('employee_id');
        $employee->first_name = $request->input('first_name');
        $employee->middle_name = $request->input('middle_name');
        $employee->last_name = $request->input('last_name');
        $employee->department_id = $request->input('department_id');

        if($employee->save()){
            flash()->success('Employee successfully updated!');
            return redirect()->to('/employees');
        }
        return redirect()->back();
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

    public function addShift(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'shift' => 'required',
            'date_from' => 'required'
        ]);
        if($validator->fails()){
            flash()->error('Input field error.');
        } else{
            $employee = Employee::where('employee_id', $id)->first();

            //for pivot table, need deep concentration in coding hahaha lol xD
            // $employee_shifts = $employee->shifts->first();
            // dd($employee_shifts->pivot->employee_shift_days()->get());

            $employee_shift = $employee->shifts()->attach($request->shift, [
                'date_from' => $request->date_from, 
                'date_to' => $request->date_to
            ]);
            $employee_shift_id = EmployeeShift::where('shift_id', $request->shift)->orderBy('created_at','desc')->first()->id;
            
            if(!empty($request->days)){
                if($this->addEmployeeShiftDay($request->days, $employee_shift_id)){
                    flash()->success('Shift successfully added');
                }
            }
        }
        return redirect()->back();
    }

    public function editShift($shift){
        
        $employee_shift = EmployeeShift::findOrFail($shift);
        $employee = $employee_shift->employee;
        $page_title = 'Edit shift - '.$employee->first_name.' '.$employee->last_name;
        $employee_shift_days = $employee_shift->employee_shift_days;

        return view('employee.edit_shift')->with(compact('page_title', 'employee_shift', 'employee_shift_days'));
    }

    public function updateShift(Request $request, $shift){
        $employee_shift = EmployeeShift::findOrFail($shift); //get employee shift by ID
        $employee_shift->date_from = $request->date_from;
        $employee_shift->date_to = $request->date_to;
        $employee_shift->save(); //update employee shift

        if($employee_shift){ //if employee shift was updated successfully
            $employee_shift_days = $employee_shift->employee_shift_days; //get the days of employee shift
            if($employee_shift_days->count() != 0){ //check if the employee shift has days
                $employee_shift->employee_shift_days()->delete(); //delete all the days
            }
            $this->addEmployeeShiftDay($employee_shift->id, $request->days); //add the days to the employee shift
            flash()->success('Shift successfully updated');
        } else{
            flash()->error('Something went wrong');
        }
        return redirect()->back();
    }

    public function viewShift(){
        return $employee;
    }

    protected function validator($data){
        return Validator::make($data, [
            'employee_id' => 'required',
            'first_name' => 'required|min:6|max:45',
            'middle_name' => 'required|min:6|max:45',
            'department_id' => 'required'
        ]);
    }

    protected function addEmployeeShiftDay($employee_shift_id, $days){
        foreach($days as $day){
            $employee_shift_day = new EmployeeShiftDay;
            $employee_shift_day->employee_shift_id = $employee_shift_id; 
            $employee_shift_day->day = $day;
            $employee_shift_day->save();
        }
        return true;
    }

}
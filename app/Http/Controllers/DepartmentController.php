<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page_title = 'departments';
        $data = 'List of departments';
        return view('department.all')->with(compact('page_title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page_title = 'department-create';
        $data = 'Create new department';
        return view('department.create')->with(compact('page_title', 'data'));
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
            flash()->error('There is something wrong with the inputs.');
            return redirect()->back();
        } else{
            Department::create($request->all());
            flash()->success("Department successfully added!");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $department = Department::where('department_code', $id)->first();
        if(empty($department)){
            flash()->error("There is no department like that in HPO");
            return redirect()->back();
        }else{
            $page_title = 'department';
            $data = $department;
            return view('department.show')->with(compact('page_title', 'department', 'data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $department = Department::where('department_code', $id)->first();
        if(empty($department)){
            flash()->error("Department not found");
            return redirect()->back();
        }
        $page_title = 'department-edit';
        $data = $department;
        return view('department.edit')->with(compact('page_title', 'department', 'data'));
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
        $department = Department::where('department_code', $id)->first();
        $department->department_code = $request->input('department_code');
        $department->name = $request->input('name');
        $department->description = $request->input('description');

        if($department->save()){
            flash()->success($request->name.' has been successfully updated!');
            return redirect()->to('/departments');
        }

        flash()->error('Sorry. We encountered an error. Please review the fields');
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

    protected function validator($data){
        return Validator::make($data, [
                'department_code' => 'required',
                'name' => 'required',
            ]);
    }
}

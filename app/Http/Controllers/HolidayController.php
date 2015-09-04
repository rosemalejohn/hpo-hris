<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Holiday;
use Validator;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page_title = 'holidays';
        return view('holidays.all')->with(compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page_title = 'create-holidays';
        return view('holidays.create')->with(compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->validator($request->all())->fails()) {
            flash()->error("Please fill the missing fields.");
            return redirect()->back();
        }

        $holiday = Holiday::create($request->all());
        if ($holiday) {
            flash($holiday->title.' successfully added to holidays list.');
            return redirect()->to('/holidays');
        } else {
            flash()->error("Holiday not added successfully!");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $holiday = Holiday::find($id);
        if ($holiday) {
            return view('holidays.edit')->with(compact('holiday'));
        }
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
        if ($this->validator($request->all())->fails()) {
            flash()->error("Please fill the missing fields.");
            return redirect()->back();
        }

        $holiday = Holiday::find($id);
        if ($holiday) {
            $holiday->update($request->all());
            flash()->success($holiday->title." successfully updated!");
        } else {
            flash()->error($holiday->title." not saved! Please try updating again.");
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
        $holiday = Holiday::find($id);
        if ($holiday) {
            $holiday->delete();
            return true;
        } else{
            return false;
        }
    }

    public function getHolidays()
    {
        return Holiday::all();
    }

    protected function validator($data)
    {
        return Validator::make($data, [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);
    }
}

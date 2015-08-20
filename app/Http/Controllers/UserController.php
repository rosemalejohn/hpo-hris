<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
            flash()->error('You have error in your inputs');
            return redirect()->back();
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        
        if($user->save()){
            flash()->success('User settings successfully saved.');
            return redirect()->to('/');
        } else{
            flash()->success('User settings NOT saved.');
            return redirect()->back();
        }
    }

    protected function validator($data){

        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required'
        ]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        $user->delete();
        flash()->success('You just deleted your account.');
        return redirect()->to('/auth/login');
    }

    public function settings(){
        $page_title = 'settings';
        $user = auth()->user();
        $data = $user;
        return view('user.settings')->with(compact('page_title', 'user', 'data'));
    }

    public function profile(){
        $user = auth()->user();
        $page_title = 'profile';
        $data = 'Profile';

        return view('user.profile')->with(compact('page_title', 'user', 'data'));
    }
}

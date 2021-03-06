<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\department_model;
use Session;
use validator;

class department extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info['sl'] = 1;
        $info['data'] = department_model::orderBy('id' , 'desc')->get();
        return view('department.index',$info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error=$request->validate([
            'department_name' => 'required',
            'description'     => 'required',
            'status'          => 'required'
        ]);
        department_model::create($request->all());
        Session::flash('Success','New Data Updated Successfully');
        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(department_model $data , $id)
    {
        $data = department_model::find($id);
        return view('department.edit')->with('department',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        department_model::where('id',$id)->delete();
        Session::flash('Success','SuccessFUlly Deleted');
        return back();
    }
}

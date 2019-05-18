<?php

namespace App\Http\Controllers;

use App\Model\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(ToDo::latest()->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $toDo = new ToDo();
        $res = [];
        $res['success'] = true;
        $res['data']  = [];
        $res['errors']  = [];

        // Run model rules validation instead
        if ($toDo->validate($request->all())) {
            $data = $toDo::create($request->only(['description', 'completed']));
            $res['data'] = $data;
        } else {
            $res['success'] = false;
            $res['errors'] = $toDo->errors();
        }

        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function show(ToDo $toDo)
    {
        return response($toDo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDo $toDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function update($id, Todo $toDoInput, Request $request)
    {
        $toDo = ToDo::find($id);
        $toDo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $toDo = ToDo::find($id);

       $toDo->delete();

        return response('Item Removed', 200);
    }
}

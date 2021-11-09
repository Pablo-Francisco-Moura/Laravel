<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\newTidings;
use App\Models\User;
use Validator;

class tidingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->id();
        $data = newTidings::where('user_id', '=', $user)->orderBy('manchete')->get();//
        return view('tidings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$data = newTidings::orderBy('manchete')->get();//
        //return view('tidings.create', compact('data'));//
        return view('tidings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'manchete' => 'required|unique:new_tidings,manchete',
            'title_tiding' => 'required',
            'description_tiding' => 'required',
        ]);
        $data=$request->all();
        $data['user_id'] = auth()->id();
        newTidings::create($data);
        //newTidings::create($request->all());
        return redirect()->route('tidings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $item = newTidings::findOrFail($id);
        return view('tidings.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = newTidings::findOrFail($id);
        return view('tidings.edit',compact('item'));
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
        $item = newTidings::findOrFail($id);
        $item->fill($request->all())->save();
        return redirect()->route('tidings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = newTidings::findOrFail($id);
        $item->delete();
        return redirect()->route('tidings.index');
    }

    public function search(){
        $search = request('search');
        $data = newTidings::where([
            ['manchete', 'like', '%'.$search.'%']
        ])->get();
        return view('tidings.index', ['data'=>$data, 'search'=>$search]);
    }
}

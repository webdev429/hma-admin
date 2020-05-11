<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Make;
use App\Http\Requests\MakeRequest;

class MakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Make $model)
    {
        $this->authorize('manage-makes', User::class);

        return view('make.index', ['items' => $model->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('make.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MakeRequest $request, Make $model)
    {
        $model->create($request->all());

        return redirect()->route('make.index')->withStatus(__('Make Data successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Make $make)
    {
        return view('make.edit', compact('make'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Make $make)
    {
        $make->update($request->all());

        return redirect()->route('make.index')->withStatus(__('Make Data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Make $make)
    {
        $make->delete();

        return redirect()->route('make.index')->withStatus(__('Make data successfully deleted.'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specific;
use App\Http\Requests\SpecificRequest;

class SpecificController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Specific $specific)
    {
        $this->authorize('manage-specifics', User::class);

        return view('specific.index', ['items' => $specific->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specific.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecificRequest $request, Specific $specific)
    {
        $specific->create($request->all());

        return redirect()->route('specific.index')->withStatus(__('Specific data successfully created.'));
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
    public function edit(Specific $specific)
    {
        return view('specific.edit', compact('specific'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecificRequest $request, Specific $specific)
    {
        $specific->update($request->all());

        return redirect()->route('specific.index')->withStatus(__('Specific Data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specific $specific)
    {
        $specific->delete();

        return redirect()->route('specific.index')->withStatus(__('Specific data successfully deleted.'));
    }
}

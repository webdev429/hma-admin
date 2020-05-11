<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modeld;
use App\Http\Requests\ModeldRequest;

class ModeldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Modeld $modeld)
    {
        $this->authorize('manage-modelds', User::class);

        return view('modeld.index', ['items' => $modeld->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modeld.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeldRequest $request, Modeld $modeld)
    {   
        $modeld->create($request->all());

        return redirect()->route('modeld.index')->withStatus(__('Model data successfully created.'));
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
    public function edit(Modeld $modeld)
    {
        return view('modeld.edit', compact('modeld'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modeld $modeld)
    {
        $modeld->update($request->all());

        return redirect()->route('modeld.index')->withStatus(__('Model Data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modeld $modeld)
    {
        $modeld->delete();

        return redirect()->route('modeld.index')->withStatus(__('Model data successfully deleted.'));
    }
}

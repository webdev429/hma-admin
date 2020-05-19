<?php

namespace App\Http\Controllers;

use App\Truckmake;
use Illuminate\Http\Request;
use App\Http\Requests\TruckmakeRequest;

class TruckmakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Truckmake $model)
    {
        $this ->authorize('manage-truckmakes', User::class);

        return view('truckmake.index', ['items' => $model->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('truckmake.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TruckmakeRequest $request, Truckmake $model)
    {
        $model ->create($request->merge(['user_id' => auth()->user()->id])->all());

        return redirect() ->route('truckmake.index') ->withStatus(__('Truck Make Data successfully created.'));
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
    public function edit(Truckmake $truckmake)
    {
        return view('truckmake.edit', compact('truckmake'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truckmake $truckmake)
    {
        $truckmake ->update($request->merge(['user_id' => auth()->user()])->all());

        return redirect() ->route('truckmake.index') ->withStatus(__('Truck Make Data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truckmake $truckmake)
    {
        $truckmake ->delete();

        return redirect() ->route('truckmake.index') ->withStatus(__('Truck Make data successfully deleted.'));
    }
}

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
        $specific->create($request->merge(['user_id' => auth()->user()->id, 
            'required' =>$request->require ? $request->require : 0])->all());
        if ($request->unit != '') {
            $specific->createColumnToDealTable($request->column_name, $request->type, $request->unit);
        } else {
            $specific->createColumnToDealTable($request->column_name, $request->type, '');
        }

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
        $specific->update($request->merge(['user_id' => auth()->user()->id, 
            'required' =>$request->require ? $request->require : 0])->all());
        
        if ($request->column_name != $request->prev_col_name) {
            if ($request->unit != '') {
                $specific->changeColumnNameInDealTable($request->prev_col_name, $request->column_name, $request->unit);
            } else {
                $specific->changeColumnNameInDealTable($request->prev_col_name, $request->column_name, '');
            }
        }

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

        $specific->dropColumnInDealTable($specific->column_name, $specific->unit);

        return redirect()->route('specific.index')->withStatus(__('Specific data successfully deleted.'));
    }
}

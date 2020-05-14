<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modeld;
use App\Category;
use App\Make;
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

        return view('modeld.index', ['items' => $modeld->with(['make', 'category'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Make $make, Category $category)
    {
        return view('modeld.create', ['makes' => $make->all(), 'categories' => $category->all()]);
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
    public function edit(Modeld $modeld, Make $make, Category $category)
    {
        $data['modeld'] = $modeld;
        $data['makes'] = $make->all();
        $data['categories'] = $category->all();
        return view('modeld.edit', $data);
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

<?php

namespace App\Http\Controllers;

use App\Type;
use App\Category;
use App\Make;
use App\Modeld;
use App\Specific;
use App\Truckmake;
use Illuminate\Http\Request;
use App\Http\Requests\DealRequest;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $model, Make $make, Modeld $modeld, Specific $specific, Type $type, Truckmake $truckmake)
    {
        $this->authorize('manage-items', User::class);

        $data['equipment_category'] = $model->all();
        $data['makes'] = $make ->all();
        $data['modelds'] = $modeld ->all();
        $data['specifics'] = $specific ->all();
        $data['types'] = $type ->all();
        $data['truckmakes'] = $truckmake ->all();
        
        return view('deal.add', $data);
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
    public function store(DealRequest $request, Deal $model)
    {
        $deal = $model->create($request->merge([
            'picture' => $request->photo->store('pictures', 'public'),
            'auc_enddate' => $request->date ? Carbon::parse($request->auc_enddate)->format('Y-m-d') : null
        ])->all());

        return redirect()->route('deal.add')->withStatus(__('Deal successfully created.'));
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
    public function edit($id)
    {
        //
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
        //
    }

}

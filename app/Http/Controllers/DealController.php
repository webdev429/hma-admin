<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Type;
use App\Category;
use App\Make;
use App\Modeld;
use App\Specific;
use App\Truckmake;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\DealRequest;

class DealController extends Controller
{
    public function __construct()
    {   
        $this->authorizeResource(Deal::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Deal $model, Specific $specific)
    {
        $this->authorize('manage-deals', User::class);
        if (auth()->user()->isAdmin() || auth()->user()->isCreator()) {
            return view('deal.index', ['items' => $model->all(), 'specifics' => $specific->all()]);
        } else if (auth()->user()->isMember()) {
            return view('deal.index', ['items' => $model->where('user_id', auth()->user()->id)->get(), 'specifics' => $specific->all()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category, Make $make, Modeld $modeld, Specific $specific, Type $type, Truckmake $truckmake)
    {
        $data['equipment_category'] = $category->get(['id', 'name']);
        $data['makes'] = $make ->get(['id', 'name']);
        $data['modelds'] = $modeld ->get(['id', 'name']);
        $data['specifics'] = $specific ->all();
        $data['types'] = $type ->get(['id', 'name']);
        $data['truckmakes'] = $truckmake ->get(['id', 'name']);
        
        return view('deal.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DealRequest $request, Deal $model)
    {
        $model->create($request->merge([
            'user_id' => auth()->user()->id,
            'picture' => $request->photo->store('pictures', 'public'),
            'auc_enddate' => $request->auc_enddate ? Carbon::parse($request->auc_enddate)->format('Y-m-d') : null
        ])->all());

        return redirect()->route('deal.index')->withStatus(__('Deal successfully created.'));
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
    public function edit(Deal $deal, Category $category, Make $make, Modeld $modeld, Specific $specific, Type $type, Truckmake $truckmake)
    {
        return view('deal.edit', [
            'deal' => $deal,
            'equipment_category' => $category->get(['id', 'name']),
            'makes' => $make->get(['id', 'name']),
            'modelds' => $modeld->get(['id', 'name']),
            'specifics' => $specific->all(),
            'types' => $type->get(['id', 'name']),
            'truckmakes' => $truckmake->get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DealRequest $request, Deal $deal)
    {
        $deal->update(
            $request->merge([
                'user_id' => auth()->user()->id,
                'picture' => $request->photo ? $request->photo->store('pictures', 'public') : null,
                'auc_enddate' => $request->auc_enddate ? Carbon::parse($request->auc_enddate)->format('Y-m-d') : null
            ])->except([$request->hasFile('photo') ? '' : 'picture'])
        );

        return redirect()->route('deal.index')->withStatus(__('Deal successfully updated.'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();

        return redirect()->route('deal.index')->withStatus(__('Deal successfully deleted.'));
    }

}

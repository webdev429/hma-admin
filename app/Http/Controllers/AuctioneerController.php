<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auctioneer;
use App\Http\Requests\AuctioneerRequest;

class AuctioneerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Auctioneer $model)
    {
        $this->authorize('manage-auctioneers', User::class);

        return view('auctioneers.index', ['items' => $model->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auctioneers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuctioneerRequest $request, Auctioneer $model)
    {
        $model->create($request->merge(['user_id' => auth()->user()->id])->all());

        return redirect()->route('auctioneer.index')->withStatus(__('Auctioneer Data successfully created.'));
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
    public function edit(Auctioneer $auctioneer)
    {
        return view('auctioneers.edit', compact('auctioneer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auctioneer $auctioneer)
    {
        $auctioneer->update($request->merge(['user_id' => auth()->user()->id])->all());

        return redirect()->route('auctioneer.index')->withStatus(__('Auctioneer Data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auctioneer $auctioneer)
    {
        $auctioneer->delete();

        return redirect()->route('auctioneer.index')->withStatus(__('Auctioneer data successfully deleted.'));
    }
}

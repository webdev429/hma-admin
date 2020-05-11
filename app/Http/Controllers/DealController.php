<?php
/*

*/
namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Make;
use App\Modeld;
use App\Http\Requests\CategoryRequest;

class DealController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Category::class);
    }

    /**
     * Display a listing of the categories
     *
     * @param \App\Category  $model
     * @return \Illuminate\View\View
     */
    public function index(Category $model, Make $make, Modeld $modeld)
    {
        $this->authorize('manage-items', User::class);

        $data['equipment_category'] = $model->all();
        $data['makes'] = $make->all();
        $data['modelds'] = $modeld->all();

        return view('deal.add', ['data' => $data]);
    }

}

<?php
/*

=========================================================
* Argon Dashboard PRO - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro-laravel
* Copyright 2018 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)

* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Specific;
use App\Type;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class);
    }

    /**
     * Display a listing of the categories
     *
     * @param \App\Category  $model
     * @return \Illuminate\View\View
     */
    public function index(Category $model, Specific $specific)
    {
        $this->authorize('manage-items', User::class);

        return view('categories.index', ['categories' => $model->with(['type'])->get(), 'specific' => $specific]);
    }
    /**
     * Show the form for creating a new category
     *
     * @return \Illuminate\View\View
     */
    public function create(Specific $specific, Type $type)
    {
        return view('categories.create', [
            'equip_specifics' => $specific->where('truck_data', 0)->get(), 
            'truck_specifics' => $specific->where('truck_data', 1)->get(), 
            'types' => $type->get(['id', 'name'])
        ]);
    }

    /**
     * Store a newly created category in storage
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Category  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request, Category $model)
    {
        $title_structure = $request->title1 . "," . $request->title2;
        if ($request->title3 != 'title_none') 
            $title_structure .= "," . $request->title3;
        if ($request->title4 != 'title_none')
            $title_structure .= "," . $request->title4;

        $category = $model->create($request->merge(['user_id' => auth()->user()->id, 'title_structure' => $title_structure])->all());

        if ($request->get('truck_specifics')) {
            if ($request->get('equip_specifics')) {
                $category->specifics()->sync(array_merge($request->get('equip_specifics'), $request->get('truck_specifics')));
            } else {
                $category->specifics()->sync($request->get('truck_specifics'));
            }
        } else {
            $category->specifics()->sync($request->get('equip_specifics'));
        }

        return redirect()->route('category.index')->withStatus(__('Category successfully created.'));
    }

    /**
     * Show the form for editing the specified category
     *
     * @param  \App\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category, Specific $specificModel, Type $type)
    {
        return view('categories.edit', [
            'category' => $category->load('specifics'),
            'types' => $type->get(['id', 'name']),
            'specifics' => $specificModel->all(),
            'equip_specifics' => $specificModel->where('truck_data', 0)->get(['id', 'name', 'unit']),
            'truck_specifics' => $specificModel->where('truck_data', 1)->get(['id', 'name', 'unit'])
        ]);
    }

    /**
     * Update the specified category in storage
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $title_structure = $request->title1 . "," . $request->title2;
        if ($request->title3 != 'title_none') {
            $title_structure .= "," . $request->title3;
        }
        if ($request->title4 != 'title_none') {
            $title_structure .= "," . $request->title4;
        }        
        
        $category->update($request->merge(['user_id' => auth()->user()->id, 'title_structure' => $title_structure])->all());
        
        if ($request->get('truck_specifics')) {
            if ($request->get('equip_specifics')) {
                $category->specifics()->sync(array_merge($request->get('equip_specifics'), $request->get('truck_specifics')));
            } else {
                $category->specifics()->sync($request->get('truck_specifics'));
            }
        } else {
            $category->specifics()->sync($request->get('equip_specifics'));
        }

        return redirect()->route('category.index')->withStatus(__('Category data successfully updated.'));
    }

    /**
     * Remove the specified category from storage
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        DB::table('category_specific')
            ->where('category_id', $category->id)
            ->delete();
            
        $category->delete();

        return redirect()->route('category.index')->withStatus(__('Category successfully deleted.'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deal;
use App\Specific;
use App\Type;
use App\Category;
use App\Make;
use App\Modeld;
use App\Truckmake;
use App\Ajax;

class WelcomeController extends Controller
{
    public function index(Deal $model, Specific $specific, Type $type, Category $category, Make $make, Modeld $modeld, Truckmake $truckmake)
    {
        return view('pages.welcome', [
            'deals' => $model->paginate(10),
            'specifics' => $specific->all(),
            'types' => $type->all(),
            'categories' => $category->all(),
            'makes' => $make->all(),
            'modelds' => $modeld->all(),
            'truckmakes' => $truckmake->all()
        ]);
    }

    public function get_specifics_by_categories (Request $request) {
        $categoryAry = $request ->categories;

        $return_specAry = Ajax::getSpecificsByCategories($categoryAry);
        
        if (empty($return_specAry)) {
            $return_specAry = "fail";
        }

        return response() ->json($return_specAry); 
    }

    public function get_cities_by_countries (Request $request) {
        $countryAry = $request ->countries;
        
        $return_countryAry = Ajax::getCitiesByCountries($countryAry);
        
        return response() ->json($return_countryAry);
    }

    public function get_if_truck (Request $request) {
        $categoryAry = $request ->categories;

        $return = Ajax::getIfTruckByCategories($categoryAry);

        return response() ->json($return);
    }

    public function get_categories_by_types (Request $request) {
        $typeAry = $request ->types;

        $return = Ajax::getCategoryByTypes($typeAry);

        return response() ->json($return);
    }

    public function get_modelds_by_makes (Request $request) {
        $makeAry = $request ->makes;
        
        $return = Ajax::getModelByMake($makeAry);

        return $return;
    }

    public function get_deals_with_filter (Request $request, Specific $specific, Type $type, Category $category, Make $make, Modeld $modeld, Truckmake $truckmake) {
        $return = Ajax::getDealsWithFilter($request);
        
        if ($return == 'fail') {
            $pagination = "";
        } else {
            $pagination = (string) $return->links("vendor.pagination.ajax");
        }
        return response() ->json([
            'data' => $return,
            'pagination' => $pagination
        ]);
    } 
}

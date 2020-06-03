<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ajax;

class AjaxController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_specific_properties(Request $request) {
        $category_id = $request ->equipment_category_id;

        $specific_field_data = Ajax::getSpecificField($category_id);

        $title_structure = Ajax::getTitleStructure($category_id);

        return response() ->json([
            'spec_field_data' => $specific_field_data,
            'title_structure' => $title_structure
        ]);
    }

    public function get_equipment_category(Request $request) {
        $type_id = $request ->equipment_type_id;

        $category_data = Ajax::getCategoryField($type_id);

        return response() ->json($category_data);
    }

    public function get_modeld(Request $request) {
        $make_id = $request ->make_id;

        $modeld_data = Ajax::getModeld($make_id);

        return response() ->json($modeld_data);
    }

    public function get_state_list(Request $request) {
        $country = $request ->country;
        
        $state_list = Ajax::getStatesOfCountries($country);

        return response() ->json($state_list);
    }

    public function get_make_models (Request $request) {
        $category_id = $request->ecat_id;

        $modeld = Ajax::getModeldByCategory($category_id);

        $make = Ajax::getMakeByCategory($category_id);

        return response() ->json([
            'makes' => $make,
            'modelds' => $modeld
        ]);
    }
}
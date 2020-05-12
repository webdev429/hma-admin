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

        return response()->json($specific_field_data);
    }
}
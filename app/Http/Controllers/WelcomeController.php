<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deal;
use App\Specific;

class WelcomeController extends Controller
{
    public function index(Deal $model, Specific $specific)
    {
        return view('pages.welcome', [
            'deals' => $model->all(),
            'specifics' => $specific->all()
        ]);
    }
}

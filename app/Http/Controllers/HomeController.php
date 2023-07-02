<?php

namespace App\Http\Controllers;

use App\R6f\MyCustomization;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }

    public function contactOptions()
    {
        return response()->json(["contactOptions" => MyCustomization::option()]);
    }
}

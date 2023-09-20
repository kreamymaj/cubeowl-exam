<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');     
    }
    
    public function inActiveProduct(){
        $totalInactiveProduct = Product::where('productStatus', 'Inactive')->count();
        return response()->json($totalInactiveProduct);
    }

    public function inActiveStore(){
        $totalInactiveStore = Store::where('storeStatus', 'Inactive')->count();
        return response()->json($totalInactiveStore);
    }

}

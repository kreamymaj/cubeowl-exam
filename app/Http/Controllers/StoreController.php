<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller 
{
    public function count(){
        $totalStore = Store::where('storeStatus', 'Active')->count();
        return response()->json($totalStore);
    }

    public function index(Request $request){
        $query = Store::query();    
        $stores = $query->orderBy('storeID', 'desc')->paginate(5);
    
        return view('stores.index', compact('stores'));

        
    }

    public function create(){
        return view('stores.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'storeName' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'landline' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|string|email|max:255|unique:stores',
            'mobileNum' => 'required|regex:/^639[0-9]{9}+$/',
            'storeStatus' => 'required|string|max:255',
        ]);

        $data = [
            'storeName' => $request->input('storeName'),
            'address' => $request->input('address'),
            'landline' => $request->input('landline'),
            'email' => $request->input('email'),
            'mobileNum' => $request->input('mobileNum'),
            'storeStatus' => $request->input('storeStatus'),
        ];
        return Store::create($data);
    }

    public function edit($storeID){
        $store = Store::find($storeID);
        return view('stores.update', compact('store'));
    }

    public function update(Request $request, $storeID){
        $this->validate($request, [
            'storeName' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'landline' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => "required|string|email|max:255|unique:stores,email,$request->storeID,storeID",
            'mobileNum' => 'required|regex:/^639[0-9]{9}+$/',
            'storeStatus' => 'required|string|max:255',
        ]);

        $store = Store::find($storeID);
        if (!$store) {
            // Handle the case when the service is not found
            return response()->json(['message' => 'Store not found'], 404);
        }

        $data = [
            'storeName' => $request->input('storeName'),
            'address' => $request->input('address'),
            'landline' => $request->input('landline'),
            'email' => $request->input('email'),
            'mobileNum' => $request->input('mobileNum'),
            'storeStatus' => $request->input('storeStatus'),
        ];
        $store->update($data);
    }

    public function deleteStore($storeID){
        $store = Store::find($storeID);
        if (!$store) {
            return redirect()->back()->with('error', 'Store not found');
        }   
        $store->delete();
        return redirect()->back()->with('success', 'Store record deleted successfully');
    }
}

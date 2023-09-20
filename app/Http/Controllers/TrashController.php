<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TrashController extends Controller
{
    public function index()
    {
        return view('trash.index');
    }

    public function deleted(Request $request)
    {
        $products = Product::onlyTrashed()->orderBy('productID', 'desc')->paginate(5);
        $users = User::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
        $stores = Store::onlyTrashed()->orderBy('storeID', 'desc')->paginate(5);

        return view('trash.index', compact('products', 'stores', 'users'));
    }

    public function restoreProduct(Request $request){
        Product::where('productID', $request->productID)->restore();
        return redirect()->back()->with('success', 'Product Record restored successfully');
    }

    public function destroyProduct(Request $request, $service){
        Product::where('productID', $request->productID)->forceDelete();
        return redirect()->back()->with('success', 'Product Record Deleted Permanently');
    }


    public function restoreStore(Request $request){
        Store::where('storeID', $request->storeID)->restore();
        return redirect()->back()->with('success', 'Store Record Restored successfully');
    }

    public function destroyStore(Request $request, $service){
        Store::where('storeID', $request->storeID)->forceDelete();
        return redirect()->back()->with('success', 'Store Record Deleted Permanently');
    }

    public function restoreUser(Request $request){
        User::where('id', $request->id)->restore();
        return redirect()->back()->with('success', 'User Record restored successfully');
    }

    public function destroyUser(Request $request){
        User::where('id', $request->id)->forceDelete();
        return redirect()->back()->with('success', 'User Record Deleted Permanently');
    }
}

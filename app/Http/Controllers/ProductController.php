<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function count(){
        $totalProducts = Product::where('productStatus', 'Active')->count();
        return response()->json($totalProducts);
    }

    public function index(Request $request){
        $query = Product::query();    
        $products = $query->orderBy('productID', 'desc')->paginate(5);
     
        return view('products.index', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'productName' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'productStatus' => 'required|string|max:255',
        ]);

        $data = [
            'productName' => $request->input('productName'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'productStatus' => $request->input('productStatus'),
            'image' => $request->input('image'), // Set the image field to null if no image is uploaded
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->storeAs('public/images', $imageName);
            $data['image'] = $imageName;
        }
        return Product::create($data);
    }

    public function edit($productID){
        $product = Product::find($productID);
        return view('products.update', compact('product'));
    }

    public function update(Request $request, $productID){
        $this->validate($request, [
            'productName' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'productStatus' => 'required|string|max:255',
        ]);

        $product = Product::find($productID);
        if (!$product) {
            // Handle the case when the service is not found
            return response()->json(['message' => 'Product not found'], 404);
        }

        $data = [
            'productName' => $request->input('productName'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'productStatus' => $request->input('productStatus'),
        ];
        $product->update($data);
    }
    
    public function changeImage(Request $request, $productID)
    {
        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::find($productID);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete the existing image file from storage
        if ($product->image) {
            Storage::delete('public/images/' . $product->image);
        }

        // Upload the new image file to storage
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->storeAs('public/images', $imageName);
            $product->image = $imageName;
        }
        $product->save();
        return response()->json(['message' => 'Image uploaded successfully'], 200);
    }


    public function deleteImage($productID)
    {
        $product = Product::find($productID);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete the image file from storage
        if ($product->image) {
            Storage::delete('public/images/' . $product->image);
        }

        // Update the service record to remove the image
        $product->image = null;
        $product->save();

        return response()->json(['message' => 'Image deleted successfully'], 200);
}

    public function deleteService($productID){
        $product = Product::find($productID);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }   
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ProductController extends Controller
{

    public function index(): View
    {
        $products = Product::all();
        // dd($products);
        return view('products.index', compact("products"));
    }

    public function create(): View
    {
        return  view('products.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'product_id' => 'required|string'
        ]);


        $name = $request->input('name');
        $product_id = $request->input('product_id');
        Product::create([
            'name' => $name,
            'product_id' => $product_id,
        ]);

        return $this->index();
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact("product"));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $product = Product::findOrFail($id);


        $name = $request->input('name');
        $tags = $request->input('tags');
        $description = $request->input('description');
        $product->update([
            'name' => $name,
            'description' => json_encode($description),
            'tags' => $tags,

        ]);
        return $this->index();
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return $this->index();
    }
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view("products.details", compact("product"));
    }
}

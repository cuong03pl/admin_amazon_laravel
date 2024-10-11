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
            'description' => 'required|string',
            'name' => 'required|string',
            'tags' => 'required|string',
            'sku' => 'required|string'
        ]);

        $description = $request->input('description');
        $name = $request->input('name');
        $tags = $request->input('tags');
        $sku = $request->input('sku');
        Product::create([
            'name' => $name,
            'description' => json_encode($description),
            'tags' => $tags,
            'sku' => $sku
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
        $request->validate([
            'description' => 'required|string',
            'name' => 'required|string',
            'tags' => 'required|string',
            'sku' => 'required|string'
        ]);

        $description = $request->input('description');
        $name = $request->input('name');
        $tags = $request->input('tags');
        $sku = $request->input('sku');
        $product->update([
            'name' => $name,
            'description' => json_encode($description),
            'tags' => $tags,
            'sku' => $sku

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

<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::where('username', Auth::user()->email)->get();
        foreach ($jobs as $job) {
            $status = 2;
            $package_name = $job->package_name;
            $products = Product::where('package', $package_name)->get();
            foreach ($products as $product) {
                $description = $product->description;
                if (strlen($description) < 500) {
                    $status = 1;
                    break;
                }
            }
            $job->update(['status' => $status]);
        }
        return view("jobs-user.index", compact("jobs"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Jobs::findOrFail($id);
        $package_name = $job->package_name;

        $products = Product::where('package', $package_name)->get()->toArray();
        // $data = $job->data;

        // $data = trim($data, "\n\"\"\"");

        // $products = explode("\n", $data);

        // $productsArray = [];

        // foreach ($products as $product) {
        //     list($product_id, $name, $description) = explode('|', $product);

        //     // Thêm mỗi sản phẩm vào mảng dưới dạng một mảng liên kết
        //     $productsArray[] = [
        //         'product_id' => $product_id,
        //         'name' => $name,
        //         'description' => $description,
        //     ];
        // }
        return view("jobs-user.show", compact("products", 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        return view('jobs-user.edit', compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $product = Product::findOrFail($id);
        $description = $request->input('description');
        $name = $request->input('name');
        $tags = $request->input('tags');
        $product->update([
            'name' => $name,
            'description' => json_encode($description),
            'tags' => $tags,
        ]);
        $isPreview = true;
        return view('jobs-user.edit', compact("product", 'isPreview'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

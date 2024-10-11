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
        //     list($sku, $name, $description) = explode('|', $product);

        //     // Thêm mỗi sản phẩm vào mảng dưới dạng một mảng liên kết
        //     $productsArray[] = [
        //         'sku' => $sku,
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
    public function edit($sku)
    {
        $product = Product::where('sku', $sku)->first();
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
        $request->validate([
            'name' => 'required|string',
            'sku' => 'required|string'
        ]);

        $description = $request->input('description');
        $name = $request->input('name');
        $tags = $request->input('tags');
        $sku = $request->input('sku');
        $image = $request->input('image');
        $product->update([
            'name' => $name,
            'description' => json_encode($description),
            'tags' => $tags,
            'sku' => $sku,
            'image' => $image

        ]);
        return $this->index();
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

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
        // gán status = complete
        // lấy ra tất cả products thuộc package đó 
        // foreach để check description > 500 không nếu có 1 cái chưa thì status = uncomplete và break
        return view("jobs-user.index", compact("jobs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $package_name = $job->package;

        $products = Product::where('package', $package_name)->get();
        dd($products);
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
        // return view("jobs-user.show", compact("productsArray"));


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
        return view('products.edit', compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

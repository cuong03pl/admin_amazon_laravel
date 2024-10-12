<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobsController extends Controller
{
    public function index(): View
    {
        $jobs = Jobs::all();
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
        return view('jobs.index', compact("jobs"));
    }

    public function create(): View
    {
        $users = User::all();
        return  view('jobs.create', compact("users"));
    }
    public function store(Request $request)
    {
        $package = $request->input('package_name');
        $data = $request->input('data');

        $data = trim($data, "\n\"\"\"");

        $products = explode("\n", $data);
        foreach ($products as $product) {
            list($product_id, $name, $slug, $description, $image) = explode('|', $product);
            if (Product::where('product_id', $product_id)->exists()) {
                continue;
            }
            try {
                Product::create([
                    'product_id' => $product_id,
                    'name' => $name,
                    'description' => $description,
                    'package' => $package,
                    'image' => $image,
                    'slug' => $slug,
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        $job = Jobs::create($request->all());
        return $this->index();
    }


    public function edit($id): View
    {
        $job = Jobs::findOrFail($id);
        $user = User::where('email', $job->username)->get()->toArray();
        $users = User::all();
        return view("jobs.edit", compact("job", 'user', 'users'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $job = Jobs::findOrFail($id);

        $job->update($request->all());

        return $this->index();
    }
    public function delete($id)
    {
        $job = Jobs::findOrFail($id);
        $job->delete();
        return $this->index();
    }
    public function detail($id)
    {

        return $this->index();
    }
}

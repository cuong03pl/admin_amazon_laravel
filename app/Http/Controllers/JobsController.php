<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JobsController extends Controller
{
    public function index(Request $request): View
    {
        $query = Jobs::query();

        if ($request->filled('package_name')) {
            $query->where('package_name', 'like', '%' . $request->package_name . '%');
        }

        if ($request->filled('user')) {
            $query->where('username', $request->user);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $jobs = $query->get();
        $users = User::all();

        foreach ($jobs as $job) {
            $status = 2;
            $package_name = $job->package_name;
            $products = Product::where('package', $package_name)->get();
            foreach ($products as $product) {
                if (strlen($product->description) < 500) {
                    $status = 1;
                    break;
                }
            }
            $job->update(['status' => $status]);
        }

        return view('jobs.index', compact('jobs', 'users'));
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
        return redirect()->route('jobs.index');
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

        $package = $request->input('package_name');
        $data = $request->input('data');

        $data = trim($data, "\n\"\"\"");
        $products = explode("\n", $data);

        foreach ($products as $product) {
            list($product_id, $name, $slug, $description, $image) = explode('|', $product);

            $existingProduct = Product::where('product_id', $product_id)->first();

            if ($existingProduct) {
                try {
                    $existingProduct->update([
                        'name' => $name,
                        'description' => $description,
                        'package' => $package,
                        'image' => $image,
                        'slug' => $slug,
                    ]);
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            } else {
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
        }

        return redirect()->route('jobs.index');
    }

    public function delete($id)
    {
        $job = Jobs::findOrFail($id);
        $job->delete();
    }
    public function detail($id)
    {

        return redirect()->route('jobs.index');
    }
    public function export($id)
    {
        $job = Jobs::findOrFail($id)->toArray();
        $products = Product::where("package", $job['package_name'])->select('product_id', "name", "slug", "description", 'image')->get()->toArray();
        $jsonContent = json_encode($products, JSON_PRETTY_PRINT);
        $filePath = 'exports/package_' . $job['package_name'] . '.json';
        Storage::put($filePath, $jsonContent);
        return redirect()->route('jobs.index');
    }
}

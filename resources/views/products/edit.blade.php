<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TinyMCE in Laravel</title>
    <!-- Insert the blade containing the TinyMCE configuration and source script -->
    <script src="https://cdn.tiny.cloud/1/38i5vfrydzs2luzbra2qnkcxm1ezyqdhntpk3smi5dob07p4/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Products') }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-[32px]">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form class="mt-[32px] grid grid-cols-12 gap-4" action="{{ route('products.update') }}" method="POST">
                @csrf
                <div class="col-span-9">
                    <input class="w-full" type="hidden" name="id" value="{{$product->id}}" placeholder="Product name">
                    <div class="w-full">
                        <input class="w-full" type="text" name="sku" value="{{$product->sku}}" placeholder="SKU">
                    </div>
                    <div class="w-full">
                        <input class="w-full" type="text" name="name" value="{{$product->name}}" placeholder="Product name">
                    </div>
                    <textarea name="description" id="description">{{json_decode($product->description) }}</textarea>
                    <button class="bg-[#2271b1] text-white h-[40px] px-[14px] rounded-[3px] mt-[32px]" type="submit">Publish</button>
                </div>
                <div class="col-span-3">
                    <input type="text" value="{{$product->tags}}" name="tags" placeholder="tags">
                </div>
            </form>

        </div>
    </x-app-layout>
</body>

</html>
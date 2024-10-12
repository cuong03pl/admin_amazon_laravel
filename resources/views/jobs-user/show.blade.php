<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TinyMCE in Laravel</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
            <div class=""> <span class="font-medium">Total products:</span> <span class="font-bold">{{count($products)}}</span> </div>
            <div class="flex flex-col my-6 rounded-2xl shadow-xl shadow-gray-200">
                <div class="overflow-x-auto rounded-2xl">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                <div class="bg-white">
                                    <div class="grid grid-cols-12 w-full">
                                        <div scope="col" class="col-span-4 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            Product Name
                                        </div>
                                        <div scope="col" class="col-span-2 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            product_id
                                        </div>
                                        <div scope="col" class="col-span-3 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            Status
                                        </div>
                                        <div scope="col" class="col-span-3 p-4 lg:p-5">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white divide-y divide-gray-200">
                                    @foreach($products as $product)
                                    <div class="hover:bg-gray-100 grid grid-cols-12 w-full items-center">
                                        <div class="p-4 col-span-4 text-sm font-normal text-gray-500  lg:p-5">
                                            <div class="text-base font-semibold text-gray-900">{{$product['name']}}</div>
                                        </div>
                                        <div class="p-4 col-span-2 text-base font-medium text-gray-900  lg:p-5">{{$product['product_id']}}</div>
                                        <div class="col-span-3 p-4">
                                            <div class="w-[200px]">
                                                @if(strlen($product['description']) < 500)
                                                    <div class=" text-white flex justify-center bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5  ">Incomplete</div>
                                            @else
                                            <div class=" text-white flex justify-center bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5  ">Complete</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="p-4 col-span-3 space-x-2  lg:p-5">

                                        <a href="{{ route('jobs-user.edit', $product['product_id']) }}" type="button" data-modal-toggle="product-modal" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 hover:text-gray-900 hover:scale-[1.02] transition-all">
                                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Edit item
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </x-app-layout>
</body>

</html>
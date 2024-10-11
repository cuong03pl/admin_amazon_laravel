<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TinyMCE in Laravel</title>

    <style>
        a {
            text-decoration: underline !important;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details Products') }}
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-[32px]">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1">
                    <div class="">
                        <img src="https://site1.premiumdodo.com/wp-content/uploads/woocommerce-placeholder-600x600.png" alt="">
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="text-[48px]">{{$product->name}}</div>

                    <div class="flex items-center gap-2">
                        <span>Category: </span>
                        <div class="">
                            Uncategorized
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>Tag: </span>
                        <div class="">
                            {{$product->tags}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="">{!! json_decode($product->description) !!}</div>
        </div>
    </x-app-layout>
</body>

</html>
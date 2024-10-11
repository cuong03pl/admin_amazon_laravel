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
                {{ __('Create Jobs') }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-[32px]">

            <form class="mt-[32px] grid grid-cols-1 gap-4" action="{{ route('jobs.store') }}" method="POST">
                @csrf
                <div class="">
                    <div class="">
                        <h3 for="user_id">Select User</h3>
                        <select name="username" id="username" class="form-control">
                            @foreach($users as $user)
                            <option value="{{ $user->email }}">{{ $user->name }} - {{ $user->email }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="w-[50%]">
                        <h3>Date</h3>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" name="date" readonly>
                    </div>
                    <div class="w-[50%] my-4">
                        <h3>Package Name</h3>
                        <input class="w-full" type="text" name="package_name">
                    </div>
                    <div class="w-full">
                        <h3>Data</h3>
                        <textarea class="w-full" name="data" id="data" rows="20"></textarea>
                    </div>
                    <button class="bg-[#2271b1] text-white h-[40px] px-[14px] rounded-[3px] mt-[32px]" type="submit">Publish</button>
                </div>

            </form>

        </div>
    </x-app-layout>
</body>

</html>
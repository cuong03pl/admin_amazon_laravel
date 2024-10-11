<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TinyMCE in Laravel</title>
    <!-- Insert the blade containing the TinyMCE configuration and source script -->


</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Jobs') }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  py-6">

            <form class="mt-[32px] grid grid-cols-1 gap-4" action="{{ route('jobs.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="">
                    <input class="w-full" type="hidden" name="id" value="{{$job->id}}">

                    <div class="mb-3">
                        <h3 class="font-bold">Select User</h3>
                        <select name="username" id="username" class="form-control">
                            @foreach($users as $user)
                            <option {{$job->username == $user->email ? "selected" : ""}} value="{{ $user->email }}">{{ $user->name }} - {{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-[50%] mb-3">
                        <h3 class="font-bold">Date</h3>
                        <input type="date" name="date" value="{{$job->date}}" readonly>
                    </div>
                    <div class="w-[50%] mb-3">
                        <h3 class="font-bold">Package Name</h3>
                        <input class="w-full" type="text" name="package_name" value="{{$job->package_name}}">
                    </div>
                    <div class="w-full mb-3">
                        <h3 class="font-bold">Data</h3>
                        <textarea rows="20" class="w-full" name="data" id="data">{{$job->data}}</textarea>
                    </div>
                    <button class="bg-[#2271b1] text-white h-[40px] px-[14px] rounded-[3px] mt-[32px]" type="submit">Save</button>
                </div>

            </form>

        </div>
    </x-app-layout>
</body>

</html>
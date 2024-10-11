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
                {{ __('User') }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
            <a href="{{ route('user.create-account') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Account</a>
            <div class="flex flex-col my-6 rounded-2xl shadow-xl shadow-gray-200">
                <div class="overflow-x-auto rounded-2xl">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                <div class="bg-white">
                                    <div class="grid grid-cols-12 w-full">
                                        <div scope="col" class="col-span-4 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            User Name
                                        </div>
                                        <div scope="col" class="col-span-4 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            Email
                                        </div>

                                        <div scope="col" class="c p-4 lg:p-5">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $user)
                                    <div class="hover:bg-gray-100 grid grid-cols-12 w-full items-center">
                                        <div class="p-4 col-span-4 text-sm font-normal text-gray-500  lg:p-5">
                                            <div class="text-base font-semibold text-gray-900">{{$user->name}}</div>
                                        </div>
                                        <div class="p-4 col-span-4 text-base font-medium text-gray-900  lg:p-5">{{$user->email}}</div>
                                        <div class="p-4 col-span-4 flex items-center">
                                            <button data-id="{{ $user->id }}" type="button" class="delete-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function() {
                const userId = $(this).data('id');
                if (confirm("Are you sure you want to delete this product?")) {
                    $.ajax({
                        url: '/user/' + userId + '/delete',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(response) {}
                    });
                }
            });
        });
    </script>
</body>

</html>
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
                {{ __('Jobs') }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-[32px]">
            <a href="{{ route('jobs.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create jobs</a>
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
                                        <div scope="col" class="col-span-2 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            Package Name
                                        </div>
                                        <div scope="col" class="col-span-2 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            Date
                                        </div>
                                        <div scope="col" class="c p-4 lg:p-5">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white divide-y divide-gray-200">
                                    @foreach($jobs as $job)
                                    <div class="hover:bg-gray-100 grid grid-cols-12 w-full">

                                        <div class="p-4 col-span-4 text-sm font-normal text-gray-500  lg:p-5">
                                            <div class="text-base font-semibold text-gray-900">{{$job->username}}</div>
                                        </div>
                                        <div class="p-4 col-span-2 text-base font-medium text-gray-900  lg:p-5">{{$job->package_name}}</div>
                                        <div class="p-4 col-span-2 text-base font-medium text-gray-900  lg:p-5">{{$job->date}}</div>
                                        <!-- <div class="p-4 text-base font-medium text-gray-900  lg:p-5">$149</div> -->
                                        <div class="p-4 col-span-4 space-x-2  lg:p-5">

                                            <a href="{{ route('jobs.edit', $job->id) }}" type="button" data-modal-toggle="product-modal" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 hover:text-gray-900 hover:scale-[1.02] transition-all">
                                                <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Edit item
                                            </a>
                                            <button data-id="{{ $job->id }}" type="button" data-modal-toggle="delete-product-modal" class="delete-btn inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gradient-to-br from-red-400 to-red-600 rounded-lg shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform">
                                                <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                Delete item
                                            </button>
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
                const productId = $(this).data('id');
                if (confirm("Are you sure you want to delete this jobs?")) {
                    $.ajax({
                        url: '/jobs/' + productId + '/delete',
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
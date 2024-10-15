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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  py-6">
            <div class="w-full">
                <div class="flex flex-col">
                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
                        <form action="{{route('jobs.index')}}" method="GET" class="">
                            <!-- search -->
                            <div class="relative mb-10 w-full flex  items-center justify-between rounded-md">
                                <svg class="absolute left-2 block h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" class=""></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" class=""></line>
                                </svg>
                                <input type="name" name="package_name" value="{{request('package_name')}}" class="h-12 w-full cursor-text rounded-md border border-gray-100 bg-gray-100 py-4 pr-40 pl-12 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Package name" />
                            </div>
                            <!-- filter -->
                            <div class="grid grid-cols-4 gap-6 ">
                                <!-- field user -->
                                <div class=" col-span-1 ">
                                    <label for="user" class="text-sm font-medium text-stone-600">User</label>
                                    <select id="user" name="user" class="mt-2 block w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="">Select All</option>
                                        @foreach($users as $user)
                                        <option {{$user->email == request('user') ? "selected" : ""}} value="{{ $user->email }}">{{ $user->name }} - {{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- user -->
                                <div class=" col-span-1">
                                    <label for="status" class="text-sm font-medium text-stone-600">Status</label>

                                    <select id="status" name="status" class="mt-2 block w-full cursor-pointer rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="">Select All</option>
                                        <option {{ request('status') == 2 ? 'selected' : '' }} value="2">Completed</option>
                                        <option {{ request('status') == 1 ? 'selected' : '' }} value="1">Incomplete</option>
                                    </select>
                                </div>
                                <!-- date from -->
                                <div class=" col-span-1">
                                    <label for="date" class="text-sm font-medium text-stone-600">Date from:</label>
                                    <input type="date" value="{{ request('date_from') }}" name="date_from" id="date" class="mt-2 block w-full cursor-pointer rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                </div>
                                <!-- date to -->
                                <div class=" col-span-1">
                                    <label for="date" class="text-sm font-medium text-stone-600">Date to:</label>
                                    <input type="date" value="{{ request('date_to') }}" name="date_to" id="date" class="mt-2 block w-full cursor-pointer rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                </div>
                            </div>
                            <!-- button -->
                            <div class="mt-6 grid grid-cols-2 justify-end space-x-4 md:flex">
                                <a href="{{route('jobs.index')}}" class="rounded-lg text-center bg-gray-200 px-8 py-2 font-medium text-gray-700 outline-none hover:opacity-80 focus:ring">Reset</a>
                                <button type="submit" class="rounded-lg bg-blue-600 px-8 py-2 font-medium text-white outline-none hover:opacity-80 focus:ring">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-6">

                <a href="{{ route('jobs.create') }}" class="text-white px-3 py-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create jobs</a>
            </div>
            <div class="flex flex-col my-6 rounded-2xl shadow-xl shadow-gray-200">
                <div class="overflow-x-auto rounded-2xl">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                <div class="bg-white">
                                    <div class="grid grid-cols-12 w-full items-center">
                                        <div scope="col" class="col-span-3 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            User Name
                                        </div>
                                        <div scope="col" class="col-span-2 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            Package Name
                                        </div>
                                        <div scope="col" class="col-span-2 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            Date
                                        </div>
                                        <div scope="col" class="col-span-2 p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                            Status
                                        </div>
                                        <div scope="col" class="c col-span-3 p-4 lg:p-5">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white divide-y divide-gray-200">
                                    @foreach($jobs as $job)
                                    <div class="hover:bg-gray-100 grid grid-cols-12 w-full items-center">

                                        <div class="p-4 col-span-3 text-sm font-normal text-gray-500  lg:p-5">
                                            <div class="text-base font-semibold text-gray-900">{{$job->username}}</div>
                                        </div>
                                        <div class="p-4 col-span-2 text-base font-medium text-gray-900  lg:p-5">{{$job->package_name}}</div>
                                        <div class="p-4 col-span-2 text-base font-medium text-gray-900  lg:p-5">{{$job->date}}</div>
                                        <div class="p-4 col-span-2">
                                            @if($job->status == 1)
                                            <div class=" text-white flex justify-center bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5  ">Incomplete</div>
                                            @else
                                            <div class=" text-white flex justify-center bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5  ">Complete</div>
                                            @endif
                                        </div>
                                        <div class="p-4  col-span-3  lg:p-5 flex items-center gap-1">
                                            <a href="{{ route('jobs.edit', $job->id) }}" data-modal-toggle="product-modal" class="inline-flex items-center py-2 px-1 text-sm font-medium text-center text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 hover:text-gray-900 hover:scale-[1.02] transition-all">
                                                <svg class="mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <a href="{{ route('jobs-user.show', $job->id) }}" class=" inline-flex items-center py-2 px-1 text-sm font-medium text-center text-white bg-gradient-to-br from-red-400 to-red-600 rounded-lg shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform">
                                                Details
                                            </a>
                                            <button data-id="{{ $job->id }}" type="button"  class="delete-btn inline-flex items-center py-2 px-1 text-sm font-medium text-center text-white bg-gradient-to-br from-red-400 to-red-600 rounded-lg shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform">
                                                <svg class="mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                Delete
                                            </button>

                                            <a href="{{ route('jobs.export', $job->id) }}" class=" inline-flex items-center py-2 px-1 text-sm font-medium text-center text-white bg-gradient-to-br from-red-400 to-red-600 rounded-lg shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform">
                                                Export
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function() {
                const jobs = $(this).data('id');
                if (confirm("Are you sure you want to delete this jobs?")) {
                    $.ajax({
                        url: '/jobs/' + jobs + '/delete',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            // location.reload();
                            console.log(response);
                            
                        },
                        error: function(response) {
                            alert('Error: ' + response.responseJSON.message || 'An error occurred while deleting the job.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
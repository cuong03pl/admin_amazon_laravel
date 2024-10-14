<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update User Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                        <div class="w-full">
                            <input class="w-full" type="hidden" name="id" value="{{$user->id}}">
                        </div>
                        <!-- Username -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" id="name" name="name" value="{{$user->name}}" placeholder="Enter your username"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="email" id="email" name="email" value="{{$user->email}}" placeholder="Enter your email"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="roleName" id="roleName" class=" mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[30%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($roles as $role)
                                <option {{$role->name == (count($user->roles) > 0 ? $user->roles[0]['name'] : "") ? "selected" : ""}} value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-[#ccc]  py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 ">Update Account</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
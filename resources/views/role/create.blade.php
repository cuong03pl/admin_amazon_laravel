<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('role.store') }}">
                        @csrf
                        <!-- Username -->
                        <div class="mb-4">
                            <label for="rolename" class="block text-sm font-medium text-gray-700">Role name</label>
                            <input type="text" id="rolename" name="rolename" placeholder="Enter your role name"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <x-input-error :messages="$errors->get('rolename')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="" class="block text-sm font-medium text-gray-700">Permission</label>
                            <select multiple name="permission[]" id="permission" class=" mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[30%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-[#ccc]  py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 ">Create Role</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
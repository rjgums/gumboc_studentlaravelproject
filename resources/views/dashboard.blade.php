<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    @if (session('success') && session('newStudent'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                            <div class="mt-1">We've sent a confirmation to {{ session('newStudent')->email }}.</div>
                        </div>
                    @elseif(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                        </div>
                    @endif
                    @if (session('success_deleted'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">{{ session('success_deleted') }}</strong>
                        </div>
                    @endif
                    <h3 class="text-lg font-medium mb-4">Add New Student</h3>
                    <form method="POST" action="{{ route('student.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-grey-700">Name</label>
                                <input type="text" id="name" name="name"
                                    class="mt-1 block
                                w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="email" class="block text-grey-700">Email</label>
                                <input type="email" id="email" name="email"
                                    class="mt-1 block
                                w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="phone" class="block text-grey-700">Phone</label>
                                <input type="text" id="phone" name="phone"
                                    class="mt-1 block
                                w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="address" class="block text-grey-700">Address</label>
                                <input type="text" id="address" name="address"
                                    class="mt-1 block
                                w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button id="submitButton" type="submit"
                                class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <span id="buttonText">Add Student</span>
                                <svg id="spinner" class="hidden animate-spin ml-2 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                                </svg>
                            </button>

                        </div>
                    </form>
                </div>
                <div class="mt-8">
                    <h3 class="text-lg font-medium mb-4">Student List</h3>
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="py-2 border-b">#</th>
                                <th class="py-2 border-b">Name</th>
                                <th class="py-2 border-b">Email</th>
                                <th class="py-2 border-b">Phone</th>
                                <th class="py-2 border-b">Address</th>
                                <th class="py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="students-table">
                            @foreach ($students as $key => $student)
                                <tr>
                                    <td class="py-2 border-b px-4 text-center">{{ $key + 1 }}</td>
                                    <td class="py-2 border-b px-4 text-center">{{ $student->name }}</td>
                                    <td class="py-2 border-b px-4 text-center">{{ $student->email }}</td>
                                    <td class="py-2 border-b px-4 text-center">{{ $student->phone }}</td>
                                    <td class="py-2 border-b px-4 text-center">{{ $student->address }}</td>
                                    <td class="py-2 border-b px-4 text-center">
                                        <a href="{{ route('student.edit', $student->id) }}"
                                            class ="text-blue-500 hover:text-blue-500">Edit</a> |
                                        <form method="POST" action="{{ route('student.destroy', $student->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <div></div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector('form[action="{{ route('student.store') }}"]');
            const submitButton = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const spinner = document.getElementById('spinner');

            form?.addEventListener('submit', function() {
                submitButton.disabled = true;
                buttonText.textContent = 'Processing';
                spinner.classList.remove('hidden');
            });
        });
    </script>

</x-app-layout>

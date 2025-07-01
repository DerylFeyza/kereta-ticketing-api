<x-layout title="Register">
    <div class="flex items-center justify-center h-full" style="height: 70vh;">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4 text-center">Register</h1>

            <form method="POST" action="{{ url('/register') }}">
                @csrf


                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name:</label>
                    <input type="name" id="name" name="name" class="w-full px-3 py-2 border rounded "
                        required>
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username:</label>
                    <input type="username" id="username" name="username" class="w-full px-3 py-2 border rounded "
                        required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded"
                        required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded "
                        required>
                </div>

                <div class="mb-4">
                    <label for="NIK" class="block text-gray-700">NIK:</label>
                    <input type="NIK" id="NIK" name="NIK" class="w-full px-3 py-2 border rounded "
                        required>
                </div>

                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700">alamat:</label>
                    <input type="alamat" id="alamat" name="alamat" class="w-full px-3 py-2 border rounded "
                        required>
                </div>

                <div class="mb-4">
                    <label for="telp" class="block text-gray-700">telp:</label>
                    <input type="telp" id="telp" name="telp" class="w-full px-3 py-2 border rounded "
                        required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Login
                </button>

                @error('error')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </form>
        </div>
    </div>
</x-layout>

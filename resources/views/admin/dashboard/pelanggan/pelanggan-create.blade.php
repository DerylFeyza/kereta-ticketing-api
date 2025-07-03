<x-adminsidebar>
    <div class="lg:ml-64 min-h-screen bg-gray-50 ">
        <div class="max-w-4xl mx-auto space-y-6  py-6">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">User Information</h3>
                            <p class="mt-1 text-sm text-gray-500">Fill in the details to create a new user account</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Required fields</span>
                        </div>
                    </div>
                </div>

                <x-pelanggan-form :action="route('pelanggan.store')" method="POST" :user="null" />

            </div>
            <x-pelanggan-form-help />
        </div>

        <script>
            function togglePassword(fieldId) {
                const field = document.getElementById(fieldId);
                const eye = document.getElementById(fieldId + '-eye');

                if (field.type === 'password') {
                    field.type = 'text';
                    eye.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        `;
                } else {
                    field.type = 'password';
                    eye.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
                }
            }

            // Auto-format NIK input (numbers only)
            document.getElementById('NIK').addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // Auto-format phone input (numbers only)
            document.getElementById('telp').addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9+\-\s]/g, '');
            });

            // Username validation (letters, numbers, underscores only)
            document.getElementById('username').addEventListener('input', function(e) {
                this.value = this.value.replace(/[^a-zA-Z0-9_]/g, '').toLowerCase();
            });
        </script>

    </div>


</x-adminsidebar>

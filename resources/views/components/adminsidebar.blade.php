<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'App' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<header class="flex items-center justify-between bg-blue-600 text-white px-6 py-4 lg:hidden">
    <button @click="sidebarOpen = true" class="focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</header>

<body x-data="{ sidebarOpen: false }" x-init="init()" @resize.window="sidebarState"><!-- Sidebar backdrop for mobile -->
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"
        @click="sidebarOpen = false">
    </div>

    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen || window.innerWidth >= 1024 ? 'translate-x-0' : '-translate-x-full'">


        <!-- Sidebar header -->
        <div class="flex items-center justify-between h-16 px-6 bg-blue-600">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-semibold text-white">Train Manager</h1>
                    <p class="text-xs text-blue-100">Admin Dashboard</p>
                </div>
            </div>

            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false" class="lg:hidden text-white hover:text-blue-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="mt-8 px-4">
            <ul class="space-y-2">
                <!-- Kereta Api Menu -->
                <li>
                    <a
                        class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 group {{ request()->routeIs('kereta-api.*') ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500 {{ request()->routeIs('kereta-api.*') ? 'text-blue-500' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        <span class="font-medium">Kereta Api</span>
                        @if (request()->routeIs('kereta-api.*'))
                            <div class="ml-auto w-2 h-2 bg-blue-600 rounded-full"></div>
                        @endif
                    </a>
                </li>

                <!-- User Menu -->
                <li>
                    <a href="{{ route('admin.dashboard.pelanggan.index') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 group {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500 {{ request()->routeIs('users.*') ? 'text-blue-500' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <span class="font-medium">User</span>
                        @if (request()->routeIs('users.*'))
                            <div class="ml-auto w-2 h-2 bg-blue-600 rounded-full"></div>
                        @endif
                    </a>
                </li>

                <!-- Petugas Menu -->
                <li>
                    <a
                        class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 group {{ request()->routeIs('petugas.*') ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : '' }}">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500 {{ request()->routeIs('petugas.*') ? 'text-blue-500' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <span class="font-medium">Petugas</span>
                        @if (request()->routeIs('petugas.*'))
                            <div class="ml-auto w-2 h-2 bg-blue-600 rounded-full"></div>
                        @endif
                    </a>
                </li>
            </ul>
        </nav>

        <!-- User profile section -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <img class="w-10 h-10 rounded-full"
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=3b82f6&color=fff"
                        alt="User avatar">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </p>
                    <p class="text-xs text-gray-500 truncate">
                        {{ auth()->user()->email ?? 'admin@example.com' }}
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{ $slot }}

    <script>
        function sidebarState() {
            return {
                sidebarOpen: window.innerWidth >= 1024,

                init() {
                    this.sidebarOpen = window.innerWidth >= 1024;
                },

                handleResize() {
                    if (window.innerWidth >= 1024) {
                        this.sidebarOpen = true;
                    }
                }
            };
        }

        @if ($errors->any())
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += `{{ $error }}\n`;
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: errorMessages.trim(),
                customClass: {
                    popup: 'text-sm'
                }
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}'
            });
        @elseif (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</body>


</html>

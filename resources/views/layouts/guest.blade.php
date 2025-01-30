<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="flex bg-white rounded-lg overflow-hidden w-4/5 md:w-4/5 lg:w-4/5 xl:w-4/5 min-h-[800px]">
            <!-- Left Side (Image) -->
            <div class="w-2/3  hidden md:flex bg-[#7ABCA0]  justify-center  ">
                <div class="xl:w-2/3 w-full flex justify-center items-center">
                    <img src="{{ asset('assets/images/local/login.jpeg') }}" alt="login-image" />"

                </div>

            </div>
            <!-- Right Side (Login Form) -->
            <div class="w-full md:w-3/3 lg:w-2/3 xl:w-1/3 p-6">
                <!-- Form Login -->

                <form wire:submit.prevent="login" class="h-full">
                    {{ $slot }}
                </form>
            </div>
        </div>
    </div>
    @livewireScripts
</body>




</html>

<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="h-full">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="h-full">
        <div class="h-full flex flex-col justify-between ">
            <!-- App Name -->
            <div class="text-center">
                <h1 class="text-md  text-gray-600"></h1>
            </div>

            <div class="w-[80%] mx-auto">
                <!-- Welcome Text -->
                <div class="text-center mb-10">
                    <p class="text-4xl text-gray-800 font-bold">Welcome Back!</p>
                    <p class="text-md text-gray-400">Please enter your username and password.</p>
                </div>

                <div class="mb-5">
                    <x-input-label for="username" :value="__('username')" />
                    <x-text-input wire:model="form.username" id="username"
                        class="block mt-1 w-full h-[55px] text-lg rounded-lg border-gray-300 focus:ring-2 focus:ring-orange-500"
                        type="text" name="username" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.username')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input wire:model="form.password" id="password"
                        class="block mt-1 w-full h-[55px] text-lg rounded-lg border-gray-300 focus:ring-2 focus:ring-orange-500"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class=" mt-2 mb-10 flex justify-end">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Login Button -->
                <div>
                    <x-primary-button>
                        {{ __('LOGIN') }}
                    </x-primary-button>
                </div>
            </div>

            <p class="text-center text-gray-400 text-sm">
                Warehouse app ver 1.0
            </p>
        </div>
    </form>

</div>

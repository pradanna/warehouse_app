<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $username = ''; // Tambahkan deklarasi untuk username
    public string $password = '';
    public string $password_confirmation = '';

    public string $message = ''; // Untuk feedback message

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        logger('Register function triggered!');

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Encrypt password before saving
        $validated['password'] = Hash::make($validated['password']);

        try {
            // Create the user
            $user = User::create($validated);

            // Trigger the Registered event
            event(new Registered($user));

            // Log the user in
            Auth::login($user);

            // Provide success message
            $this->message = 'Registration successful. Welcome!';

            // Redirect to the dashboard
            $this->redirect(route('dashboard', absolute: false), navigate: true);
        } catch (\Exception $e) {
            // Handle exception and provide error message
            $this->message = 'Registration failed. Please try again.';
        }
    }
};
?>

<div>
    <form wire:submit.prevent="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" type="text" name="name"
                class="block mt-1 w-full h-[55px] text-lg rounded-lg border-gray-300 focus:ring-2 focus:ring-orange-500"
                required autofocus autocomplete />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username Address -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input wire:model="username" id="username" type="text" name="username"
                class="block mt-1 w-full h-[55px] text-lg rounded-lg border-gray-300 focus:ring-2 focus:ring-orange-500"
                required autocomplete />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" type="password" name="password"
                class="block mt-1 w-full h-[55px] text-lg rounded-lg border-gray-300 focus:ring-2 focus:ring-orange-500"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" type="password"
                class="block mt-1 w-full h-[55px] text-lg rounded-lg border-gray-300 focus:ring-2 focus:ring-orange-500"
                required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Feedback Message -->
        @if ($message)
            <div class="mt-4 text-center">
                <p class="text-lg text-green-600">{{ $message }}</p>
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</div>

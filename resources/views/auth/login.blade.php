@extends('layouts.app')
@section('page')
    <!-- Session Status -->
    <div class="mb-4">{{ session('status') }}</div>

    <form method="POST" action="{{ route('login') }}" class="mx-auto max-w-2xl">
        @csrf

        <div>
            <h2>Please login</h2>
        </div>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <div class="mt-2">{{ $errors->has('email') }}</div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <div class="mt-2">{{ $errors->has('password') }}</div>
        </div>

        <!-- Remember Me -->
        <div class=" mt-4 block">
            <x-input-label for="remember_me" class="inline-flex items-center" />
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            <div class="flex gap-2 w-full justify-end">
                <p>Not registered yet ?</p>
                <a href="{{ route('register') }}"> Register</a>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
@endsection

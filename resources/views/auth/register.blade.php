@extends('front.app')
@section('content')
<div class="register-form">
    <div class="d-flex flex-column align items-center justify-content-center">
         <!-- Session Status -->
         <x-auth.session-status :status="session('status')" />
        <!-- Validation Errors -->
        <x-auth.validation-errors :errors="$errors" />
        <h3 class="text-center">Register</h3>
    </div>
    <form class="user-form" name="register-form" method="POST" action="{{ route('register') }}">
        <div class="">
            @csrf

            <div class="d-flex row justify-content-center">
                <div class="">
                    <!-- Name -->
                    <div class="mt-4 input-register">
                        <label for="name">Name</label>
                        <input id="username" class="form-control" type="text" name="name" placeholder="Your name" value="{{ old('name') }}" required autofocus>
                        <div id="errorname"></div>
                        <!-- Email Address -->
                        <x-auth.input-email />
                    </div>
                </div>
                <!-- Password -->
                <div class="ml-5 input-register">
                    <x-auth.input-password />
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Confirm your Password" required>
                        <div id="errorPasswordConfirm"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center submit-register">
                <x-auth.submit title="Register" />
            </div>
        </div>

    </form>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100" style="max-width: 400px;">
        <div class="card shadow">
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="w-10 mx-auto" style="max-width: 200px;">
                        @include('svgs.hogwarts-crest')
                    </div>
                </div>
                <h1 class="h4 mb-4 text-center">{{__('auth.login')}}</h1>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{route('login.submit')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('auth.email')}}</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{__('auth.password_label')}}</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">{{__('auth.login')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

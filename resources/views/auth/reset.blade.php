@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <h1 class="text-center pb-5"><strong>{{ __('RESET PASSWORD') }}</strong></h1>

            @if (session('token'))
                <div class="alert alert-success" role="alert">
                    In real life app this link below will be sent to your email
                    <br>
                    <a href="{{ route('change_password', ['token' => session('token')]) }}">{{ route('change_password', ['token' => session('token')]) }}</a>
                </div>
            @endif

            <form method="POST" action="{{ route('reset_password') }}">
                @csrf

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-secondary">
                            {{ __('Send Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

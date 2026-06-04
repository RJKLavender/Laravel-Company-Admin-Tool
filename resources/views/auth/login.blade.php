@extends('layouts.app')
@section('title', 'Company Admin Tool Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card login-card mt-2">
                <div class="card-header login-header py-3 text-center uppercase tracking-wider">
                    {{ __('Login') }}
                </div>

                <div class="card-body py-4 px-md-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Row -->
                        <div class="row mb-3">
                            
                            <label for="email" class="col-md-12 form-label">{{ __('Email Address') }}</label>

                            <!-- Changed to col-md-6 so it doesn't fill the whole box -->
                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Row -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-12 form-label">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mb-0">
                            <div class="justify-content-center flex-row d-sm-flex mt-1">
                                <button type="submit" class="btn btn-purple px-4 fw-bold">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

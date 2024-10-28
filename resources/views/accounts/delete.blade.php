@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Delete Account Request</div>

                <div class="card-body">
                    
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <p><strong>Note :</strong>For delete your account , confirm your email address</p>
                            <p class="text-muted">We will send you an otp to your email address</p>
                            <p class="text-danger"><strong >Warning :</strong><small>After verify your email your all data wil be deleted and not able to recover</small></p>

                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4 mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        Verify
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

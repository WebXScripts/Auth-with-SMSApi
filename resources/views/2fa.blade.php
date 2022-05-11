@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">2FA Verification</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('2fa.store') }}">
                            @csrf

                            <p class="text-center">We sent code to your phone : {{ substr(auth()->user()->number, 0, 5) . '***' . substr(auth()->user()->number,  -2) }}</p>

                            @if ($message = Session::get('error'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger alert-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label for="code" class="col-md-4 col-form-label text-md-end">Code</label>

                                <div class="col-md-6">
                                    <input id="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                        <a class="btn btn-link" href="{{ route('2fa.resend') }}">Resend Code?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

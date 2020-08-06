@extends('layouts.app')

@section('content')
<style>
    textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {   
        border-color: rgb(255,0,0);
        box-shadow: 0 1px 1px rgb(255,0,0) inset, 0 0 8px rgb(255,0,0);
        outline: 0 none;
    }
</style>
<div class="container">
    <div class="row justify-content-center pt-4">
        <div class="col-md-8">

            @if(session()->has('status'))
                <div class="row justify-content-center">
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('status') }}
                    </div>
                </div>
            @endif


            <div class="card">
                <div class="card-header">{{ __('réinitialiser votre mot de passe') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updatepassword') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmez le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Réinitialiser') }}
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

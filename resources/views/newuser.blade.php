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
    .mycheckbox{
        margin-top: 0.4rem;
        margin-left: 0.1rem;
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
                <div class="card-header">{{ __('Ajouter un utilisateur') }}</div>

                <div class="card-body">
                    <form method="POST" id="myForm" action="{{ route('createuser') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom d\'utilisateur') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Type de Utilisateur') }}</label>

                            <div class="col-md-6 form-check">
                                
                                <label class="text-md-right mycheckbox">
                                    {{ __('lecture seulement') }}
                                    <input id="onlyread"  type="radio" class="form-check-input mycheckbox @error('onlyread') is-invalid @enderror" name="checkinfo" value="{{ old('onlyread','onlyread') }}">
                                </label>

                                <label class="text-md-right mycheckbox" style="margin-left: 10px;">
                                    {{ __('TE_Shipment') }}
                                    <input id="TE_chipment" type="radio" class="form-check-input mycheckbox @error('TE_chipment') is-invalid @enderror" name="checkinfo" value="{{ old('TE_Shipment','TE_chipment') }}">
                                </label>

                                <label class="text-md-right mycheckbox" style="margin-left: 10px;">
                                    {{ __('Tractionnaire') }}
                                    <input id="Tractionnaire" type="radio" checked class="form-check-input mycheckbox @error('Tractionnaire') is-invalid @enderror" name="checkinfo" value="{{ old('Tractionnaire','Tractionnaire') }}">
                                </label>

                            </div>
                        </div>
                        


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="ajouter" type="submit" onclick="submitFunction()" class="btn btn-danger">
                                    {{ __('Ajouter Utilisateur') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <script>
                        function submitFunction() {
                            document.getElementById("myForm").submit();
                            document.getElementById("ajouter").disabled = true;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

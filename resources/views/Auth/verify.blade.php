@extends('layouts.app')

@section('content')
<link rel="icon" type="image/x-icon" href="AZIM_LOGO.png">
<style>
    body {
        background-color: #f0f8ff; /* Light blue background */
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color:indianred;
        color: white;
        border-radius: 15px 15px 0 0;
        text-align: center;
        font-size: 1.5rem;
    }
    .card-body {
        text-align: center;
    }
    .btn-link {
        color: #007bff;
    }
    .btn-link:hover {
        color: #0056b3;
    }
    .alert-success {
        margin-top: 15px;
    }
    .note {
        margin-top: 20px;
        color: red;
        font-weight: bold;
    }
</style>

<div class="container">
    <center>
<img style="width:250px; height:250px;" class="logo-img logo-dark" src="../AZIM_LOGO.png" alt="">
    </center>
    <div class="row justify-content-center mt-5">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                    <p class="note">Note: <b>Please do not Logout or Exit from this page. The email Verification link must be opened within the same browser window.</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

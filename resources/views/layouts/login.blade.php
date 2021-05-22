@extends('layouts.master')

@section('title', 'Login')

@section('content')
<h1 class="">Log In</h1>
<p class="">Log in to your account to continue.</p>

@if(Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Ooops!</strong>  {{ Session::get('error_message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="text-left" action="{{ url('login') }}" method="post">
    @csrf
    <div class="form">

        <div id="email-field" class="field-wrapper input">
            <label for="email">Email</label>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <input id="email" name="email" type="email" class="form-control" placeholder="Email">
        </div>

        <div id="password-field" class="field-wrapper input mb-2">
            <div class="d-flex justify-content-between">
                <label for="password">PASSWORD</label>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
        </div>
        <div class="d-sm-flex justify-content-between">
            <div class="field-wrapper">
                <button type="submit" class="btn btn-primary" value="">Log In</button>
            </div>
        </div>

        <div class="division">
        </div>

        <p class="signup-link">Not registered ? <a href="{{ url('register') }}">Create an account</a></p>

    </div>
</form>
@endsection
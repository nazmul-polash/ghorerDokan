{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
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

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}



@extends('frontend.layouts.template')

@section('content')
   <!--Page Header-->
   <div class="page-header text-center">
      <div class="container">
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
               <div class="page-title">
                  <h1>Login</h1>
               </div>
               <!--Breadcrumbs-->
               <div class="breadcrumbs"><a href="index-2.html" title="Back to the home page">Home</a><span class="title"><i
                        class="icon anm anm-angle-right-l"></i>My Account</span><span class="main-title fw-bold"><i
                        class="icon anm anm-angle-right-l"></i>Login</span></div>
               <!--End Breadcrumbs-->
            </div>
         </div>
      </div>
   </div>
   <!--End Page Header-->

   <!--Main Content-->
   <div class="container">
      <div class="login-register pt-2">
         <div class="row">
            <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
               <div class="inner h-100">
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                  <form method="POST" action="{{ route('login') }}" class="customer-form">
                     @csrf
                     <h2 class="text-center fs-4 mb-3">Log In</h2>
                     <p class="text-center mb-4">If you have an account with us, please log in.</p>
                     <div class="form-row">
                        <div class="form-group col-12">
                           <label for="CustomerEmail" class="d-none">Email <span class="required">*</span></label>
                           <input type="email" name="email" placeholder="Email" id="CustomerEmail"
                              value="{{ old('email') }}" required />
                           @error('email')
                              <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                        <div class="form-group col-12">
                           <label for="CustomerPassword" class="d-none">Password <span class="required">*</span></label>
                           <input type="password" name="password" placeholder="Password" id="CustomerPassword"
                              value="" required />
                           @error('password')
                              <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                        <div class="form-group col-12">
                           <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                              <div class="remember-check customCheckbox">
                                 {{-- <input id="remember" name="remember" type="checkbox" value="remember" required /> --}}
                                 <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                 <label for="remember"> Remember me</label>
                              </div>
                              <a href="forgot-password.html">Forgot your password?</a>
                           </div>
                        </div>
                        <div class="form-group col-12 mb-0">
                           <button type="submit" class="btn btn-primary btn-lg w-100">Sign In</button>
                        </div>
                     </div>

                     <div class="login-divide"><span class="login-divide-text">OR</span></div>

                     <p class="text-center fs-6 text-muted mb-3">Sign in with social account</p>
                     <div class="login-social d-flex-justify-center">
                        <a class="social-link facebook rounded-5 d-flex-justify-center" href="#"><i
                              class="icon anm anm-facebook-f me-2"></i> Facebook</a>
                        <a class="social-link google rounded-5 d-flex-justify-center" href="#"><i
                              class="icon anm anm-google-plus-g me-2"></i> Google</a>
                        <a class="social-link twitter rounded-5 d-flex-justify-center" href="#"><i
                              class="icon anm anm-twitter me-2"></i> Twitter</a>
                     </div>

                     <div class="login-signup-text mt-4 mb-2 fs-6 text-center text-muted">
                        Don,t have an   account?
                        <a href="{{ route('register') }}" class="btn-link">Sign up now</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--End Main Content-->
@endsection

@extends('auth.layouts.app')
@section('title', 'Admin Login')
@section('content')


                <div class="auth-form-dark text-left p-5">
                    <h2>Login</h2>
                    <h4 class="font-weight-light">Hello! let's get started</h4>
                    <form class="pt-5" method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" >{{ __('E-Mail Address') }}</label>
                             <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                             <i class="mdi mdi-account"></i>
                                @if (old('email'))
                                    <span style="display: block;" class="invalid-feedback" role="alert">
                                        <strong>Email Id or password mismatched</strong>
                                    </span>
                                @endif
                          
                        </div>

                        <div class="form-group">
                            <label for="password" >{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <i class="mdi mdi-eye"></i>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    

                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                               
                        </div>

                        <div class="mt-5">
                                <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium">
                                    {{ __('Login') }}
                                </button>
                        </div>
                        <div class="mt-5 text-center">
                                <a class="auth-link text-white" href="{{ route('admin.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                        </div>
                          
                        </div>
                    </form>
                </div>
            
@endsection

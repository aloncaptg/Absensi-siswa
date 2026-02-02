@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="logo-container">
    <img src="{{ asset('images/smk-budi-luhur.png') }}" alt="SMK Budi Luhur" class="school-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
    <div class="logo-fallback" style="display: none;">
        <i class="fas fa-school" style="font-size: 60px; color: #667eea;"></i>
    </div>
</div>
<h1 class="login-title">Login</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <div class="form-group">
        <label class="form-label">Username</label>
        <div class="input-wrapper">
            <i class="fas fa-user input-icon"></i>
            <input type="text" 
                   class="form-input @error('email') error @enderror" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="Type your username" 
                   required 
                   autofocus>
        </div>
        @error('email')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <label class="form-label" style="margin-bottom: 0;">Password</label>
            <a href="{{ route('password.request') }}" class="forgot-password" style="margin: 0;">
                <span style="font-size: 13px; color: #4a4a4a;">Forgot password?</span>
            </a>
        </div>
        <div class="input-wrapper">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" 
                   class="form-input @error('password') error @enderror" 
                   name="password" 
                   placeholder="Type your password" 
                   required>
        </div>
        @error('password')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="login-button">LOGIN</button>
</form>

<div class="divider">Or Sign Up Using</div>

<div class="social-login">
    <div class="social-icon facebook">
        <i class="fab fa-facebook-f"></i>
    </div>
    <div class="social-icon twitter">
        <i class="fab fa-twitter"></i>
    </div>
    <div class="social-icon google">
        <i class="fab fa-google"></i>
    </div>
</div>

<div class="divider">Or Sign Up Using</div>

<div class="signup-link">
    <div class="signup-link-text">Don't have an account?</div>
    <a href="{{ route('register') }}">SIGN UP</a>
</div>
@endsection

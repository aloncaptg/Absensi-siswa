@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="logo-container">
    <img src="{{ asset('images/smk-budi-luhur.png') }}" alt="SMK Budi Luhur" class="school-logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
    <div class="logo-fallback" style="display: none;">
        <i class="fas fa-school" style="font-size: 60px; color: #667eea;"></i>
    </div>
</div>
<h1 class="login-title">Sign Up</h1>

<form method="POST" action="{{ route('register') }}">
    @csrf
    
    <div class="form-group">
        <label class="form-label">Name</label>
        <div class="input-wrapper">
            <i class="fas fa-user input-icon"></i>
            <input type="text" 
                   class="form-input @error('name') error @enderror" 
                   name="name" 
                   value="{{ old('name') }}" 
                   placeholder="Type your full name" 
                   required 
                   autofocus>
        </div>
        @error('name')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Register As</label>
        <div class="input-wrapper">
            <i class="fas fa-user-tag input-icon"></i>
            <select name="role" 
                    class="form-input @error('role') error @enderror" 
                    required 
                    style="padding-left: 45px; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%239ca3af\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3E%3Cpolyline points=\'6 9 12 15 18 9\'%3E%3C/polyline%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 10px center; background-size: 16px;">
                <option value="">Select your role</option>
                <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru (Teacher)</option>
                <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Murid (Student)</option>
            </select>
        </div>
        @error('role')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group">
        <label class="form-label">Password</label>
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
    
    <div class="form-group">
        <label class="form-label">Confirm Password</label>
        <div class="input-wrapper">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" 
                   class="form-input" 
                   name="password_confirmation" 
                   placeholder="Confirm your password" 
                   required>
        </div>
    </div>
    
    <button type="submit" class="login-button">SIGN UP</button>
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
    <div class="signup-link-text">Already have an account?</div>
    <a href="{{ route('login') }}">LOGIN</a>
</div>
@endsection

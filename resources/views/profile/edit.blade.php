@extends('layouts.app')

@section('title','Profile')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>
@endsection

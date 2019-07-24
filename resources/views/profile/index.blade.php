@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/edit_profile') }}">Edit Profile</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/edit_profile_image') }}">Change image</a></li>
    </ol>
    <div class="row justify-content-center">
        @include('profile.sidebar')       
        @foreach($userData as $user) 
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center; color: rgb(39, 150, 249);">User Name : {{ ucwords( $user->name) }}</h5>
                            <div class="card" style="width: 18rem;">

                                <img class="card-img-top" src="{{ asset('public/img')}}/{{ $user->pic }}" alt="Profile Image">
                                <div class="card-body">
                                    <p class="card-text">{{ $user->city }}- {{$user->country }}</p>
                                    @if( $user->user_id ==  Auth::user()->id )
                                    <a href="{{ route('edit_profile') }} " class="btn btn-primary">Edit Profile</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title btn-primary" style="text-align: center;">About</h5>
                            <h5 class="card-title" style="text-align: center; color: rgb(39, 150, 249);"> {{ $user->about }}</h5>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

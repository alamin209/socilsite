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
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center; color: rgb(39, 150, 249);">User Name : {{ ucwords( Auth::user()->name) }}</h5>
                            <div class="card" style="width: 18rem;">

                                <img class="card-img-top" src="{{ asset('public/img')}}/{{ Auth::user()->pic }}" alt="Profile Image">
                                <div class="card-body">
                                    <p class="card-text">{{ $profile->city }}- {{$profile->country }}</p>
                                    <a href="{{ route('edit_profile_image') }} " class="btn btn-primary">Chnge Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title btn-primary" style="text-align: center;">Update Info</h5>
                            <form action="{{ URL::to('/updateProfileData') }}" method="POST">
                                <div class="form-group">
                                    @csrf 
                                    <label for="inputAddress">City</label>
                                    <input type="text" name="city" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{ $profile->city }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Country</label>
                                    <input type="text" name="country"  class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{ $profile->country}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">About</label>
                                    <textarea class="form-control" name="about" id="exampleFormControlTextarea1" rows="3">{{ $profile->about }}</textarea>
                                </div>


                                <button type="submit" class="btn btn-primary">Update Info</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

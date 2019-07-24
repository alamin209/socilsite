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
        <div class="col-md-8">
            <div class="card">
             
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Edit your Profile<br/>
                    <img src="{{ asset('public/img')}}/{{ Auth::user()->pic }}" class="img" height="60px" width="60px" ><br><br>
                  <hr>
                    <form action="{{ URL::to('/update_pic') }}" method="post" enctype="multipart/form-data">
                                      @csrf
                         <input type="file" name="profile_pic" class="" value="">
                         <br>
                        <input type="submit" class="btn btn-success" name="Update" value="update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

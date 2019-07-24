@extends('profile.master')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">Profile</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/edit_profile') }}">Edit Profile</a></li>
    </ol>
    <div id="row">
        <div class="row justify-content-center">
            @include('profile.sidebar')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ Auth::user()->name }} All Notification</div>
                    <div class="panel-body">
                        <div class="col-sm-12 col-md-12" >
                            <h4 class="bd-success text-primary  text-center " style="font-family:monospace;font-weight:bold">
                                @if(Session ::has('message'))
                                {{ session('message') }}
                                @endif
                            </h4>
                            @foreach($allnotification as $uList)
                            <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                <div class="col-md-2 pull-left" style="margin-bottom: 9px;">
                                    <img src="{{url('')}}/public/img/{{$uList->pic}}"
                                         width="80px" height="80px" class="img-rounded"/>
                                </div>
                                <div class="col-md-7 pull-left">
                                    <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$uList->slug}}">
                                            {{ucwords($uList->name)}}</a></h3>
                                    <p><i class="fa fa-globe"></i> Gender:@if($uList->gender) <?php echo "Male" ?> @else <?php echo "Female" ?> @endif</p>
                                    <p>{{ $uList->email }}</p>
                                </div>
                                <div class="col-md-3 pull-right" style="color:royalblue">
                                    <p>
                                        {{ $uList->note }}
                                    </p>
                                </div>
                          

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

</div>

@endsection

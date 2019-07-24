<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <title>Social Site</title>
        <script src="https://use.fontawesome.com/595a5020bd.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #ddd;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                margin: 0;
            }
            .top_bar{
                position:relative; width:99%; top:0; padding:5px; margin:0 5
            }
            .full-height {
                margin-top:50px
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right:5px; top:15px
            }
            .top-left {
                position: absolute;
                width:40%
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px0;
            }
            .head_har{
                background-color: #f6f7f9;
                border-bottom: 1px solid #dddfe2;
                border-radius: 2px 2px 0 0;
                font-weight: bold;
                padding: 8px 6px;
            }
            .left-sidebar, .right-sidebar{
                background-color:#fff;
                height:600px;
            }
            .posts_div{margin-bottom:10px !important;}
            .posts_div h3{
                margin-top:4px !important;
            }
            #postText{
                border:none;
                height:100px
            }
            .likeBtn{
                color: #4b4f56; font-weight:bold; cursor: pointer;
            }
            .left-sidebar li { padding:10px;
                               border-bottom:1px solid #ddd;
                               list-style:none; margin-left:-20px}
            .dropdown-menu{min-width:120px; left:-30px}
            .dropdown-menu a{ cursor: pointer;}
            .dropdown-divider {
                height: 1px;
                margin: .5rem 0;
                overflow: hidden;
                background-color: #eceeef;}
            .user_name{font-size:18px;
                       font-weight:bold; text-transform:capitalize; margin:3px}
            .all_posts{background-color:#fff; padding:5px;
                       margin-bottom:15px; border-radius:5px;
                       -webkit-box-shadow: 0 8px 6px -6px #666;
                       -moz-box-shadow: 0 8px 6px -6px #666;
                       box-shadow: 0 8px 6px -6px #666;}
            #commentBox{
                background-color:#ddd;
                padding:10px;
                width:99%; margin:0 auto;
                background-color:#F6F7F9;
                padding:10px;
                margin-bottom:10px
            }
            #commentBox li { list-style:none; padding:10px; border-bottom:1px solid #ddd}
            .commet_form{ padding:10px; margin-bottom:10px}
            .commentHand{color:blue}
            .commentHand:hover{cursor:pointer}
            .upload_wrap{
                position:relative;
                display:inline-block;
                width:100%
            }
            /*            .center-con{
                            max-height:600px;
                            position: absolute;
                            left:calc(25%);
                            overflow-y: scroll;
                        }*/
            /*            @media (min-width: 268px) and (max-width: 768px) {
                            .center-con{
                                max-height:600px;
                                position: relative;
                                left:0px;
                                overflow-y: scroll;
                            }
                        }*/

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">DashBoard</a>

                <a href="{{ url('/profile') }}/{{ Auth::user()->slug }}">profile</a>

                @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
        </div>
        <br/><br/>

        <div class="container-fluid">
            <div class="col-md-12" id='app'>
                <div class="col-md-2 left-sidebar" style="width: 20%;" >
                    <h3>All Userss </h3>
                    <ul v-for="pvtmsgs in pvtmsg" style="">
                        <li @click="messegesid(pvtmsgs.id)" style=" background-color:#ddd; padding: 3px " >
                            <img  :src="'{{ asset('public/img')}}/'+ pvtmsgs.pic"  width="50px" style="border-radius:100%">

                                @{{ pvtmsgs.name }}
                                <p>Messge will display here</p>

                        </li> 
                    </ul>
                    <hr>
                </div>
                <div class="col-md-7  right-sidebar" style="width: 58%;">
                    <h3>Messge Here </h3>
                    <hr>
                    <?php echo Auth::user()->id ?>
                    <div v-for="sn in  singlemessge">
                        <div v-if="sn.user_from == <?php echo Auth::user()->id ?> ">
                            <div style="float:right; background:windowframe;  padding:15px; border-radius:10px; margin: 20px 61px 20px 20px; " class="col-md-6" >
                                @{{ sn.mgs }}
                            </div>
                        </div>
                        <div v-else>
                            <div  class="col-md-9">
                                <div style="folat:left; background:orchid;padding:15px; border-radius:10px ;   margin: 6px 54px 26px 47px ">
                                    @{{ sn.mgs }}
                                </div>
                                <img  :src="'{{ asset('public/img')}}/'+ sn.pic"  style="border-radius:100%; width:64px;  margin:-75px -17px 10px ; float:right ">
                            </div>


                        </div>

                    </div>
                    <input type="text" v-model="conid">
                    <input type="text" v-model="user_id">
                     <textarea  class="col-md-12" style="margig-top:15px; border-radius: 50px" v-model="messFrom"  @keydown="inputhandeler"  > </textarea>
                     

                      
                </div>
                <div class="col-md-3 right-sidebar pull-right" style="width:22%;">
                    <h3>right sidbar </h3>
                    <hr>
                    sddddddddddd
                </div>





            </div>

            @endif


        </div>

    </body>

</html>
<script src="{{ asset('public/js/profile.js') }}"></script>
<script>
$(document).ready(function () {
    $('#postBtn').hide();
    $("#postText").hover(function () {
        $('#postBtn').show();
    });
});
</script>
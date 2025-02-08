@extends('layouts.app')

@section('content')
    @php
        use App\Models\User;
        $username = str_replace('/notifications','',$_SERVER['REQUEST_URI']);
        $username = str_replace('/','',$_SERVER['REQUEST_URI'])
    @endphp
    <section>
        <div class="feature-photo">
            <figure><img
                    src="{{asset('/storage/'.Auth::user()->profile->profileBackground)}}"
                    alt=""></figure>
            <div class="add-btn">
                @if(Auth::user()->followers !== null)
                    <span>{{count(Auth::user()->followers)}} followers</span>
                @else
                    <span>0 followers</span>
                @endif
            </div>
            <form class="edit-phto" id="editBackground" method="POST"
                  action="{{url('/' . Auth::user()->username . '/updateBackground')}}" enctype="multipart/form-data">
                @csrf
                <i class="fa fa-camera-retro"></i>
                <label class="fileContainer">
                    Edit Cover Photo
                    <input onchange="this.form.submit();" id="background" name="background" type="file"/>
                </label>
            </form>
            <div class="container-fluid">
                <div class="row merged">
                    <div class="col-lg-2 col-sm-3">
                        <div class="user-avatar">
                            <figure>
                                <img
                                    src="{{asset('/storage/'.Auth::user()->avatar)}}"
                                    alt="">
                                <form class="edit-phto" id="editAvatar" method="POST"
                                      action="{{url('/' . Auth::user()->username . '/updateAvatar')}}" enctype="multipart/form-data">
                                    @csrf
                                    <i class="fa fa-camera-retro"></i>
                                    <label class="fileContainer">
                                        Edit Display Photo
                                        <input onchange="this.form.submit();" id="avatar" name="avatar" type="file"/>
                                    </label>
                                </form>
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-9">
                        <div class="timeline-info">
                            <ul>
                                <li class="admin-name">
                                    <h5>{{Auth::user()->name}}</h5>
                                    <span>
                                        @if(Auth::user()->role_id===1)
                                            Admin
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <!--<a class="" href="time-line.html" title="" data-ripple="">time line</a>-->
                                    <a class="" href="{{url('/'.Auth::user()->username.'/posts')}}" title="" data-ripple="">Posts</a>
                                    <a class="" href="{{url('/'.Auth::user()->username.'/followers')}}" title="" data-ripple="">Followers</a>
                                    <a class="" href="{{url('/'.Auth::user()->username.'/following')}}" title="" data-ripple="">Following</a>
                                    <!--<a class="" href="timeline-groups.html" title="" data-ripple="">Groups</a>-->
                                    <a class="active" href="{{url('/'.Auth::user()->username)}}" title="" data-ripple="">about</a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- top area -->

    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            <div class="col-lg-3">

                                <aside class="sidebar static">
                                    @if($username === Auth::user()->username)
                                        <div class="widget">
                                            <h4 class="widget-title">Edit info</h4>
                                            <ul class="naves">
                                                <li>
                                                    <i class="ti-info-alt"></i>
                                                    <a title=""
                                                       href="{{url('/'.Auth::user()->username.'/edit-profile-basic')}}">Basic
                                                        info</a>
                                                </li>
                                                <li>
                                                    <i class="ti-lock"></i>
                                                    <a title="" href="{{url('/'.Auth::user()->username.'/changePassword')}}">change password</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    <!--<div class="widget">
                                        <h4 class="widget-title">Socials</h4>
                                        <ul class="socials">
                                            <li class="facebook">
                                                <a title="" href="#"><i class="fa fa-facebook"></i> <span>facebook</span> <ins>45 likes</ins></a>
                                            </li>
                                            <li class="twitter">
                                                <a title="" href="#"><i class="fa fa-twitter"></i> <span>twitter</span><ins>25 likes</ins></a>
                                            </li>
                                            <li class="google">
                                                <a title="" href="#"><i class="fa fa-google"></i> <span>google</span><ins>35 likes</ins></a>
                                            </li>
                                        </ul>
                                    </div>-->
                                </aside>
                            </div><!-- sidebar -->
                            <div class="col-lg-6">
                                <div class="central-meta">
                                    <div class="editing-interest">
                                        <h5 class="f-title"><i class="ti-bell"></i>All Notifications </h5>
                                        <div class="notification-box">
                                            <ul>
                                                @foreach(Auth::user()->unreadNotifications as $notification)
                                                <li>
                                                    <figure><img src="{{asset('/storage/'.$notification->data['reactionPlacer']['avatar'])}}" alt=""></figure>
                                                    <div class="notifi-meta">
                                                        <p>{{$notification->data['message']}} @if($notification->data['post']['image']!=='')<img style="height:45px;" class="ml-2" src="{{asset('/storage/'.$notification->data['post']['image'])}}">@endif</p>
                                                        <span>{{$notification->created_at}}</span>
                                                    </div>

                                                    <i onclick="document.getElementById('formDelete{{$notification->id}}').submit();" class="del fa fa-close"></i>
                                                    <form id="formDelete{{$notification->id}}" method="post" action="{{url('/deleteNotification')}}">
                                                        @csrf
                                                        <input type="hidden" name="notification" value="{{$notification->id}}"/>
                                                    </form>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- centerl meta -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

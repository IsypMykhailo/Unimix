@extends('layouts.app')

@section('content')
    @php
        use App\Models\User;
    @endphp
    <section>
        <div class="feature-photo">
            <figure><img
                    src="{{asset('/storage/'.User::query()->where('username', $username)->first()->profile->profileBackground)}}"
                    alt=""></figure>
            <div class="add-btn">
                @if(User::query()->where('username', $username)->first()->followers !== null)
                    <span>{{count(User::query()->where('username', $username)->first()->followers)}} followers</span>
                @else
                    <span>0 followers</span>
                @endif
                @if($username !== Auth::user()->username &&
                    \App\Models\Follower::query()->where('follower_id', Auth::user()->id)->
                        where('user_id', User::query()->where('username', $username)->first()->id)->first() === null)
                    <form method="post" action="{{url('/'.$username.'/follow')}}">
                        @csrf
                        <input type="submit" value="Follow"/>
                        <!--<a href="#" title="" data-ripple="">Follow</a>-->
                    </form>
                @elseif($username !== Auth::user()->username &&
                        \App\Models\Follower::query()->where('follower_id', Auth::user()->id)->
                        where('user_id', User::query()->where('username', $username)->first()->id)->first() !== null)
                    <form method="post" action="{{url('/'.$username.'/unfollow')}}">
                        @csrf
                        <input type="submit" value="Unfollow"/>
                        <!--<a href="#" title="" data-ripple="">Follow</a>-->
                    </form>
                @endif
            </div>
            @if(Auth::user()->username === $username)
                <form class="edit-phto" id="editBackground" method="POST"
                      action="{{url('/' . $username . '/updateBackground')}}" enctype="multipart/form-data">
                    @csrf
                    <i class="fa fa-camera-retro"></i>
                    <label class="fileContainer">
                        Edit Cover Photo
                        <input onchange="this.form.submit();" id="background" name="background" type="file"/>
                    </label>
                </form>
            @endif
            <div class="container-fluid">
                <div class="row merged">
                    <div class="col-lg-2 col-sm-3">
                        <div class="user-avatar">
                            <figure>
                                <img
                                    src="{{asset('/storage/'.User::query()->where('username', $username)->first()->avatar)}}"
                                    alt="">
                                @if(Auth::user()->username === $username)
                                    <form class="edit-phto" id="editAvatar" method="POST"
                                          action="{{url('/' . $username . '/updateAvatar')}}" enctype="multipart/form-data">
                                        @csrf
                                        <i class="fa fa-camera-retro"></i>
                                        <label class="fileContainer">
                                            Edit Display Photo
                                            <input onchange="this.form.submit();" id="avatar" name="avatar" type="file"/>
                                        </label>
                                    </form>
                                @endif
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-9">
                        <div class="timeline-info">
                            <ul>
                                <li class="admin-name">
                                    <h5>{{User::query()->where('username', $username)->first()->name}}</h5>
                                    <span>
                                        @if(User::query()->where('username', $username)->first()->role_id===1)
                                            Admin
                                        @endif
                                    </span>
                                </li>
                                <li id="elContainer">
                                    <!--<a class="" href="time-line.html" title="" data-ripple="">time line</a>-->
                                    <a class="" id="posts" href="{{url('/'.$username.'/posts')}}" title="" data-ripple="">Posts</a>
                                    <a class="" id="followers" href="{{url('/'.$username.'/followers')}}" title="" data-ripple="">Followers</a>
                                    <a class="" id="following" href="{{url('/'.$username.'/following')}}" title="" data-ripple="">Following</a>
                                    <!--<a class="" href="timeline-groups.html" title="" data-ripple="">Groups</a>-->
                                    <a class="" id="about" href="{{url('/'.$username)}}" title="" data-ripple="">about</a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- top area -->
    @yield('content2')

@endsection

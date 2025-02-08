@extends('layouts.app')

@section('content')
    @php
        use App\Models\User;
        $username = str_replace('/messages','',$_SERVER['REQUEST_URI']);
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
                                    <div class="messages">
                                        <h5 class="f-title"><i class="ti-bell"></i>All Messages <span class="more-options"><i class="fa fa-ellipsis-h"></i></span></h5>
                                        <div class="message-box">
                                            <ul class="peoples">

                                                <li>

                                                    <figure>
                                                        <img src="images/resources/friend-avatar2.jpg" alt="">
                                                        <span class="status f-online"></span>
                                                    </figure>
                                                    <div class="people-name">
                                                        <span>Molly cyrus</span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <figure><img src="images/resources/friend-avatar3.jpg" alt="">
                                                        <span class="status f-away"></span>
                                                    </figure>
                                                    <div class="people-name">
                                                        <span>Andrew</span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <figure>
                                                        <img src="images/resources/friend-avatar.jpg" alt="">
                                                        <span class="status f-online"></span>
                                                    </figure>

                                                    <div class="people-name">
                                                        <span>jason bourne</span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <figure><img src="images/resources/friend-avatar4.jpg" alt="">
                                                        <span class="status off-online"></span>
                                                    </figure>
                                                    <div class="people-name">
                                                        <span>Sarah Grey</span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <figure><img src="images/resources/friend-avatar5.jpg" alt="">
                                                        <span class="status f-online"></span>
                                                    </figure>
                                                    <div class="people-name">
                                                        <span>bill doe</span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <figure><img src="images/resources/friend-avatar6.jpg" alt="">
                                                        <span class="status f-away"></span>
                                                    </figure>
                                                    <div class="people-name">
                                                        <span>shen cornery</span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <figure><img src="images/resources/friend-avatar7.jpg" alt="">
                                                        <span class="status off-online"></span>
                                                    </figure>
                                                    <div class="people-name">
                                                        <span>kill bill</span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <figure><img src="images/resources/friend-avatar8.jpg" alt="">
                                                        <span class="status f-online"></span>
                                                    </figure>
                                                    <div class="people-name">
                                                        <span>jasmin walia</span>
                                                    </div>
                                                </li>
                                                <li>

                                                    <figure><img src="images/resources/friend-avatar6.jpg" alt="">
                                                        <span class="status f-online"></span>
                                                    </figure>
                                                    <div class="people-name">
                                                        <span>neclos cage</span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="peoples-mesg-box">
                                                <div class="conversation-head">
                                                    <figure><img src="images/resources/friend-avatar.jpg" alt=""></figure>
                                                    <span>jason bourne <i>online</i></span>
                                                </div>
                                                <ul class="chatting-area">
                                                    <li class="you">
                                                        <figure><img src="images/resources/userlist-2.jpg" alt=""></figure>
                                                        <p>what's liz short for? :)</p>
                                                    </li>
                                                    <li class="me">
                                                        <figure><img src="images/resources/userlist-1.jpg" alt=""></figure>
                                                        <p>Elizabeth lol</p>
                                                    </li>
                                                    <li class="me">
                                                        <figure><img src="images/resources/userlist-1.jpg" alt=""></figure>
                                                        <p>wanna know whats my second guess was?</p>
                                                    </li>
                                                    <li class="you">
                                                        <figure><img src="images/resources/userlist-2.jpg" alt=""></figure>
                                                        <p>yes</p>
                                                    </li>
                                                    <li class="me">
                                                        <figure><img src="images/resources/userlist-1.jpg" alt=""></figure>
                                                        <p>Disney's the lizard king</p>
                                                    </li>
                                                    <li class="me">
                                                        <figure><img src="images/resources/userlist-1.jpg" alt=""></figure>
                                                        <p>i know him 5 years ago</p>
                                                    </li>
                                                    <li class="you">
                                                        <figure><img src="images/resources/userlist-2.jpg" alt=""></figure>
                                                        <p>coooooooooool dude ;)</p>
                                                    </li>
                                                </ul>
                                                <div class="message-text-container">
                                                    <form method="post">
                                                        <textarea></textarea>
                                                        <button title="send"><i class="fa fa-paper-plane"></i></button>
                                                    </form>
                                                </div>
                                            </div>
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

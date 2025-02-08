<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Winku Social Network Toolkit</title>
    <link rel="icon" href="{{asset('/images/fav.png')}}" type="image/png" sizes="16x16">

    <!-- Scripts -->
    <!--<script src="{{ asset('/js/app.js') }}" defer></script>-->

    <link rel="stylesheet" href="{{asset('/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/color.css')}}">
    <link rel="stylesheet" href="{{asset('/css/responsive.css')}}">

    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <!-- Styles -->
    <!--<link href="{{ asset('/css/app.css') }}" rel="stylesheet">-->

    <!-- Scripts -->
    <!--@vite(['resources/sass/app.scss', 'resources/js/app.js'])-->
    <style>
        .follower_img{
            width:15%;
            height:15%;
            border: 1px solid rgba(0,0,0,0);
            border-radius: 50%;
            float:left;
            margin-right:5px;
        }
        .username{
            color:black;
            float:left;
        }
        .centerBlock{
            width:90%;
            margin:auto;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="theme-layout">

            <div class="topbar stick responsive-header">
                <div class="logo">
                    <a title="" href="{{url('/home')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
                </div>

                <div class="top-area">

                    <ul class="setting-area">
                        <li>
                            <a href="{{url('/search')}}" title="Home" data-ripple=""><i class="ti-search"></i></a>
                        </li>
                        <li>
                            <a href="#" title="Notification" data-ripple="">
                                <i class="ti-bell"></i><span>20</span>
                            </a>
                            <div class="dropdowns">
                                <span>4 New Notifications</span>
                                <ul class="drops-menu">
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-1.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>sarah Loren</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag green">New</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-2.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Jhon doe</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag red">Reply</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-3.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Andrew</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag blue">Unseen</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-4.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Tom cruse</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag">New</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-5.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Amy</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag">New</span>
                                    </li>
                                </ul>
                                <a href="notifications.html" title="" class="more-mesg">view more</a>
                            </div>
                        </li>
                        <li>
                            <a href="#" title="Messages" data-ripple=""><i class="ti-comment"></i><span>12</span></a>
                            <div class="dropdowns">
                                <span>5 New Messages</span>
                                <ul class="drops-menu">
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-1.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>sarah Loren</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag green">New</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-2.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Jhon doe</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag red">Reply</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-3.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Andrew</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag blue">Unseen</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-4.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Tom cruse</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag">New</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-5.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Amy</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag">New</span>
                                    </li>
                                </ul>
                                <a href="messages.html" title="" class="more-mesg">view more</a>
                            </div>
                        </li>
                    </ul>
                    <div class="user-img">
                        <!--<img src="{{asset('images/resources/admin.jpg')}}" alt="">-->
                        <img src="{{asset('/storage/'.Auth::user()->avatar)}}" alt="">
                        <span class="status f-online"></span>
                        <div class="user-setting">
                            <a href="{{url('/' . Auth::user()->username)}}" title=""><i class="ti-user"></i> view profile</a>
                            <a href="#" title=""><i class="ti-pencil-alt"></i>edit profile</a>
                            <a href="#" title=""><i class="ti-target"></i>activity log</a>
                            <a href="#" title=""><i class="ti-settings"></i>account setting</a>
                            <a href="{{ route('logout') }}" title="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off"></i>log out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- topbar -->

            <div class="topbar stick">
                <div class="logo">
                    <a title="" href="{{url('/home')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
                </div>

                <div class="top-area">
                    <ul class="setting-area">
                        <li>
                            <a href="{{url('/search')}}" title="Home" data-ripple=""><i class="ti-search"></i></a>
                        </li>
                        <li>
                            <a href="{{url('/notifications')}}" title="Notification" data-ripple="">
                                <i class="ti-bell"></i><span>{{count(Auth::user()->unreadNotifications)}}</span>
                            </a>
                            <div class="dropdowns">
                                <span>{{count(Auth::user()->unreadNotifications)}} New Notifications</span>
                                <ul class="drops-menu">
{{--                                    @foreach(Auth::user()->unreadNotifications as $notification)--}}
{{--                                    <li>--}}
{{--                                        <a href="{{url('/'.$notification->data['reactionPlacer']->username)}}" title="">--}}
{{--                                            <img src="{{asset('images/resources/thumb-1.jpg')}}" alt="">--}}
{{--                                            <div class="mesg-meta">--}}
{{--                                                <h6>{{$notification->data['reactionPlacer']->name}}</h6>--}}
{{--                                                <span>{{$notification->data['message']}}</span>--}}
{{--                                                <i>{{$notification->created_at}}</i>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                        <span class="tag green">Unseen</span>--}}
{{--                                    </li>--}}
{{--                                    @endforeach--}}
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="{{url('/messages')}}" title="Messages" data-ripple=""><i class="ti-comment"></i><span>12</span></a>
                            <!--<div class="dropdowns">
                                <span>5 New Messages</span>
                                <ul class="drops-menu">
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-1.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>sarah Loren</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag green">New</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-2.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Jhon doe</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag red">Reply</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-3.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Andrew</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag blue">Unseen</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-4.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Tom cruse</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag">New</span>
                                    </li>
                                    <li>
                                        <a href="notifications.html" title="">
                                            <img src="{{asset('images/resources/thumb-5.jpg')}}" alt="">
                                            <div class="mesg-meta">
                                                <h6>Amy</h6>
                                                <span>Hi, how r u dear ...?</span>
                                                <i>2 min ago</i>
                                            </div>
                                        </a>
                                        <span class="tag">New</span>
                                    </li>
                                </ul>
                                <a href="messages.html" title="" class="more-mesg">view more</a>
                            </div>-->
                        </li>
                    </ul>
                    <div class="user-img">
                        <!--<img src="{{asset('images/resources/admin.jpg')}}" alt="">-->
                        <img src="{{asset('/storage/'.Auth::user()->avatar)}}" alt="">
                        <span class="status f-online"></span>
                        <div class="user-setting">
                            <a href="{{url('/' . Auth::user()->username)}}" title=""><i class="ti-user"></i> view profile</a>
                            <a href="{{url('/'.Auth::user()->username.'/edit-profile-basic')}}" title=""><i class="ti-pencil-alt"></i>edit profile</a>
                            <a href="{{ route('logout') }}" title="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off"></i>log out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!--<span class="ti-menu main-menu" data-ripple=""></span>-->
                </div>
            </div><!-- topbar -->

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-4 col-md-4">
                        <div class="widget">
                            <div class="foot-logo">
                                <div class="logo">
                                    <a href="{{url('/home')}}" title=""><img src="{{asset('images/logo.png')}}" alt=""></a>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ullamcorper eget nulla facilisi etiam dignissim diam quis.
                                </p>
                            </div>
                            <ul class="location">
                                <li>
                                    <i class="ti-map-alt"></i>
                                    <p>8888 University Dr, Burnaby, BC V5A 1S6, Canada.</p>
                                </li>
                                <li>
                                    <i class="ti-mobile"></i>
                                    <p>+38 (067) 158-05-85</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="widget">
                            <div class="widget-title"><h4>follow</h4></div>
                            <ul class="list-style">
                                <li><i class="fa fa-facebook-square"></i> <a href="https://www.facebook.com/profile.php?id=100010348093298" target="_blank" title="">facebook</a></li>
                                <li><i class="fa fa-twitter-square"></i><a href="https://twitter.com/mike_isyp" target="_blank" title="">twitter</a></li>
                                <li><i class="fa fa-instagram"></i><a href="https://www.instagram.com/mike_isyp" target="_blank" title="">instagram</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="widget">
                            <div class="widget-title"><h4>Navigate</h4></div>
                            <ul class="list-style">
                                <li><a href="{{url('/contact')}}" title="">contact us</a></li>
                                <li><a href="{{url('/terms')}}" title="">terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--<div class="col-lg-2 col-md-4">
                        <div class="widget">
                            <div class="widget-title"><h4>useful links</h4></div>
                            <ul class="list-style">
                                <li><a href="#" title="">leasing</a></li>
                                <li><a href="#" title="">submit route</a></li>
                                <li><a href="#" title="">how does it work?</a></li>
                                <li><a href="#" title="">agent listings</a></li>
                                <li><a href="#" title="">view All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="widget">
                            <div class="widget-title"><h4>download apps</h4></div>
                            <ul class="colla-apps">
                                <li><a href="https://play.google.com/store?hl=en" title=""><i class="fa fa-android"></i>android</a></li>
                                <li><a href="https://www.apple.com/lae/ios/app-store/" title=""><i class="ti-apple"></i>iPhone</a></li>
                                <li><a href="https://www.microsoft.com/store/apps" title=""><i class="fa fa-windows"></i>Windows</a></li>
                            </ul>
                        </div>
                    </div>-->
                </div>
            </div>
        </footer><!-- footer -->
        <div class="bottombar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <span class="copyright"><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></span>
                        <i><img src="{{asset('images/credit-cards.png')}}" alt=""></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="side-panel">
        <h4 class="panel-title">General Setting</h4>
        <form method="post">
            <div class="setting-row">
                <span>use night mode</span>
                <input type="checkbox" id="nightmode1"/>
                <label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Notifications</span>
                <input type="checkbox" id="switch22" />
                <label for="switch22" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Notification sound</span>
                <input type="checkbox" id="switch33" />
                <label for="switch33" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>My profile</span>
                <input type="checkbox" id="switch44" />
                <label for="switch44" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Show profile</span>
                <input type="checkbox" id="switch55" />
                <label for="switch55" data-on-label="ON" data-off-label="OFF"></label>
            </div>
        </form>
        <h4 class="panel-title">Account Setting</h4>
        <form method="post">
            <div class="setting-row">
                <span>Sub users</span>
                <input type="checkbox" id="switch66" />
                <label for="switch66" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>personal account</span>
                <input type="checkbox" id="switch77" />
                <label for="switch77" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Business account</span>
                <input type="checkbox" id="switch88" />
                <label for="switch88" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Show me online</span>
                <input type="checkbox" id="switch99" />
                <label for="switch99" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Delete history</span>
                <input type="checkbox" id="switch101" />
                <label for="switch101" data-on-label="ON" data-off-label="OFF"></label>
            </div>
            <div class="setting-row">
                <span>Expose author name</span>
                <input type="checkbox" id="switch111" />
                <label for="switch111" data-on-label="ON" data-off-label="OFF"></label>
            </div>
        </form>
    </div><!-- side panel -->

    <script data-cfasync="false" src="{{asset('../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
        <script src="{{asset('js/main.min.js')}}"></script>
        <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/map-init.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>
    </div>
</body>
</html>

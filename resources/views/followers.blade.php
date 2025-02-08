@extends('layouts.profileLayout')

@section('content2')
    @php
        use App\Models\User;
        //$username = str_replace('/followers','',$_SERVER['REQUEST_URI']);
        //$username = str_replace('/','',$username);
    @endphp
    <script>
        let elContainer = document.getElementById('elContainer');
        for(let element of elContainer.children){
            element.classList.remove('active');
        }
        let followers = document.getElementById('followers');
        followers.classList.add('active');
    </script>

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
                                </aside>
                            </div><!-- sidebar -->
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-4">
                                <div class="central-meta">
                                    <div class="about">
                                        <div class="centerBlock d-flex flex-column personal mb-4">
                                                @foreach($followers as $follower)
                                                <p class="m-2" style="cursor:pointer" onclick="window.location.href='{{url('/'.$follower->follower->username)}}'">
                                                    <img class="follower_img" src="{{asset('/storage/'.$follower->follower->avatar)}}" align="middle">
                                                    <span class="username">{{$follower->follower->username}}</span><br>
                                                    <span>{{$follower->follower->name}}</span>
                                                </p>
                                                @endforeach

                                        </div>
                                        <a class="btn btn-primary" href="{{$followers->previousPageUrl()}}">Previous</a>
                                        <a class="btn btn-primary" href="{{$followers->nextPageUrl()}}">Next</a>
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


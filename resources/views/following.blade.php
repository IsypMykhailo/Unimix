@extends('layouts.profileLayout')

@section('content2')
    @php
        use App\Models\User;
        //$username = str_replace('/following','',$_SERVER['REQUEST_URI']);
        //$username = str_replace('/','',$username);
    @endphp
    <script>
        let elContainer = document.getElementById('elContainer');
        for(let element of elContainer.children){
            element.classList.remove('active');
        }
        let following = document.getElementById('following');
        following.classList.add('active');
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
                            <div class="col-lg-1">

                            </div>
                            <div class="col-lg-4">
                                <div class="central-meta">
                                    <div class="about">
                                        <div class="centerBlock d-flex flex-column personal mb-4">
                                            @foreach($followers as $follower)
                                                <p class="m-2" style="cursor:pointer;" onclick="window.location.href='{{url('/'.$follower->user->username)}}'">
                                                    <img class="follower_img" src="{{asset('/storage/'.$follower->user->avatar)}}" align="middle">
                                                    <span class="username">{{$follower->user->username}}</span><br>
                                                    <span>{{$follower->user->name}}</span>
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



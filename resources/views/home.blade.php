@extends('layouts.app')

@section('content')
    @php
    use App\Models\User;
    @endphp
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            <div class="col-lg-3">
                                <aside class="sidebar static">
                                    <div class="widget">
                                        <h4 class="widget-title">Shortcuts</h4>
                                        <ul class="naves">
                                            <!--<li>
                                                <i class="ti-clipboard"></i>
                                                <a href="newsfeed.html" title="">News feed</a>
                                            </li>
                                            <li>
                                                <i class="ti-mouse-alt"></i>
                                                <a href="inbox.html" title="">Inbox</a>
                                            </li>
                                            <li>
                                                <i class="ti-files"></i>
                                                <a href="fav-page.html" title="">My pages</a>
                                            </li>
                                            <li>
                                                <i class="ti-user"></i>
                                                <a href="timeline-friends.html" title="">friends</a>
                                            </li>
                                            <li>
                                                <i class="ti-image"></i>
                                                <a href="timeline-photos.html" title="">images</a>
                                            </li>
                                            <li>
                                                <i class="ti-video-camera"></i>
                                                <a href="timeline-videos.html" title="">videos</a>
                                            </li>
                                            <li>
                                                <i class="ti-comments-smiley"></i>
                                                <a href="messages.html" title="">Messages</a>
                                            </li>
                                            <li>
                                                <i class="ti-bell"></i>
                                                <a href="notifications.html" title="">Notifications</a>
                                            </li>
                                            <li>
                                                <i class="ti-share"></i>
                                                <a href="people-nearby.html" title="">People Nearby</a>
                                            </li>
                                            <li>
                                                <i class="fa fa-bar-chart-o"></i>
                                                <a href="insights.html" title="">insights</a>
                                            </li>-->
                                            <li>
                                                <i class="ti-user"></i>
                                                <a href="{{url('/messages')}}" title="">chat</a>
                                            </li>
                                            <li>
                                                <i class="ti-power-off"></i>
                                                <a href="{{route('logout')}}" title="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div><!-- Shortcuts -->
                                    <div class="widget">
                                        <h4 class="widget-title">Recent Activity</h4>
                                        <ul class="activitiez">
                                            @foreach(Auth::user()->unreadNotifications->slice(0,3) as $notification)
                                            <li>
                                                <div class="activity-meta">
                                                    <i>{{$notification->created_at}}</i>
                                                    <span>{{$notification->data['message']}}</span>
                                                    <h6>by <a href="{{url('/'.$notification->data['reactionPlacer']['username'])}}">{{$notification->data['reactionPlacer']['username']}}.</a></h6>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div><!-- recent activites -->
                                    <div class="widget">
                                        <h4 class="widget-title">Who's follownig</h4>
                                        <ul class="followers" id="ulFollow">
                                            @foreach(\App\Models\Follower::query()->where('user_id', Auth::user()->id)->get() as $follower)
                                                @if(\App\Models\Follower::query()->where('user_id', $follower->follower->id)->where('follower_id', Auth::user()->id)->first() === null)
                                            <li id="liFollow{{$follower}}">
                                                <figure><img src="{{asset('/storage/'.$follower->follower->avatar)}}" alt=""></figure>
                                                <div class="friend-meta">
                                                    <h4><a href="{{url('/'.$follower->follower->username)}}" title="">{{$follower->follower->name}}</a></h4>
                                                    <form id="formFollow{{$follower->follower->username}}" method="post" action="{{url('/'.$follower->follower->username.'/follow')}}">
                                                        @csrf
                                                        <input type="submit" style="border:none;background:none;padding:0;" value="Add Friend" class="ml-0 underline"/>
                                                    <!--<a href="{{url('/follow')}}" title="" class="underline">Add Friend</a>-->
                                                    </form>
                                                    <script>
                                                        /*$('#formFollow{{$follower->follower->username}}').on('submit',function(event){
                                                            event.preventDefault();
                                                            $.ajax({
                                                                url: "/"+"{{$follower->follower->username}}"+"/follow-ajax",
                                                                type: "POST",
                                                                data: {
                                                                    "_token": "{{ csrf_token() }}",
                                                                },
                                                                success: function (response) {
                                                                    if(response.success){
                                                                        let ul = document.getElementById('ulFollow');
                                                                        let li = document.getElementById('liFollow{{$follower}}');
                                                                        ul.removeChild(li);
                                                                    }
                                                                },
                                                            })
                                                        })*/
                                                    </script>
                                                </div>
                                            </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div><!-- who's following -->
                                </aside>
                            </div><!-- sidebar -->
                            <div class="col-lg-6">
                                <div class="">
{{--                                    @//foreach(\App\Models\Follower::query()->where('follower_id', Auth::user()->id)->get() as $following)--}}
{{--                                        @//foreach(\App\Models\Publication::query()->where('user_id', $following->user_id)->get() as $publication)--}}
{{--                                    <div class="central-meta item" id="{{$publication->id}}">--}}
{{--                                        <div class="user-post">--}}
{{--                                            <div class="friend-info">--}}
{{--                                                <figure>--}}
{{--                                                    <img src="{{asset('/storage/'.User::query()->where('id', $publication->user_id)->first()->avatar)}}" alt="">--}}
{{--                                                </figure>--}}
{{--                                                <div class="friend-name">--}}
{{--                                                    <ins><a href="{{url('/'.User::query()->where('id', $publication->user_id)->first()->username)}}" title="">{{User::query()->where('id', $publication->user_id)->first()->name}}</a></ins>--}}
{{--                                                    <span>{{$publication->created_at}}</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="post-meta">--}}
{{--                                                    <img src="{{asset('/storage/'.$publication->image)}}" alt="">--}}
{{--                                                    <div class="we-video-info">--}}
{{--                                                        <ul>--}}
{{--                                                            <li id="liLike" class="mr-0">--}}
{{--                                                                @//if($publication->likes->where('user_id',Auth::user()->id)->first() === null)--}}
{{--                                                                    <form id="formLike{{$publication->id}}">--}}
{{--                                                                        <div>--}}
{{--                                                                <span class="like" data-toggle="tooltip" title="like">--}}
{{--                                                                    <button id="btnLike{{$publication->id}}" type="submit" style="border:none;outline:none;background:none;color:black"><i class="ti-heart"></i> {{count($publication->likes->all())}}</button>--}}
{{--                                                                    <!--<ins>{{count($publication->likes->all())}}</ins>-->--}}
{{--                                                                </span>--}}
{{--                                                                        </div>--}}
{{--                                                                        <input id="publication_id{{$publication->id}}" name="publication_id" type="hidden"--}}
{{--                                                                               value="{{$publication->id}}"/>--}}
{{--                                                                        <input id="user_id" name="user_id" type="hidden"--}}
{{--                                                                               value="{{Auth::user()->id}}"/>--}}
{{--                                                                    </form>--}}
{{--                                                                <form id="formUnlike{{$publication->id}}" style="display:none;">--}}
{{--                                                                    @csrf--}}
{{--                                                                    <div>--}}
{{--                                                                    <span class="like" data-toggle="tooltip" title="like">--}}
{{--                                                                    <button id="btnUnlike{{$publication->id}}" type="submit" style="border:none;outline:none;background:none;color:red">&#10084; {{count($publication->likes->all())}}</button>--}}
{{--                                                                    <!--<ins>{{count($publication->likes->all())}}</ins>-->--}}
{{--                                                                    </span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <input id="publication_id2{{$publication->id}}" name="publication_id" type="hidden"--}}
{{--                                                                           value="{{$publication->id}}"/>--}}
{{--                                                                    <input id="user_id2" name="user_id" type="hidden"--}}
{{--                                                                           value="{{Auth::user()->id}}"/>--}}
{{--                                                                </form>--}}

{{--                                                                @//else--}}
{{--                                                                    <form id="formLike{{$publication->id}}" style="display:none;">--}}
{{--                                                                        <div>--}}
{{--                                                                <span class="like" data-toggle="tooltip" title="like">--}}
{{--                                                                    <button id="btnLike{{$publication->id}}" type="submit" style="border:none;outline:none;background:none;color:black"><i class="ti-heart"></i> {{count($publication->likes->all())}}</button>--}}
{{--                                                                    <!--<ins>{{count($publication->likes->all())}}</ins>-->--}}
{{--                                                                </span>--}}
{{--                                                                        </div>--}}
{{--                                                                        <input id="publication_id{{$publication->id}}" name="publication_id" type="hidden"--}}
{{--                                                                               value="{{$publication->id}}"/>--}}
{{--                                                                        <input id="user_id" name="user_id" type="hidden"--}}
{{--                                                                               value="{{Auth::user()->id}}"/>--}}
{{--                                                                    </form>--}}
{{--                                                                    <form id="formUnlike{{$publication->id}}" style="display:block;">--}}
{{--                                                                        @csrf--}}
{{--                                                                        <div>--}}
{{--                                                                    <span class="like" data-toggle="tooltip" title="like">--}}
{{--                                                                    <button id="btnUnlike{{$publication->id}}" type="submit" style="border:none;outline:none;background:none;color:red">&#10084; {{count($publication->likes->all())}}</button>--}}
{{--                                                                    <!--<ins>{{count($publication->likes->all())}}</ins>-->--}}
{{--                                                                    </span>--}}
{{--                                                                        </div>--}}
{{--                                                                        <input id="publication_id2{{$publication->id}}" name="publication_id" type="hidden"--}}
{{--                                                                               value="{{$publication->id}}"/>--}}
{{--                                                                        <input id="user_id2" name="user_id" type="hidden"--}}
{{--                                                                               value="{{Auth::user()->id}}"/>--}}
{{--                                                                    </form>--}}
{{--                                                                @//endif--}}

{{--                                                                    <script>--}}
{{--                                                                        $('#formLike{{$publication->id}}').on('submit', function (event) {--}}
{{--                                                                            event.preventDefault();--}}
{{--                                                                            let userId = $('#user_id').val();--}}
{{--                                                                            let publId = $('#publication_id{{$publication->id}}').val();--}}
{{--                                                                            $.ajax({--}}
{{--                                                                                url: "/like",--}}
{{--                                                                                type: "POST",--}}
{{--                                                                                data: {--}}
{{--                                                                                    "_token": "{{ csrf_token() }}",--}}
{{--                                                                                    user_id: userId,--}}
{{--                                                                                    publication_id: publId,--}}
{{--                                                                                },--}}
{{--                                                                                success: function (response) {--}}
{{--                                                                                    if (response.success) {--}}
{{--                                                                                        $('#formLike{{$publication->id}}').hide();--}}
{{--                                                                                        document.getElementById('btnLike{{$publication->id}}').innerText = response.success;--}}
{{--                                                                                        document.getElementById('formUnlike{{$publication->id}}').style.display = "block";--}}
{{--                                                                                        document.getElementById('btnUnlike{{$publication->id}}').innerHTML = "&#10084; "+response.success;--}}
{{--                                                                                    }--}}
{{--                                                                                },--}}
{{--                                                                            });--}}
{{--                                                                        });--}}
{{--                                                                        $('#formUnlike{{$publication->id}}').on('submit', function (event) {--}}
{{--                                                                            event.preventDefault();--}}
{{--                                                                            let userId = $('#user_id2').val();--}}
{{--                                                                            let publId = $('#publication_id2{{$publication->id}}').val();--}}
{{--                                                                            $.ajax({--}}
{{--                                                                                url: "/unlike",--}}
{{--                                                                                type: "POST",--}}
{{--                                                                                data: {--}}
{{--                                                                                    "_token": "{{ csrf_token() }}",--}}
{{--                                                                                    user_id: userId,--}}
{{--                                                                                    publication_id: publId,--}}
{{--                                                                                },--}}
{{--                                                                                success: function (response) {--}}
{{--                                                                                    $('#formUnlike{{$publication->id}}').hide();--}}
{{--                                                                                    document.getElementById('btnUnlike{{$publication->id}}').innerText = "&#10084; "+response.success;--}}
{{--                                                                                    document.getElementById('formLike{{$publication->id}}').style.display = "block";--}}
{{--                                                                                    document.getElementById('btnLike{{$publication->id}}').innerHTML = "<i class='ti-heart'></i> "+response.success;--}}
{{--                                                                                },--}}
{{--                                                                            });--}}
{{--                                                                        });--}}
{{--                                                                    </script>--}}
{{--                                                            </li>--}}
{{--                                                            <li>--}}
{{--															<span class="like" style="color:black;font-size:14px;font-weight:bold;" data-toggle="tooltip"--}}
{{--                                                                  title="Comments">--}}
{{--																<i class="fa fa-comments-o"></i>--}}
{{--																{{count($publication->comments->all())}}--}}
{{--															</span>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="description">--}}

{{--                                                        <p>--}}
{{--                                                            {{$publication->description}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="coment-area">--}}
{{--                                                <ul class="we-comet" id="comments{{$publication->id}}">--}}
{{--                                                    @//if($publication->comments->first() !== null)--}}
{{--                                                        @//php--}}
{{--                                                        $count_comments = count($publication->comments->all());--}}
{{--                                                        @//endphp--}}
{{--                                                    @//if($count_comments >= 5)--}}
{{--                                                        @//foreach($publication->comments->find(5) as $comment)--}}
{{--                                                            <li>--}}
{{--                                                                <div class="comet-avatar">--}}
{{--                                                                    <img--}}
{{--                                                                        src="{{asset('/storage/'.$comment->user->avatar)}}"--}}
{{--                                                                        alt="">--}}
{{--                                                                </div>--}}
{{--                                                                <div class="we-comment">--}}
{{--                                                                    <div class="coment-head">--}}
{{--                                                                        <h5><a href="{{url('/'.$comment->user->username)}}" title="">{{$comment->user->name}}</a></h5>--}}
{{--                                                                        <span>{{$comment->created_at}}</span>--}}
{{--                                                                        <a class="we-reply" href="#"--}}
{{--                                                                           title="Reply"><i--}}
{{--                                                                                class="fa fa-reply"></i></a>--}}
{{--                                                                    </div>--}}
{{--                                                                    <p>{{$comment->text}}</p>--}}
{{--                                                                </div>--}}
{{--                                                            </li>--}}
{{--                                                        @//endforeach--}}
{{--                                                        <li>--}}
{{--                                                            <button onclick="" title="" class="showmore underline">more--}}
{{--                                                                comments</button>--}}
{{--                                                        </li>--}}
{{--                                                        @//else--}}
{{--                                                            @//foreach($publication->comments->all() as $comment)--}}
{{--                                                                <li>--}}
{{--                                                                    <div class="comet-avatar">--}}
{{--                                                                        <img--}}
{{--                                                                            src="{{asset('/storage/'.$comment->user->avatar)}}"--}}
{{--                                                                            alt="">--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="we-comment">--}}
{{--                                                                        <div class="coment-head">--}}
{{--                                                                            <h5><a href="{{url('/'.$comment->user->username)}}" title="">{{$comment->user->name}}</a></h5>--}}
{{--                                                                            <span>{{$comment->created_at}}</span>--}}
{{--                                                                            <a class="we-reply" href="#"--}}
{{--                                                                               title="Reply"><i--}}
{{--                                                                                    class="fa fa-reply"></i></a>--}}
{{--                                                                        </div>--}}
{{--                                                                        <p>{{$comment->text}}</p>--}}
{{--                                                                    </div>--}}
{{--                                                                </li>--}}
{{--                                                            @//endforeach--}}
{{--                                                            <!--<li>--}}
{{--                                                                <button onclick="" title="" class="showmore underline">more--}}
{{--                                                                    comments</button>--}}
{{--                                                            </li>-->--}}
{{--                                                        @//endif--}}
{{--                                                    @//endif--}}
{{--                                                    <li class="post-comment">--}}
{{--                                                        <div class="comet-avatar">--}}
{{--                                                            <img src="{{Auth::user()->avatar}}" alt="">--}}
{{--                                                        </div>--}}
{{--                                                        <div class=""> <!--post-comt-box-->--}}
{{--                                                            <form id="formComment{{$publication->id}}">--}}
{{--                                                                @csrf--}}
{{--                                                                <textarea id="text{{$publication->id}}" name="text"--}}
{{--                                                                          placeholder="Post your comment"></textarea>--}}
{{--                                                                <input id="publication_id{{$publication->id}}" name="publication_id" type="hidden"--}}
{{--                                                                       value="{{$publication->id}}"/>--}}
{{--                                                                <input id="user_id" name="user_id" type="hidden"--}}
{{--                                                                       value="{{Auth::user()->id}}"/>--}}
{{--                                                                <button type="submit">Send</button>--}}
{{--                                                            </form>--}}
{{--                                                            <script>--}}
{{--                                                                $('#formComment{{$publication->id}}').on('submit',function(event){--}}
{{--                                                                    event.preventDefault();--}}
{{--                                                                    let userId = $('#user_id').val();--}}
{{--                                                                    let publId = $('#publication_id{{$publication->id}}').val();--}}
{{--                                                                    let text = $('#text{{$publication->id}}').val();--}}
{{--                                                                    let comments = document.getElementById('comments{{$publication->id}}');--}}
{{--                                                                    $.ajax({--}}
{{--                                                                        url: "/comment",--}}
{{--                                                                        type: "POST",--}}
{{--                                                                        data: {--}}
{{--                                                                            "_token": "{{ csrf_token() }}",--}}
{{--                                                                            user_id: userId,--}}
{{--                                                                            publication_id: publId,--}}
{{--                                                                            text:text,--}}
{{--                                                                        },--}}
{{--                                                                        success: function (response) {--}}
{{--                                                                            if (response.success) {--}}
{{--                                                                                comments.innerHTML += '<li>'+--}}
{{--                                                                                    '<div class="comet-avatar">'+--}}
{{--                                                                                        '<img src="{{asset('/storage/'.Auth::user()->avatar)}}" alt="">'+--}}
{{--                                                                                    '</div>'+--}}
{{--                                                                                    '<div class="we-comment">'+--}}
{{--                                                                                        '<div class="coment-head">'+--}}
{{--                                                                                            '<h5><a href="{{url('/'.Auth::user()->username)}}" title="">{{Auth::user()->name}}</a></h5>'+--}}
{{--                                                                                            '<span>'+ response.success.created_at +'</span>'+--}}
{{--                                                                                            '<a class="we-reply" href="#"'+--}}
{{--                                                                                               'title="Reply"><i'+--}}
{{--                                                                                                'class="fa fa-reply"></i></a>'+--}}
{{--                                                                                        '</div>'+--}}
{{--                                                                                        '<p>'+ response.success.text +'</p>'+--}}
{{--                                                                                    '</div>'+--}}
{{--                                                                                '</li>';--}}
{{--                                                                            }--}}
{{--                                                                        },--}}
{{--                                                                    });--}}
{{--                                                                })--}}
{{--                                                            </script>--}}
{{--                                                        </div>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                        @//endforeach--}}
{{--                                    @//endforeach--}}

                                    @foreach($publications as $publication)
                                            <div class="central-meta item" id="{{$publication->id}}">
                                                <div class="user-post">
                                                    <div class="friend-info">
                                                        <figure>
                                                            <img src="{{asset('/storage/'.User::query()->where('id', $publication->user_id)->first()->avatar)}}" alt="">
                                                        </figure>
                                                        <div class="friend-name">
                                                            <ins><a href="{{url('/'.User::query()->where('id', $publication->user_id)->first()->username)}}" title="">{{User::query()->where('id', $publication->user_id)->first()->name}}</a></ins>
                                                            <span>{{$publication->created_at}}</span>
                                                        </div>
                                                        <div class="post-meta">
                                                            <img src="{{asset('/storage/'.$publication->image)}}" alt="">
                                                            <div class="we-video-info">
                                                                <ul>
                                                                    <li id="liLike" class="mr-0">
                                                                        @if($publication->likes->where('user_id',Auth::user()->id)->first() === null)
                                                                            <form id="formLike{{$publication->id}}">
                                                                                <div>
                                                                <span class="like" data-toggle="tooltip" title="like">
                                                                    <button id="btnLike{{$publication->id}}" type="submit" style="border:none;outline:none;background:none;color:black"><i class="ti-heart"></i> {{count($publication->likes->all())}}</button>
                                                                    <!--<ins>{{count($publication->likes->all())}}</ins>-->
                                                                </span>
                                                                                </div>
                                                                                <input id="publication_id{{$publication->id}}" name="publication_id" type="hidden"
                                                                                       value="{{$publication->id}}"/>
                                                                                <input id="user_id" name="user_id" type="hidden"
                                                                                       value="{{Auth::user()->id}}"/>
                                                                            </form>
                                                                            <form id="formUnlike{{$publication->id}}" style="display:none;">
                                                                                @csrf
                                                                                <div>
                                                                    <span class="like" data-toggle="tooltip" title="like">
                                                                    <button id="btnUnlike{{$publication->id}}" type="submit" style="border:none;outline:none;background:none;color:red">&#10084; {{count($publication->likes->all())}}</button>
                                                                    <!--<ins>{{count($publication->likes->all())}}</ins>-->
                                                                    </span>
                                                                                </div>
                                                                                <input id="publication_id2{{$publication->id}}" name="publication_id" type="hidden"
                                                                                       value="{{$publication->id}}"/>
                                                                                <input id="user_id2" name="user_id" type="hidden"
                                                                                       value="{{Auth::user()->id}}"/>
                                                                            </form>

                                                                        @else
                                                                            <form id="formLike{{$publication->id}}" style="display:none;">
                                                                                <div>
                                                                <span class="like" data-toggle="tooltip" title="like">
                                                                    <button id="btnLike{{$publication->id}}" type="submit" style="border:none;outline:none;background:none;color:black"><i class="ti-heart"></i> {{count($publication->likes->all())}}</button>
                                                                    <!--<ins>{{count($publication->likes->all())}}</ins>-->
                                                                </span>
                                                                                </div>
                                                                                <input id="publication_id{{$publication->id}}" name="publication_id" type="hidden"
                                                                                       value="{{$publication->id}}"/>
                                                                                <input id="user_id" name="user_id" type="hidden"
                                                                                       value="{{Auth::user()->id}}"/>
                                                                            </form>
                                                                            <form id="formUnlike{{$publication->id}}" style="display:block;">
                                                                                @csrf
                                                                                <div>
                                                                    <span class="like" data-toggle="tooltip" title="like">
                                                                    <button id="btnUnlike{{$publication->id}}" type="submit" style="border:none;outline:none;background:none;color:red">&#10084; {{count($publication->likes->all())}}</button>
                                                                    <!--<ins>{{count($publication->likes->all())}}</ins>-->
                                                                    </span>
                                                                                </div>
                                                                                <input id="publication_id2{{$publication->id}}" name="publication_id" type="hidden"
                                                                                       value="{{$publication->id}}"/>
                                                                                <input id="user_id2" name="user_id" type="hidden"
                                                                                       value="{{Auth::user()->id}}"/>
                                                                            </form>
                                                                        @endif

                                                                        <script>
                                                                            $('#formLike{{$publication->id}}').on('submit', function (event) {
                                                                                event.preventDefault();
                                                                                let userId = $('#user_id').val();
                                                                                let publId = $('#publication_id{{$publication->id}}').val();
                                                                                $.ajax({
                                                                                    url: "/like",
                                                                                    type: "POST",
                                                                                    data: {
                                                                                        "_token": "{{ csrf_token() }}",
                                                                                        user_id: userId,
                                                                                        publication_id: publId,
                                                                                    },
                                                                                    success: function (response) {
                                                                                        if (response.success) {
                                                                                            $('#formLike{{$publication->id}}').hide();
                                                                                            document.getElementById('btnLike{{$publication->id}}').innerText = response.success;
                                                                                            document.getElementById('formUnlike{{$publication->id}}').style.display = "block";
                                                                                            document.getElementById('btnUnlike{{$publication->id}}').innerHTML = "&#10084; "+response.success;
                                                                                        }
                                                                                    },
                                                                                });
                                                                            });
                                                                            $('#formUnlike{{$publication->id}}').on('submit', function (event) {
                                                                                event.preventDefault();
                                                                                let userId = $('#user_id2').val();
                                                                                let publId = $('#publication_id2{{$publication->id}}').val();
                                                                                $.ajax({
                                                                                    url: "/unlike",
                                                                                    type: "POST",
                                                                                    data: {
                                                                                        "_token": "{{ csrf_token() }}",
                                                                                        user_id: userId,
                                                                                        publication_id: publId,
                                                                                    },
                                                                                    success: function (response) {
                                                                                        $('#formUnlike{{$publication->id}}').hide();
                                                                                        document.getElementById('btnUnlike{{$publication->id}}').innerText = "&#10084; "+response.success;
                                                                                        document.getElementById('formLike{{$publication->id}}').style.display = "block";
                                                                                        document.getElementById('btnLike{{$publication->id}}').innerHTML = "<i class='ti-heart'></i> "+response.success;
                                                                                    },
                                                                                });
                                                                            });
                                                                        </script>
                                                                    </li>
                                                                    <li>
															<span class="like" style="color:black;font-size:14px;font-weight:bold;" data-toggle="tooltip"
                                                                  title="Comments">
																<i class="fa fa-comments-o"></i>
																{{count($publication->comments->all())}}
															</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="description">

                                                                <p>
                                                                    {{$publication->description}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="coment-area">
                                                        <ul class="we-comet" id="comments{{$publication->id}}">
                                                            @if($publication->comments->first() !== null)
                                                                @php
                                                                    $count_comments = count($publication->comments->all());
                                                                @endphp
                                                                @if($count_comments >= 5)
                                                                    @foreach($publication->comments->find(5) as $comment)
                                                                        <li>
                                                                            <div class="comet-avatar">
                                                                                <img
                                                                                    src="{{asset('/storage/'.$comment->user->avatar)}}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="we-comment">
                                                                                <div class="coment-head">
                                                                                    <h5><a href="{{url('/'.$comment->user->username)}}" title="">{{$comment->user->name}}</a></h5>
                                                                                    <span>{{$comment->created_at}}</span>
                                                                                    <a class="we-reply" href="#"
                                                                                       title="Reply"><i
                                                                                            class="fa fa-reply"></i></a>
                                                                                </div>
                                                                                <p>{{$comment->text}}</p>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                    <li>
                                                                        <button onclick="" title="" class="showmore underline">more
                                                                            comments</button>
                                                                    </li>
                                                                @else
                                                                    @foreach($publication->comments->all() as $comment)
                                                                        <li>
                                                                            <div class="comet-avatar">
                                                                                <img
                                                                                    src="{{asset('/storage/'.$comment->user->avatar)}}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="we-comment">
                                                                                <div class="coment-head">
                                                                                    <h5><a href="{{url('/'.$comment->user->username)}}" title="">{{$comment->user->name}}</a></h5>
                                                                                    <span>{{$comment->created_at}}</span>
                                                                                    <a class="we-reply" href="#"
                                                                                       title="Reply"><i
                                                                                            class="fa fa-reply"></i></a>
                                                                                </div>
                                                                                <p>{{$comment->text}}</p>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                    <!--<li>
                                                                <button onclick="" title="" class="showmore underline">more
                                                                    comments</button>
                                                            </li>-->
                                                                @endif
                                                            @endif
                                                            <li class="post-comment">
                                                                <div class="comet-avatar">
                                                                    <img src="{{Auth::user()->avatar}}" alt="">
                                                                </div>
                                                                <div class=""> <!--post-comt-box-->
                                                                    <form id="formComment{{$publication->id}}">
                                                                        @csrf
                                                                        <textarea id="text{{$publication->id}}" name="text"
                                                                                  placeholder="Post your comment"></textarea>
                                                                        <input id="publication_id{{$publication->id}}" name="publication_id" type="hidden"
                                                                               value="{{$publication->id}}"/>
                                                                        <input id="user_id" name="user_id" type="hidden"
                                                                               value="{{Auth::user()->id}}"/>
                                                                        <button type="submit">Send</button>
                                                                    </form>
                                                                    <script>
                                                                        $('#formComment{{$publication->id}}').on('submit',function(event){
                                                                            event.preventDefault();
                                                                            let userId = $('#user_id').val();
                                                                            let publId = $('#publication_id{{$publication->id}}').val();
                                                                            let text = $('#text{{$publication->id}}').val();
                                                                            let comments = document.getElementById('comments{{$publication->id}}');
                                                                            $.ajax({
                                                                                url: "/comment",
                                                                                type: "POST",
                                                                                data: {
                                                                                    "_token": "{{ csrf_token() }}",
                                                                                    user_id: userId,
                                                                                    publication_id: publId,
                                                                                    text:text,
                                                                                },
                                                                                success: function (response) {
                                                                                    if (response.success) {
                                                                                        comments.innerHTML += '<li>'+
                                                                                            '<div class="comet-avatar">'+
                                                                                            '<img src="{{asset('/storage/'.Auth::user()->avatar)}}" alt="">'+
                                                                                            '</div>'+
                                                                                            '<div class="we-comment">'+
                                                                                            '<div class="coment-head">'+
                                                                                            '<h5><a href="{{url('/'.Auth::user()->username)}}" title="">{{Auth::user()->name}}</a></h5>'+
                                                                                            '<span>'+ response.success.created_at +'</span>'+
                                                                                            '<a class="we-reply" href="#"'+
                                                                                            'title="Reply"><i'+
                                                                                            'class="fa fa-reply"></i></a>'+
                                                                                            '</div>'+
                                                                                            '<p>'+ response.success.text +'</p>'+
                                                                                            '</div>'+
                                                                                            '</li>';
                                                                                    }
                                                                                },
                                                                            });
                                                                        })
                                                                    </script>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                    @endforeach
                                    <!--<button class="btn-view btn-load-more" >-->
                                    <a class="btn btn-primary" href="{{$publications->previousPageUrl()}}">Previous</a>
                                    <a class="btn btn-primary" href="{{$publications->nextPageUrl()}}">Next</a>
                                    <!--<a class="btn-view btn-load-more" href="{{$publications->nextPageUrl()}}"></a>-->
                                    <!--</button>-->
                                </div>
                            </div><!-- centerl meta -->
                            <div class="col-lg-3">
                                <aside class="sidebar static">


                                    <div class="widget friend-list">
                                        <h4 class="widget-title" style="margin-bottom:0;">Friends</h4>
                                        <ul id="people-list" class="friendz-list">
                                            @foreach(\App\Models\Follower::query()->where('user_id', Auth::user()->id)->get() as $follower)
                                                @if(\App\Models\Follower::query()->where('user_id', $follower->follower->id)->where('follower_id', Auth::user()->id)->first() !== null)
                                                    <li>
                                                        <figure><img src="{{asset('/storage/'.$follower->follower->avatar)}}" alt=""></figure>
                                                        <div class="friend-meta">
                                                            <h4><a href="{{url('/'.$follower->follower->username)}}" title="">{{$follower->follower->name}}</a></h4>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="chat-box">
                                            <div class="chat-head">
                                                <span class="status f-online"></span>
                                                <h6>Bucky Barnes</h6>
                                                <div class="more">
                                                    <span><i class="ti-more-alt"></i></span>
                                                    <span class="close-mesage"><i class="ti-close"></i></span>
                                                </div>
                                            </div>
                                            <div class="chat-list">
                                                <ul>
                                                    <li class="me">
                                                        <div class="chat-thumb"><img src="images/resources/chatlist1.jpg" alt=""></div>
                                                        <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                                                        </div>
                                                    </li>
                                                    <li class="you">
                                                        <div class="chat-thumb"><img src="images/resources/chatlist2.jpg" alt=""></div>
                                                        <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                                                        </div>
                                                    </li>
                                                    <li class="me">
                                                        <div class="chat-thumb"><img src="images/resources/chatlist1.jpg" alt=""></div>
                                                        <div class="notification-event">
															<span class="chat-message-item">
																Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks
															</span>
                                                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">Yesterday at 8:10pm</time></span>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <form class="text-box">
                                                    <textarea placeholder="Post enter to post..."></textarea>
                                                    <div class="add-smiles">
                                                        <span title="add icon" class="em em-expressionless"></span>
                                                    </div>
                                                    <div class="smiles-bunch">
                                                        <i class="em em---1"></i>
                                                        <i class="em em-smiley"></i>
                                                        <i class="em em-anguished"></i>
                                                        <i class="em em-laughing"></i>
                                                        <i class="em em-angry"></i>
                                                        <i class="em em-astonished"></i>
                                                        <i class="em em-blush"></i>
                                                        <i class="em em-disappointed"></i>
                                                        <i class="em em-worried"></i>
                                                        <i class="em em-kissing_heart"></i>
                                                        <i class="em em-rage"></i>
                                                        <i class="em em-stuck_out_tongue"></i>
                                                    </div>
                                                    <button type="submit"></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- friends list sidebar -->
                                </aside>
                            </div><!-- sidebar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

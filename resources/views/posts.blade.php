@extends('layouts.profileLayout')

@section('content2')
    @php
        use App\Models\User;
        //$username = str_replace('/posts','',$_SERVER['REQUEST_URI']);
        //$username = str_replace('/','',$username)
    @endphp
    <script>
        let elContainer = document.getElementById('elContainer');
        for(let element of elContainer.children){
            element.classList.remove('active');
        }
        let posts = document.getElementById('posts');
        posts.classList.add('active');
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
                                                    <a title=""
                                                       href="{{url('/'.Auth::user()->username.'/changePassword')}}">change
                                                        password</a>
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
                                @if(Auth::user()->username === User::query()->where('username',$username)->first()->username)
                                    <div class="central-meta">
                                        <div class="new-postbox">
                                            <figure>
                                                <img
                                                    src="{{asset('/storage/'.User::query()->where('username',$username)->first()->avatar)}}"
                                                    alt="">
                                            </figure>
                                            <div class="newpst-input">
                                                <form method="post" id="addPost"
                                                      action="{{url('/'.Auth::user()->username.'/posts/addPost')}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <textarea rows="2" name="description"
                                                              placeholder="write something"></textarea>
                                                    <div class="attachments">
                                                        <ul>
                                                            <li>
                                                                <i class="fa fa-image"></i>
                                                                <label class="fileContainer">
                                                                    <input name="image" type="file">
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <button type="submit">Post</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- add post new box -->
                                @endif

                                <div class="">
                                    @foreach($publications as $publication)
                                        <div class="central-meta item">
                                            <div class="user-post">
                                                <div class="friend-info">
                                                    <figure>
                                                        <img
                                                            src="{{asset('/storage/'.User::query()->where('username',$username)->first()->avatar)}}"
                                                            alt="">
                                                    </figure>
                                                    <div class="friend-name">
                                                        <ins><a href="{{url('/'.$username)}}"
                                                                title="">{{User::query()->where('username',$username)->first()->name}}</a>
                                                        </ins>
                                                        <span>published: {{$publication->created_at}}</span>
                                                    </div>
                                                    <div class="post-meta">
                                                        <img
                                                            src="{{asset('/storage/'.$publication->image)}}"
                                                            alt="">
                                                        <div class="we-video-info">
                                                            <ul>
                                                                <li>
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
                                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
                                                                    <script>
                                                                        /*$('#divForm').on('click',function(){
                                                                            $('#formLike').on('submit',function(event){
                                                                                event.preventDefault();
                                                                                let userId = $('#user_id').val();
                                                                                let publId = $('#publication_id').val();
                                                                                $.ajax({
                                                                                    url: "/like",
                                                                                    type: "POST",
                                                                                    data: {
                                                                                        "_token": "{{ csrf_token() }}",
                                                                                        user_id: userId,
                                                                                        publication_id: publId
                                                                                    },
                                                                                    success: function (response) {
                                                                                        let liLike = document.getElementById('liLike');
                                                                                        if (response.success) {
                                                                                            liLike.innerHTML = '<form id="formUnlike{{$publication->id}}" action="{{url('/unlike')}}" method="post">@csrf<div onclick="document.getElementById('formUnlike{{$publication->id}}').submit();"><span class="like" data-toggle="tooltip" title="like" style="color:red;"><!--<i class="ti-heart"></i>-->&#10084;<ins>{{count($publication->likes->all())}}</ins></span></div><input name="publication_id" type="hidden" value="{{$publication->id}}"/><input name="user_id" type="hidden" value="{{Auth::user()->id}}"/></form>';
                                                                                        }
                                                                                        console.log(response);
                                                                                    },
                                                                                });
                                                                            })

                                                                        });*/
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
                                                    <ul class="we-comet">
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
                                                                <li>
                                                                    <button onclick="" title="" class="showmore underline">more
                                                                        comments</button>
                                                                </li>
                                                            @endif
                                                        @endif
                                                        <li class="post-comment">
                                                            <div class="comet-avatar">
                                                                <img src="{{Auth::user()->avatar}}" alt="">
                                                            </div>
                                                            <div class=""> <!--post-comt-box-->
                                                                <form method="post" action="{{url('/comment')}}">
                                                                    @csrf
                                                                    <textarea name="text"
                                                                        placeholder="Post your comment"></textarea>
                                                                    <input name="publication_id" type="hidden"
                                                                           value="{{$publication->id}}"/>
                                                                    <input name="user_id" type="hidden"
                                                                           value="{{Auth::user()->id}}"/>
                                                                    <button type="submit">Send</button>
                                                                </form>
                                                                @if(Auth::user()->username === $username)
                                                                <form method="post" action="{{url('/deletePost')}}">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$publication->id}}" name="publication_id">
                                                                    <button type="submit" class="btn btn-danger mt-2">Delete</button>
                                                                </form>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                        <a class="btn btn-primary" href="{{$publications->previousPageUrl()}}">Previous</a>
                                        <a class="btn btn-primary" href="{{$publications->nextPageUrl()}}">Next</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



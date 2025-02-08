@extends('layouts.app')

@section('content')
    @php
        use App\Models\User;
    @endphp
    <section>
        <div class="gap gray-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="page-contents">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="central-meta d-flex flex-column">
                                    <form id="formSearch">
                                        <input type="text" id="search"
                                               class="form-control" placeholder="Search Users"/>
                                        <button class="mt-2" type="submit">Search</button>
                                    </form>
                                    <div id="result" class="d-flex flex-column"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script>
        $('#formSearch').on('submit', function (event) {
            event.preventDefault();
            let username = $('#search').val();
            $.ajax({
                url: "/search-form",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    username: username,
                },
                success: function (response) {
                    let result = document.getElementById('result');
                    for (let user of response.success) {
                        console.log(user);
                        let urlUsername = "/" + user.username;
                        result.innerHTML = '<p class="m-2" style="cursor:pointer" onclick="window.location.href=\''+urlUsername+'\'"><img class="follower_img" src="/storage/'+user.avatar+'" align="middle"><span class="username">'+user.username+'</span><br><span>'+user.name+'</span></p>';
                    }
                    console.log(response);
                },
            });
        });
    </script>
@endsection

<?php

namespace App\Http\Controllers;

use App\Helpers\Redirect;
use App\Models\Follower;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\Followed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class RelController
{
    public function follow(Request $request, $username)
    {
        $username = str_replace('/follow', '', $_SERVER['REQUEST_URI']);
        $username = str_replace('/', '', $username);
        $following = User::query()->where('username', $username)->first()->id;
        $follower = Auth::user()->id;
        Follower::create([
            'follower_id' => $follower,
            'user_id' => $following
        ]);
        $user = User::query()->where('id', $follower)->first();
        $me = User::query()->where('id', $following)->first();
        $me->notify(new Followed($user));
        //Notification::send($me, new Followed($user));
        //return response()->json(['success'=>'success']);
        //(new Redirect)->redirect('/'.$username);
        //return view('profile');
        return redirect(url()->previous());
    }

    public function follow_ajax(Request $request, $username)
    {
        $username = str_replace('/follow-ajax', '', $_SERVER['REQUEST_URI']);
        $username = str_replace('/', '', $username);
        $following = User::query()->where('username', $username)->first()->id;
        $follower = Auth::user()->id;
        Follower::create([
            'follower_id' => $follower,
            'user_id' => $following
        ]);

        //
        return response()->json(['success' => 'success']);
        //(new Redirect)->redirect('/'.$username);
        //return view('profile');
    }

    public function unfollow(Request $request, $username)
    {
        $username = str_replace('/unfollow', '', $_SERVER['REQUEST_URI']);
        $username = str_replace('/', '', $username);
        $follower = Auth::user()->id;
        Follower::query()->where('follower_id', $follower)->where('user_id', User::query()->where('username', $username)->first()->id)->first()->delete();
        (new Redirect)->redirect('/' . $username);
        return view('profile');
    }

    public function OneToOne()
    {
        $allUser = User::all();
        //dd($allUser);
        $firstUser = User::all()->first();
        //dd($firstUser);

        //$allPost = Publication::all()->first();
        //$a = Publication::query()->first();
        //$a = Publication::query()->take(1)->get();
        //dd($a);

        /*$mikeis = User::query()
            ->where('email', 'mikeisisyp@gmail.com')
            //->with('profile')
            //->get();
            ->first();

        //$mikeis = User::find(1);
        Debugbar::info($mikeis->toArray());
        echo $mikeis->profile;
        Debugbar::info($mikeis->toArray());*/

        /*$mikeis = Cache::get('mikeis', function(){
            $putToCache = User::query()
                ->where('email', 'mikeisisyp@gmail.com')
                ->with('profile')
                ->first();

            Cache::put('mikeis', $putToCache, 360);

            return $putToCache;
        });*/

        //Cache::forget('mikeis');
        //Debugbar::info($mikeis->toArray());

        $profile = Profile::find(1);
        echo $profile->toArray();
        echo $profile->user->toArray();

        return view('home');
    }
}

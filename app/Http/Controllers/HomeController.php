<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Profile;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use function Sodium\add;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $publications = new \ArrayObject();
        foreach(Follower::query()->where('follower_id', Auth::user()->id)->get() as $following){
            foreach (Publication::query()->where('user_id', $following->user_id)->get() as $publication){
                $publications->append($publication);
            }
        }
        $publications = $this->paginate($publications);
        return view('home', compact('publications'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
        /*$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);*/
    }

    public function terms()
    {
        return view('terms');
    }

    public function notifications(){
        return view('notifications');
    }

    public function messages(){
        return view('messages');
    }

    public function deleteNotification(Request $request){
        $notification = $request->get('notification');
        $notification = \App\Models\Notification::query()->where('id',$notification)->first();
        $notification->read_at = date('Y-m-d h:i:s');
        $notification->save();
        return redirect(url()->previous());
    }

    public function search()
    {
        return view('search');
    }

    public function search_form(Request $request){
        $users = User::query()->where('username', 'like', '%' . $request->username . '%')->get();
        return response()->json(['success'=>$users]);
    }

    public function profile($username){
        if(User::query()->where('username', $username)->first() === null){
            return view('no_user');
        }
        else {
            $username = User::query()->where('username', $username)->first()->username;
            //$username = User::query()->where('username', '===', '');
            return view('profile',compact('username'));
        }
    }

    public function emailConfirmation($username){
        $user = User::query()->where('username', $username)->first();
        $user->email_verified_at = date('Y-m-d h:i:s a', time());
        $user->save();
        return view('email_success');
    }

    public function deleteAccount($username){
        if ($username !== Auth::user()->username)
            return view('no_user');
        else{
            $username=Auth::user()->username;
            Profile::query()->where('user_id',Auth::user()->id)->first()->delete;
            Like::query()->where('user_id',Auth::user()->id)->delete();
            Comment::query()->where('user_id',Auth::user()->id)->delete();
            $publications = Publication::query()->where('user_id',Auth::user()->id)->get();
            foreach($publications as $publication) {
                Like::query()->where('publication_id', $publication->id)->first()->delete();
                Comment::query()->where('publication_id', $publication->id)->first()->delete();
                Publication::query()->where('id', $publication->id)->first()->delete();
            }
            Follower::query()->where('follower_id',Auth::user()->id)->delete();
            Follower::query()->where('user_id',Auth::user()->id)->delete();
            User::query()->where('username',$username)->first()->delete();
            return view('welcome');
        }
    }


}

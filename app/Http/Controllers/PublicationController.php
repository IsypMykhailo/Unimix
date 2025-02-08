<?php

namespace App\Http\Controllers;

use App\Helpers\Redirect;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Publication;
use App\Models\User;
use App\Notifications\Commented;
use App\Notifications\Followed;
use App\Notifications\Liked;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

class PublicationController extends Controller
{
    public function like(Request $request){
        Like::create([
            'publication_id'=>$request->publication_id,
            'user_id'=>$request->user_id
        ]);
        $publication = Publication::query()->where('id',$request->publication_id)->first();
        $me = User::query()->where('id', $publication->user_id)->first();
        $user = User::query()->where('id',$request->user_id)->first();
        $me->notify(new Liked($user, $publication));
        return response()->json(['success'=>count(Publication::query()->where('id',$request->publication_id)->first()->likes->all())]);
        //return redirect(url()->previous());
    }

    public function unlike(Request $request){
        Like::query()->where('publication_id', $request->get('publication_id'))->where('user_id', $request->get('user_id'))->first()->delete();
        return response()->json(['success'=>count(Publication::query()->where('id',$request->publication_id)->first()->likes->all())]);
    }

    public function comment(Request $request){
        Comment::create([
            'publication_id'=>$request->publication_id,
            'user_id'=>$request->user_id,
            'text'=>$request->text
        ]);
        $publication = Publication::query()->where('id',$request->publication_id)->first();
        $me = User::query()->where('id', $publication->user_id)->first();
        $user = User::query()->where('id',$request->user_id)->first();
        $me->notify(new Commented($user, $publication));
        $comment = Comment::query()->where('publication_id',$request->publication_id)->first();
        return response()->json(['success'=>$comment]);
    }

    public function deleteComment(Request $request){

    }

    public function deletePost(Request $request){
        Like::query()->where('publication_id',$request->get('publication_id'))->delete();
        Comment::query()->where('publication_id',$request->get('publication_id'))->delete();
        Publication::query()->where('id',$request->get('publication_id'))->first()->delete();
        return redirect(url()->previous());
    }
}

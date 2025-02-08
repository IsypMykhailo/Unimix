<?php

namespace App\Http\Controllers;

use App\Helpers\Redirect;
use App\Models\Publication;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use App\Helpers\ImageResize;

class EditProfileController extends Controller
{
    public function editProfileBasic($username)
    {
        $username = Auth::user()->username;
        if (str_replace('/edit-profile-basic', '', $_SERVER['REQUEST_URI']) !== '/' . Auth::user()->username)
            return view('no_user');
        else
            return view('editProfileBasic',compact('username'));
    }

    public function editAvatar(Request $request, $username)
    {
        if ($username !== Auth::user()->username)
            return view('no_user');
        else {
            $username = Auth::user()->username;
            $user = Auth::user();
            $filename = $request->file('avatar')->store('public/users/' . date('FY'));
            //$filename = Storage::put('public/users/'.date('FY'),$request->file('avatar'));
            $filename = Storage::url($filename);
            $filename = str_replace('/storage', '', $filename);
            /*$new_image = imagecreatetruecolor($width, $height);
            imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
            $image = $new_image;*/
            (new ImageResize)->cutImage($filename, 400, 400);

            $user->avatar = $filename;
            $user->save();
            (new Redirect)->redirect('/' . $username);
            //$this->redirect('/' . $username);
            return view('profile');
        }
    }

    public function editBackground(Request $request, $username)
    {
        if ($username !== Auth::user()->username)
            return view('no_user');
        else {
            $username = Auth::user()->username;
            $profile = Auth::user()->profile;
            $filename = $request->file('background')->store('public/profiles/' . date('FY'));
            //$filename = Storage::put('public/users/'.date('FY'),$request->file('avatar'));
            $filename = Storage::url($filename);
            $filename = str_replace('/storage', '', $filename);
            /*$new_image = imagecreatetruecolor($width, $height);
            imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
            $image = $new_image;*/
            (new ImageResize)->cutBackground($filename, 1366, 400);

            $profile->profileBackground = $filename;
            $profile->save();
            (new Redirect)->redirect('/' . $username);
            //$this->redirect('/' . $username);
            return view('profile');
        }
    }

    public function addPost(Request $request, $username){
        if ($username !== Auth::user()->username)
            return view('no_user');
        else {
            $username = Auth::user()->username;
            $filename = $request->file('image')->store('public/posts/' . date('FY'));
            $filename = Storage::url($filename);
            $filename = str_replace('/storage', '', $filename);
            (new ImageResize)->cutBackground($filename, 870, 470);
            Publication::create([
                'description' => $request->get('description'),
                'image' => $filename,
                'user_id' => Auth::user()->id
            ]);
            (new Redirect)->redirect('/' . $username . '/posts');
            //$this->redirect('/' . $username);
            return view('posts');
        }
    }

    public function updateProfileBasic(Request $request, $username)
    {
        if ($username !== Auth::user()->username)
            return view('no_user');
        else {
            $user = Auth::user();
            $username = Auth::user()->username;
            $profile = Auth::user()->profile;
            $user->name = $request->get('name');
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $profile->phone = $request->get('phone');
            $profile->location = $request->get('location');
            $profile->description = $request->get('description');
            $profile->interests = $request->get('interests');
            $profile->languages = $request->get('languages');
            $user->save();
            $profile->save();
            $username = Auth::user()->username;
            (new Redirect)->redirect('/' . $username);
            //$this->redirect('/' . $username);
            return view('profile','username');
        }
    }

    public function changePassword($username)
    {
        $username = Auth::user()->username;
        if (str_replace('/changePassword', '', $_SERVER['REQUEST_URI']) !== '/' . Auth::user()->username)
            return view('no_user');
        else
            return view('changePassword',compact('username'));
    }

    public function updatePassword(Request $request, $username){
        if ($username !== Auth::user()->username)
            return view('no_user');
        else {
            $user = Auth::user();
            $username = Auth::user()->username;
            $user->password = Hash::make($request->get('password'));
            $user->save();
            (new Redirect)->redirect('/' . $username);
            //$this->redirect('/' . $username);
            return view('profile',compact('username'));
        }
    }

    public function followers($username){
        if(User::query()->where('username', $username)->first() === null){
            return view('no_user');
        }
        else {
            $username = Auth::user()->username;
            //$username = User::query()->where('username', '===', '');
            $followers = \App\Models\Follower::query()->where('user_id', User::query()->where('username',$username)->first()->id)->get();
            $followers = $this->paginate($followers,10);
            return view('followers',compact('followers','username'));
        }
    }

    public function paginate($items, $perPage = 2, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }

    public function following($username){
        if(User::query()->where('username', $username)->first() === null){
            return view('no_user');
        }
        else {
            $username = Auth::user()->username;
            $followers = \App\Models\Follower::query()->where('follower_id', User::query()->where('username',$username)->first()->id)->get();
            $followers = $this->paginate($followers,10);
            return view('following',compact('followers','username'));
        }
    }

    public function posts($username){
        if(User::query()->where('username', $username)->first() === null){
            return view('no_user');
        }
        else {
            $username = Auth::user()->username;
            $publications = User::query()->where('username',$username)->first()->publications->all();
            $publications = $this->paginate($publications,5);
            return view('posts',compact('username', 'publications'));
        }
    }

    /*function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }*/
}

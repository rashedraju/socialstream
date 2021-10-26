<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Status;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    function home(){
        if(Auth::check()){
            $userId = Auth::id();
            $myStatuses = Status::where('user_id', $userId)->orderBy('id', 'desc')->get();
            $friendsStatuses = Auth::user()->friendsStatuses;
            $statuses = [...$myStatuses, ...$friendsStatuses];
            shuffle($statuses);
            Auth::user()->avatar;
        }

        return view('home', ['statuses'=> $statuses ]);
    }

    function saveStatus(Request $request){
        if(Auth::check()){
            $status = $request->post('status');
            $userId = Auth::id();
            $statusModel = new Status();
            $statusModel->status = $status;
            $statusModel->user_id = $userId;
            $statusModel->save();
        }

        return redirect()->route('home');
    }

    function userShout($nickname){
        $user = User::where('nickname', $nickname)->first();
        if($user){
            $statuses = Status::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            $avatar = empty($user->avatar) ? asset('images/profile/avatar.jpg') : $user->avatar;
            $userAction = true;
            $friendId = 2;

            return view('usershout', [
                'statuses' => $statuses, 
                'name'=> $user->name, 
                'avatar'=> $avatar,
                'userAction'=> $userAction,
                'friendId' => $friendId,
            ]);
        }else {
            return redirect('/');
        }

    }

    function profile(){
        if(Auth::check()){
            return view('profile');
        }
    }

    function saveProfile(Request $request){
        if(Auth::check()){
            $user = Auth::user();
    
            $name = $request->post('name');
            $email = $request->post('email');
            $nickname = $request->post('nickname');

            if($request->image){
                $image = "user" . $user->id . "." . $request->image->extension();
                $request->image->move(public_path("/images/profile"), $image);
                $user->avatar = asset("images/profile/".$image);
            }
    
            $user->name = $name;
            $user->email = $email;
            $user->nickname = $nickname;
            $user->nickname = $nickname;
            $user->save();
        }

        return redirect()->route('profile');
    }

    public function makeFriend($friendId){
        if(Auth::check()){
            $userId = Auth::user()->id;
            if( Friend::where('user_id', $userId)->where('friend_id', $friendId)->count() == 0 ){
                $friendship = new Friend();
                $friendship->user_id = $userId;
                $friendship->friend_id = $friendId;
    
                $friendship->save();
            }
            
            if( Friend::where('user_id', $friendId)->where('friend_id', $userId)->count() == 0 ){
                $friendship = new Friend();
                $friendship->user_id = $friendId;
                $friendship->friend_id = $userId;
    
                $friendship->save();
            }
        }

        return redirect()->route('home');

    }

    public function unfriend($friendId){
        if(Auth::check()){
            $userId = Auth::user()->id;
            Friend::where('user_id', $userId)->where('friend_id', $friendId)->delete();
            Friend::where('user_id', $friendId)->where('friend_id', $userId)->delete();
        }
    
        return redirect()->route('home');

    }
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加
use App\Micropost; //追加
use Log;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
    }
    
//フォロー機能
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);
        
        $date = [
            'user' => $user,
            'users' => $followings,
            ];
            $date += $this->counts($user);
            
            return view('users.followings',$date);
    }
    
    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

            $data += $this->counts($user);

        return view('users.followers', $data);
    }
    
//お気に入り機能
    
     public function favoritings($id)
     {
        $user = User::find($id);
        $favoritings = $user->favoritings()->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $favoritings,
        ];

        $data += $this->counts($user);
        


        return view('favorite.favoritings', $data);
    }
    
    public function favorites($id)
     {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(10);
        
        $data = [
            'user' => $user,
            'microposts' => $favorites,
        ];

        $data += $this->counts($user);

        return view('favorite.favoritings', $data);
    }
}

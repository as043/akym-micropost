<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class MicropostsController extends Controller
{
    /**
     * Display a listing of the resouce.
     * 
     * @return \Illuminate\Http\Responce
     */
     public function index()
     {
        $date = [];
        if (\Auth::check()){
            $user = \Auth::user();
            $microposts = $user->feed_microposts()->orderBy('created_at','desc')->paginate(10);
            
            $date = [
                'user' => $user,
                'microposts' => $microposts,
            ];
            $date += $this->counts($user);
            return view('users.show', $date);
        }else {
            return view('welcome');
        }
     }
     
     public function store(Request $request)
     {
         $this->validate($request,[
             'content' => 'required|max:191'
             ]);
            $request->user()->microposts()->create([
                'content' => $request->content,
            ]);
            return redirect()->back();
     }
     
     public function destroy($id)
     {
         $micropost = \App\Micropost::find($id);
         
         if (\Auth::id() === $micropost->user_id) {
             $micropost->delete();
         }
         return redirect()->back();
     }
     

     
     public function favoritings($id)
     {
        $user = User::find($id);
        $favoritings = $user->favoritings()->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $favoritings,
        ];

        $data += $this->counts($microposts);

        return view('favorite.favorite', $data);
    }
}


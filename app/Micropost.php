<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content','user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favoritings()
    {
        return $this->belongsToMany(Micropost::class, 'favorite', 'user_id','micropost')->withTimestamps();
    }
    
    public function favorite($userId)
    {
    // 既にフォローしているかの確認
    $exist = $this->is_favoriting($userId);

    if ($exist || $its_me) {
        // 既にフォローしていれば何もしない
        return false;
    } else {
        // 未フォローであればフォローする
        $this->favorites()->attach($userId);
        return true;
    }
    }
    
   public function unfavorite($userId)
   {
    // 既にフォローしているかの確認
    $exist = $this->is_favoriting($userId);

    if ($exist && !$its_me) {
        // 既にフォローしていればフォローを外す
        $this->favoritings()->detach($userId);
        return true;
    } else {
        // 未フォローであれば何もしない
        return false;
    }
    }

    public function is_favoriting($userId) {
        return $this->favoritings()->where('favorite', $userId)->exists();
    }
    }


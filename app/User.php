<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
//フォロー機能
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId)
    {
        // 既にフォローしているかの確認
    $exist = $this->is_following($userId);
    // 自分自身ではないかの確認
    $its_me = $this->id == $userId;

    if ($exist || $its_me) {
        // 既にフォローしていれば何もしない
        return false;
    } else {
        // 未フォローであればフォローする
        $this->followings()->attach($userId);
        return true;
        }
    }
    
    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        }  else {
            return false;
        }
    }
    
    public function is_following($userId) {
    return $this->followings()->where('follow_id', $userId)->exists();
}

//タイムライン

    public function feed_microposts()
    {
        $follow_user_ids = $this->followings()-> pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Micropost::whereIn('user_id', $follow_user_ids);
    }
    
//お気に入り機能
    
    public function favoritings()
    {
        return $this->belongsToMany(User::class, 'favorite', 'user_id','micropost_id')->withTimestamps();
    }
    
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorite', 'micropost_id','user_id')->withTimestamps();
    }
    
    public function favorite($micropostId)
    {
    // 既にお気に入りしているかの確認
    $exist = $this->is_favoriting($micropostId);

    if ($exist) {
        // 既にファボしていれば何もしない
        return false;
    } else {
        // 未ファボであればフォローする
        $this->favoritings()->attach($micropostId);
        return true;
    }
    }
    
    public function unfavorite($micropostId)
    {
        $exist = $this->is_favoriting($micropostId);
        
        if ($exist) {
            $this->favoritings()->detach($micropostId);
            return true;
        } else {
            return false;
        }
    }

    public function is_favoriting($micropostId) {
        
        return $this->favoritings()->where('micropost_id', $micropostId)->exists();
    }

    }


<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail ,HasLocalePreference
{
    use HasApiTokens, HasFactory, Notifiable ,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'profile_photo_path'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',// علشان اعمل مرجع لليوسر يلي حذفتها
        'notification_options'=>'json',
    ];

    public function questions(){
        return $this->hasMany(Question::class,'user_id','id');
    }
    public function answers(){
        return $this->hasMany(Answer::class,'user_id','id');
    }
    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id')
            ->withDefault();

    }

    public function routeNotificationForMail( $notification = null)
    {
        return $this->email;
    }
    public function preferredLocale(){

        return $this->langauge;
    }
}

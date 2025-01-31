<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cart\Cart;
use App\Models\Order\Order;
use App\Models\Photo\Photo;
use App\Models\Review\Review;
use App\Models\Favorite\Favorite;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'address',
        'is_male',
        'birthdate',
        'telegram_user_id'
    ];

    protected $guard = ['role','phone'];

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
    ];


    //.............Relation......................
    /**
     * user could review many products or bundels
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    //...........
    //...........

    /**
     * user could add more than one product or bundels,so in favorite
     * table there are multi record have same user id(in user_id column)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    //...........
    //...........
    /**
     * user can only have one photo,in photo morph relation
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    //...........
    //...........

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

     //...........
    //...........
    
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    
    }

<?php

namespace App\Models\Api\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Api\Cart\Cart;
use App\Models\Api\Order\Order;
use App\Models\Api\Photo\Photo;
use App\Models\Api\Review\Review;
use App\Models\Api\Favorite\Favorite;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Api\User\UserOtpSetting;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use  HasFactory, Notifiable,SoftDeletes , HasRoles;//HasApiTokens,

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
        'telegram_user_id',
    ];

    protected $guard = ['role','phone','privacy_setting'];

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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Typically returns the primary key (e.g., 'id').
    }
      /**
     * Return a key-value array containing custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // You can add custom claims here if needed.
    }


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'privacy_settings' => 'array', // Auto-cast JSON to an array
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

    //.................
    //.................

    public function providers()
{
    return $this->hasMany(Provider::class);
}

    //...................
    //...................
    /**
     * telegram dual authentication
     * one To One Relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function otpSetting()
    {
        return $this->hasOne(UserOtpSetting::class,'user_id');
    }
    
    }

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Hotel extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $guard = 'admin';

    protected $table = 'hotels';
    protected $fillable = [
        'name_ar',
        'name_en',
        'subdomain',
        'status',
        'archive',
        'logo',
        'country_id',
        'city_id',
        'package_id',
        'email',
        'password',
        'phone_number',
        'phone_verification',
        'email_verified_at',
        'phone_verified_at',
        'admin_activation',
        'latitude',
        'longitude',
        'lang',
        'tax',
        'tax_value',
        'description_ar',
        'description_en',
        'views',
        'api_token',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    protected $casts = [ 'phone_verified_at'=>'datetime'];
    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class , 'city_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class , 'package_id');
    }
    public function subscription()
    {
        return $this->hasOne(Subscription::class , 'hotel_id');
    }
}

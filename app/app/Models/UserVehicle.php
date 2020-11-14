<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'vehicle_brand_id',
        'license',
        'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'vehicle_brand_id',
        'created_at',
        'updated_at'
    ];

    public function scopeUsers($query, $users) {
        return $users ? $query->whereIn('user_id', $users) : null;
    }

    public function scopeLicense($query, $license) {
        return $license ? $query->orWhere('license', 'like', '%' .$license. '%') : null;
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function vehicleBrand() {
        return $this->belongsTo('App\Models\VehicleBrand', 'vehicle_brand_id', 'id');
    }

    public function visits() {
        return $this->hasMany('App\Models\UserVehicleVisit');
    }
}
